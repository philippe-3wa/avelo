<?php
// models/AvisManager.class.php
class AvisManager
{
	private $link;

	// $this->link <===> $link index.php
	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findAll()
	{
		$list = [];
		$request = "SELECT * FROM avis";
		$res = mysqli_query($this->link, $request);
		while ($avis = mysqli_fetch_object($res, "Avis"))
			$list[] = $avis;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM avis WHERE id=".$id;
		// SELECT * FROM avis WHERE id=1
		$res = mysqli_query($this->link, $request);
		$avis = mysqli_fetch_object($res, "Avis");
		return $avis;
	}
	public function findByTitle($title)
	{
		$title = mysqli_real_escape_string($this->link, $title);
		$request = "SELECT * FROM avis WHERE title='".$title."'";
		$res = mysqli_query($this->link, $request);
		$avis = mysqli_fetch_object($res, "Avis");
		return $avis;
	}
	public function create($data)
	{
		if (!isset($_SESSION['id']))
			return "Vous devez être connecté";
		$avis = new Avis();
		// Choix 1
		if (isset($data['title']))
			$error = $avis->setTitle($data['title']);
		else
			return "Missing paramater : title";
		if (isset($data['content']))
			$error = $avis->setContent($data['content']);
		else
			return "Missing paramater : content";
		// OU Choix 2
		if (!isset($data['content']))
			return "Missing paramater : content";
		if (!isset($data['title']))
			return "Missing paramater : title";
		$error = $avis->setTitle($data['title']);
		$error = $avis->setContent($data['content']);
		if ($error)
			return $error;
		else
		{
			$title = $avis->getTitle();
			$content = $avis->getContent();
			$id_author = $_SESSION['id'];
			$request = "INSERT INTO avis (title, content, id_author) VALUES('".$title."', '".$content."', '".$id_author."')";
			$res = mysqli_query($this->link, $request);
			if ($res)// Si la requete s'est bien passée
			{
				$id = mysqli_insert_id($this->link);
				if ($id)// si c'est bon id > 0
				{
					$avis = $this->findById($id);
					return $avis;
				}
				else// Sinon
					return "Internal server error";
			}
			else// Sinon
				return "Internal server error";
		}
	}
	public function getById($id)
	{
		return $this->findById($id);
	}
	public function update(Avis $avis)// type-hinting
	{
		$id = $avis->getId();
		if ($id)// true si > 0
		{
			$title = mysqli_real_escape_string($this->link, $avis->getTitle());
			$content = mysqli_real_escape_string($this->link, $avis->getContent());
			$request = "UPDATE avis SET title='".$title."', content='".$content."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				return "Internal server error";
		}
	}
	public function remove(Avis $avis)
	{
		$id = $avis->getId();
		// droit ? admin ? access ?
		if ($id)// true si > 0
		{
			$request = "DELETE FROM avis WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $avis;
			else
				return "Internal server error";
		}
	}
}
?>