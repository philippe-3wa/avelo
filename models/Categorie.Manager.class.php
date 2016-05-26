<?php
// models/AvisManager.class.php
class CategorieManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findAll()
	{
		$list = [];
		$request = "SELECT * FROM categorie";
		$res = mysqli_query($this->link, $request);
		while ($categorie = mysqli_fetch_object($res, "Categorie"))
			$list[] = $categorie;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM categorie WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$categorie = mysqli_fetch_object($res, "Categorie");
		return $categorie;
	}
	
	public function create($data)
	{
		if (!isset($_SESSION['id']))
			return "Vous devez être connecté";
		$categorie = new Categorie();

		if (!isset($data['description']))
			return "Missing paramater : description";
		if (!isset($data['nom']))
			return "Missing paramater : nom";
		$error = $categorie->setNom($data['nom']);
		$error = $categorie->setDescription($data['description']);
		if ($error)
			return $error;
		else
		{
			$nom = $categorie->getNom();
			$description = $categorie->getDescription();
			$request = "INSERT INTO avis (title, content) VALUES('".$title."', '".$content."')";
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