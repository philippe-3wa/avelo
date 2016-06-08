<?php
class SousCategorieManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findAll()
	{
		$list = [];
		$request = "SELECT * FROM sous_categorie";
		$res = mysqli_query($this->link, $request);
		while ($sous_categorie = mysqli_fetch_object($res, "SousCategorie", [$this->link]))
			$list[] = $sous_categorie;
		return $list;
	}

	public function findAllActif()
	{
		$list = [];
		$request = "SELECT * FROM sous_categorie WHERE actif=1";
		$res = mysqli_query($this->link, $request);
		while ($sous_categorie = mysqli_fetch_object($res, "SousCategorie", [$this->link]))
			$list[] = $sous_categorie;
		return $list;
	}

	public function findAllGroup()
	{
		$list = [];
		$request = "SELECT * FROM sous_categorie GROUP BY nom";
		$res = mysqli_query($this->link, $request);
		while ($sous_categorie = mysqli_fetch_object($res, "SousCategorie", [$this->link]))
			$list[] = $sous_categorie;
		return $list;
	}
	
	public function findByCategorie(Categorie $categorie)
	{
		$list = [];
		$id_categorie = $categorie->getId();
		$request = "SELECT * FROM sous_categorie WHERE actif=1 AND id_categorie=".$id_categorie;
		$res = mysqli_query($this->link, $request);
		while ($sous_categorie = mysqli_fetch_object($res, "SousCategorie", [$this->link]))
			$list[] = $sous_categorie;
		return $list;
	}
	
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM sous_categorie WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$sous_categorie = mysqli_fetch_object($res, "SousCategorie", [$this->link]);
		return $sous_categorie;
	}

	public function verifVariables($data)
	{
		if (!isset($data['description']))
			throw new Exception ("Missing paramater : description");
		if (!isset($data['nom']))
			throw new Exception ("Missing paramater : nom");
		if (!isset($data['id_categorie']))
			throw new Exception ("Missing paramater : id_categorie");
		if (!isset($data['actif']))
			throw new Exception ("Missing paramater : actif");
	}
	
	public function create($data)
	{
		if (!isset($_SESSION['admin']))
			throw new Exception ("Vous devez être connecté");

		$this->verifVariables($data);

		$sous_categorie = new SousCategorie($this->link);

		$sous_categorie->setNom($data['nom']);
		$sous_categorie->setDescription($data['description']);
		$sous_categorie->setIdCategorie($data['id_categorie']);
		$sous_categorie->setActif($data['actif']);
		
		$nom = mysqli_real_escape_string($this->link, $sous_categorie->getNom());
		$description = mysqli_real_escape_string($this->link, $sous_categorie->getDescription());
		$id_categorie = intval($sous_categorie->getIdCategorie());
		$actif = intval($sous_categorie->getActif());

		$request = "INSERT INTO sous_categorie (nom, description, id_categorie, actif) VALUES('".$nom."', '".$description."', '".$id_categorie."', '".$actif."')";
		$res = mysqli_query($this->link, $request);
		if ($res)
		{
			$id = mysqli_insert_id($this->link);
			if ($id)
			{
				$avis = $this->findById($id);
				return $sous_categorie;
			}
			else
				throw new Exception ("Internal server error");
		}
		else
			throw new Exception ("Internal server error");
	}

	public function update(SousCategorie $sous_categorie)
	{
		if (!isset($_SESSION['admin']))
			throw new Exception ("Vous devez être connecté");

		
		$id = $sous_categorie->getId();
		if ($id)
		{
			$nom = mysqli_real_escape_string($this->link, $sous_categorie->getNom());
			$description = mysqli_real_escape_string($this->link, $sous_categorie->getDescription());
			$id_categorie = intval($sous_categorie->getIdCategorie());
			$actif = intval($sous_categorie->getActif());
			$request = "UPDATE sous_categorie SET nom='".$nom."', description='".$description."', id_categorie='".$id_categorie."', actif='".$actif."' WHERE id=".$id;
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