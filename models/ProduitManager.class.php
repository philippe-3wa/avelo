<?php
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

	public function findByCategorie($categorie)
	{
		$list[];
		$categorie = intval($categorie);
		$request = "SELECT * FROM produit 
		INNER JOIN sous_categorie 
		ON sous_categorie.id_categorie =".$categorie;
		$res = mysqli_query($this->link, $request);
		while ($produit = mysqli_fetch_object($res, "Produit"))
			$list[] = $produit;
		return $list;
	}

	public function verifVariables($data)
	{
		if (!isset($data['reference']))
			throw new Exception ("Missing paramater : reference");
		if (!isset($data['nom']))
			throw new Exception ("Missing paramater : nom");
		if (!isset($data['description']))
			throw new Exception ("Missing paramater : description");
		if (!isset($data['prix']))
			throw new Exception ("Missing paramater : prix");
		if (!isset($data['tva']))
			throw new Exception ("Missing paramater : tva");
		if (!isset($data['photo']))
			throw new Exception ("Missing paramater : photo");
		if (!isset($data['poids']))
			throw new Exception ("Missing paramater : poids");
		if (!isset($data['actif']))
			throw new Exception ("Missing paramater : actif");
		if (!isset($data['stock']))
			throw new Exception ("Missing paramater : stock");
		if (!isset($data['id_sous_categorie']))
			throw new Exception ("Missing paramater : id_sous_categorie");
	}

	public function create($data)
	{
		if (!isset($_SESSION['admin']))
			throw new Exception ("Vous devez être admin");

		$this->verifVariables($data);

		$produit = new Produit();

		$produit->setReference($data['reference']);
		$produit->setNom($data['nom']);
		$produit->setDescription($data['description']);
		$produit->setPrix($data['prix']);
		$produit->setTva($data['tva']);
		$produit->setPhoto($data['photo']);
		$produit->setPoids($data['poids']);
		$produit->setStock($data['stock']);
		$produit->setActif($data['actif']);
		$produit->setIdSousCategorie($data['id_sous_categorie']);

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

	public function update(Categorie $categorie)
	{
		$this->verifVariables($categorie);

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