<?php
// models/AvisManager.class.php
class ProduitManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}


	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM produit WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$produit = mysqli_fetch_object($res, "Produit");
		return $produit;
	}

	public function findBySousCategorie($sous_categorie)
	{
		$list = [];
		$sous_categorie = intval($sous_categorie);
		$request = "SELECT * FROM produit WHERE id_sous_categorie=".$sous_categorie;
		$res = mysqli_query($this->link, $request);
		while ($produit = mysqli_fetch_object($res, "Produit"))
			$list[] = $produit;
		return $list;
	}


	public function create($data)
	{
		if (!isset($_SESSION['admin']))
			return "Vous devez être admin";

		$produit = new Produit();

		if (!isset($data['reference']))
			return "Missing paramater : reference";
		if (!isset($data['nom']))
			return "Missing paramater : nom";
		if (!isset($data['description']))
			return "Missing paramater : description";
		if (!isset($data['prix']))
			return "Missing paramater : prix";
		if (!isset($data['tva']))
			return "Missing paramater : tva";
		if (!isset($data['photo']))
			return "Missing paramater : photo";
		if (!isset($data['poids']))
			return "Missing paramater : poids";
		if (!isset($data['actif']))
			return "Missing paramater : actif";
		if (!isset($data['stock']))
			return "Missing paramater : stock";
		if (!isset($data['id_sous_categorie']))
			return "Missing paramater : id_sous_categorie";

		$error = $produit->setReference($data['reference']);
		$error = $produit->setNom($data['nom']);
		$error = $produit->setDescription($data['description']);
		$error = $produit->setPrix($data['prix']);
		$error = $produit->setTva($data['tva']);
		$error = $produit->setPhoto($data['photo']);
		$error = $produit->setPoids($data['poids']);
		$error = $produit->setStock($data['stock']);
		$error = $produit->setActif($data['actif']);
		$error = $produit->setIdSousCategorie($data['id_sous_categorie']);
		if ($error)
			return $error;
		else
		{
			$reference = mysqli_real_escape_string($this->link, $produit->getReference());
			$nom = mysqli_real_escape_string($this->link, $produit->getNom());
			$description = mysqli_real_escape_string($this->link, $produit->getDescription());
			$prix = $produit->getPrix();
			$tva = $produit->getTva();
			$photo = mysqli_real_escape_string($this->link, $produit->getPhoto());
			$poids = $produit->getPoids();
			$actif = $produit->getActif();
			$stock = $produit->getStock();
			$id_sous_categorie = $produit->getIdSousCategorie();
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