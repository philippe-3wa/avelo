<?php
class ProduitManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}
	

	public function findAll()
	{
		$list = [];
		$request = "SELECT * FROM produit";
		$res = mysqli_query($this->link, $request);
		while ($produit = mysqli_fetch_object($res, "Produit", [$this->link]))
			$list[] = $produit;
		return $list;
	}
	public function findByPanier(Panier $panier)
	{
		$id = $panier->getId();
		$list = [];
		$request = "SELECT * FROM produit
			INNER JOIN link_panier_produit ON produit.id=link_panier_produit.id_produit
			WHERE link_panier_produit.id_panier=".$id;
		$res = mysqli_query($this->link, $request);
		while ($produit = mysqli_fetch_object($res, "Produit", [$this->link]))
			$list[] = $produit;
		return $list;
	}

	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM produit WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$produit = mysqli_fetch_object($res, "Produit", [$this->link]);
		return $produit;
	}

	public function findBySousCategorie(SousCategorie $sous_categorie)
	{
		$list = [];
		$id_sous_categorie = $sous_categorie->getId();
		$request = "SELECT * FROM produit WHERE id_sous_categorie=".$id_sous_categorie;
		$res = mysqli_query($this->link, $request);
		while ($produit = mysqli_fetch_object($res, "Produit", [$this->link]))
			$list[] = $produit;
		return $list;
	}

	public function findByCategorie(Categorie $categorie)
	{
		$list[];
		$id_categorie = $categorie->getId();
		$request = "SELECT produit.* FROM produit 
		INNER JOIN sous_categorie 
		ON sous_categorie.id=produit.id_sous_categorie
		WHERE sous_categorie.id_categorie=".$id_categorie;
		$res = mysqli_query($this->link, $request);
		while ($produit = mysqli_fetch_object($res, "Produit", [$this->link]))
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

		$produit = new Produit($this->link);

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

	public function update(Produit $produit)
	{
		$this->verifVariables($produit);
		$produit = new Produit($this->link);
		$id = $produit->getId();
		if ($id)
		{
			$reference = $produit->getReference();
			$nom = mysqli_real_escape_string($this->link, $produit->getNom());
			$description = mysqli_real_escape_string($this->link, $produit->getDescription());
			$prix = $produit->getPrix();
			$tva = $produit->getTva();
			$photo = mysqli_real_escape_string($this->link, $produit->getPhoto());
			$poids =$produit->getPoids();
			$stock = $produit->getStock();
			$actif = $produit->getActif();
			$id_sous_categorie = $produit->getIdSousCategorie();

			$request = "UPDATE produit 
			SET reference='".$reference."', nom='".$nom."', description='".$description."', prix='".$prix."', tva='".$tva."',photo='".$photo."', poids='".$poids."', actif='".$actif."', stock='".$stock."', id_sous_categorie='".$id_sous_categorie."' WHERE id=".$id;
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