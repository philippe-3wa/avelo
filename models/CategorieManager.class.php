<?php
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
		while ($categorie = mysqli_fetch_object($res, "Categorie", [$this->link]))
			$list[] = $categorie;
		return $list;
	}

	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM categorie WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$categorie = mysqli_fetch_object($res, "Categorie", [$this->link]);
		return $categorie;
	}

	public function verifVariables($data)
	{
		if (!isset($data['description']))
			throw new Exception ("Missing paramater : description");
		if (!isset($data['nom']))
			throw new Exception ("Missing paramater : nom");
		if (!isset($data['actif']))
			throw new Exception ("Missing paramater : actif");
	}
	
	public function create($data)
	{
		if (!isset($_SESSION['admin']))
			throw new Exception ("Vous devez être connecté");

		$this->verifVariables($data);

		$categorie = new Categorie($this->link);

		$categorie->setNom($data['nom']);
		$categorie->setDescription($data['description']);
		$categorie->setActif($data['actif']);

		$nom = mysqli_real_escape_string($this->link, $categorie->getNom());
		$description = mysqli_real_escape_string($this->link, $categorie->getDescription());
		$actif = $categorie->getActif();
		$request = "INSERT INTO categorie (nom, description, actif) VALUES('".$nom."', '".$description."', '".$actif."')";
		$res = mysqli_query($this->link, $request);
		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if ($id)
			{
				$avis = $this->findById($id);
				return $categorie;
			}
			else
				throw new Exception ("Internal server error");
		}
		else
			throw new Exception ("Internal server error");
	}

	public function update($categorie)
	{
		if (!isset($_SESSION['admin']))
			throw new Exception ("Vous devez être connecté");
			
		
		$id = $categorie->getId();
		if ($id)
		{
			$nom = mysqli_real_escape_string($this->link, $categorie->getNom());
			$description = mysqli_real_escape_string($this->link, $categorie->getDescription());
			$actif = $categorie->getActif();
			$request = "UPDATE categorie SET nom='".$nom."', description='".$description."', actif='".$actif."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception ("Internal server error");
		}
	}

	public function getById($id)
	{
		return $this->findById($id);
	}
}
?>