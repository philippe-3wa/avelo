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
		if (!isset($_SESSION['admin']))
			return "Vous devez être connecté";
		$categorie = new Categorie();

		if (!isset($data['description']))
			return "Missing paramater : description";
		if (!isset($data['nom']))
			return "Missing paramater : nom";
		if (!isset($data['actif']))
			return "Missing paramater : actif";
		$error = $categorie->setNom($data['nom']);
		$error = $categorie->setDescription($data['description']);
		$error = $categorie->setActif($data['actif']);
		if ($error)
			return $error;
		else
		{
			$nom = mysqli_real_escape_string($this->link, $categorie->getNom());
			$description = mysqli_real_escape_string($this->link, $categorie->getDescription());
			$actif = $categorie->getActif();
			$request = "INSERT INTO categorie (nom, description, actif) VALUES('".$nom."', '".$description."', '".$actif."')";
			$res = mysqli_query($this->link, $request);
			if ($res)// Si la requete s'est bien passée
			{
				$id = mysqli_insert_id($this->link);
				if ($id)// si c'est bon id > 0
				{
					$avis = $this->findById($id);
					return $categorie;
				}
				else// Sinon
					return "Internal server error";
			}
			else// Sinon
				return "Internal server error";
		}
	}

	public function update(Categorie $categorie)
	{
		if (!isset($_SESSION['admin']))
			return "Vous devez être connecté";
		
		$id = $categorie->getId();
		if ($id)// true si > 0
		{
			$nom = mysqli_real_escape_string($this->link, $categorie->getNom());
			$description = mysqli_real_escape_string($this->link, $categorie->getDescription());
			$actif = $categorie->getActif();
			$request = "UPDATE categorie SET nom='".$nom."', description='".$description."', actif='".$actif."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				return "Internal server error";
		}
	}

	public function getById($id)
	{
		return $this->findById($id);
	}
}
?>