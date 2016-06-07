<?php
session_start();

require('config.php');
$link = mysqli_connect($db_host, $db_login, $db_pass, $db_name);

if (!$link) 
{
    require('views/mysql_error.php');
}

$page = 'home';
$error ='';

function __autoload($className)
{
	require('models/'.$className.'.class.php');
}

$access = array('home', 'produit', 'user', 'categorie', 'sous_categorie', 'panier', 'admin', 'contact', 'profil', 'adresse');

if (isset($_GET['page']))
{

	if (in_array($_GET['page'], $access))
		$page = $_GET['page'];
}

$access_traitement = array('user'=>'user', 'logout'=>'user', 'avis'=>'avis', 'panier'=>'panier', 'admin'=>'admin','adresse'=>'adresse');

if (isset($access_traitement[$page]))
	require('apps/traitement_'.$access_traitement[$page].'.php');

if (isset($_GET['ajax']))
{
	$accessAjax = ['sous_categorieAjax'];
	if (isset($_GET['page']))
	{
		if (in_array($_GET['page'], $accessAjax))
			$pageAjax = $_GET['page'];
	}
	require('apps/'.$pageAjax.'.php');
}
else
	require('apps/skel.php');

mysqli_close($link);
?>