<?php
class File
{
    public $realpath;
    public $path;
    public $name;
    public $filename;
    public $extension;
    public $parents;
    public $children;
    public $content;
    public $isTraitement = false;
    public $reqPage = false;
    public $reqTraitement = false;

    public function __construct($path, $name)
    {
    	$this->realpath = realpath($path.'/'.$name);
    	$info = pathinfo($this->realpath);
    	$this->path = $path.'/';
    	$this->name = $info['basename'];
    	$this->filename = $info['filename'];
    	$this->extension = $info['extension'];
    	$this->content = file_get_contents($this->realpath);
    	$this->parents = [];
    	$this->children = [];
    	$this->initChildren();
    	if (strpos($this->realpath, 'traitement') !== false)
    		$this->isTraitement = true;
    }
    public function initChildren()
    {
		$re = "/require\\([\"'](.*)[\"']\\);/";
		preg_match_all($re, $this->content, $matches);
		$children = $matches[1];
		$i = 0;
		while (isset($children[$i]))
		{
			$path = realpath($children[$i]);
			if ($path)
				$this->children[] = $path;
			else if (strpos($children[$i], '$page') !== false && strpos($children[$i], 'traitement') !== false)
				$this->reqTraitement = true;
			else if (strpos($children[$i], '$page') !== false)
				$this->reqPage = true;
			$i++;
		}
    }
}
function getPath()
{
	$path = $_SERVER['SCRIPT_FILENAME'];
	$path = str_replace('/schema.php', '', $path);
	$path = explode('/', $path);
	return array_pop($path);
}
function randColor()
{
	return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}
function parseDir($path)
{
	$list = [];
	$dir = scandir($path);
	$i = 0;
	$max = sizeof($dir);
	while ($i < $max)
	{
		if ($dir[$i][0] !== '.')
		{
			$file = $path.'/'.$dir[$i];
			if (is_dir($file))
				$list = array_merge($list, parseDir($file));
			else
				$list[] = new File($path, $dir[$i]);
		}
		$i++;
	}
	return $list;
}
function refresh()
{
	$index = new File('.', 'index.php');
	$usedList = [$index];
	$unusedList = [];
	$apps = parseDir('apps');
	$views = parseDir('views');
	$list = array_merge($apps, $views);
	$unusedList = $list;
	array_unshift($list, $index);
	$i = 0;
	while (isset($list[$i]))
	{
		$j = 0;
		while (isset($list[$i]->children[$j]))
		{
			$k = 0;
			while (isset($list[$k]))
			{
				if (is_string($list[$i]->children[$j]) && $list[$i]->children[$j] == $list[$k]->realpath)
				{
					$list[$i]->children[$j] = $list[$k];
					$list[$k]->parents[] = $list[$i];
					$l = 0;
					while (isset($unusedList[$l]))
					{
						if ($unusedList[$l]->realpath == $list[$k]->realpath)
						{
							$usedList[] = $unusedList[$l];
							array_splice($unusedList, $l, 1);
						}
						else
							$l++;
					}
				}
				$k++;
			}
			$j++;
		}
		$i++;
	}
	$i = 0;
	while (isset($list[$i]))
	{
		if ($list[$i]->reqTraitement)
		{
			$j = 0;
			while (isset($list[$j]))
			{
				if ($list[$j]->isTraitement)
				{
					$list[$i]->children[] = $list[$j];
					$list[$j]->parents[] = $list[$i];
				}
				$j++;
			}
		}
		if ($list[$i]->reqPage)
		{
			$j = 0;
			while (isset($unusedList[$j]))
			{
				if (!$unusedList[$j]->isTraitement)
				{
					if (strpos($index->content, $unusedList[$j]->filename) !== false)
					{
						$list[$i]->children[] = $unusedList[$j];
						$unusedList[$j]->parents[] = $list[$i];
						$usedList[] = $unusedList[$j];
						array_splice($unusedList, $j, 1);
						$j--;
					}
				}
				else
				{
					$usedList[] = $unusedList[$j];
					array_splice($unusedList, $j, 1);
					$j--;
				}
				$j++;
			}
		}
		$i++;
	}
	$archi = [];
	$i = 0;
	while (isset($list[$i]))
	{
		$j = 0;
		if (sizeof($list[$i]->parents) == 0)
		{
			if ($list[$i]->name == 'index.php')
				$archi[] = [['v'=>$list[$i]->name,'f'=>'<span style="font-size:2em">'.$list[$i]->name.'</span>'], '', $list[$i]->realpath];
			else
				$archi[] = [['v'=>$list[$i]->name,'f'=>'<span style="color:red">'.$list[$i]->name.'</span>'], '', $list[$i]->realpath];
		}
		else if (sizeof($list[$i]->parents) > 1)
			$color = 'red';
		else if ($list[$i]->isTraitement)
			$color = '#666';
		else if ($list[$i]->extension == 'php')
			$color = 'blue';
		else if ($list[$i]->extension == 'phtml')
			$color = 'green';
		while (isset($list[$i]->parents[$j]))
		{
			$bonus = '';
			if ($j > 0)
				$bonus = '_'.$j;
			$archi[] = [['v'=>$list[$i]->name.$bonus,'f'=>'<span style="color:'.$color.'">'.$list[$i]->name.'</span>'], $list[$i]->parents[$j]->name, $list[$i]->realpath];
			$j++;
		}
		$i++;
	}
	return $archi;
}
$data = refresh();
if (isset($_GET['refresh']))
{
	echo json_encode($data);
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Schema</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	</head>
	<body>
		<h1><?=getPath()?></h1>
		<div id="chart_div"></div>
		<script>
			google.load('visualization', '1', {packages:['orgchart']});
			google.setOnLoadCallback(drawChart);
			var chart;
			function drawChart()
			{
				var table = new google.visualization.DataTable();
				table.addColumn('string', 'File');
				table.addColumn('string', 'Parent');
				table.addColumn('string', 'Path');
				table.addRows(<?=json_encode($data)?>);
				chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
				chart.draw(table, {allowHtml:true});
			}
			setInterval(function()
			{
				$.get("<?=$_SERVER['PHP_SELF']?>?refresh", function(raw)
				{
					if (chart)
					{
						var data = JSON.parse(raw);
						var table = new google.visualization.DataTable();
						table.addColumn('string', 'File');
						table.addColumn('string', 'Parent');
						table.addColumn('string', 'Path');
						table.addRows(data);
						chart.draw(table, {allowHtml:true});
					}
				});
			}, 30000);
		</script>
	</body>
</html>