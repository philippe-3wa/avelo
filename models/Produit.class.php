<?php
class Produit
{
	// Déclaration des propriétés privées
	private $id;
	private $reference;
	private $nom;
	private $description;
	private $prix;
	private $tva;
	private $photo;
	private $poids;
	private $actif;
	private $stock;
	private $id_sous_categorie;
	
	private $link;

	private $avis;
	private $sous_categorie;
	private $categorie;

	public function __construct($link)
	{
		$this->link = $link;
	}
	public function getCategorie()
	{
		if ($this->categorie === null)
			$this->categorie = $this->getSousCategorie()->getCategorie();
		return $this->categorie;
	}
	public function getSousCategorie()
	{
		if ($this->sous_categorie === null)
		{
			$sous_categorieManager = new SousCategorieManager($this->link);
			$this->sous_categorie = $sous_categorieManager->findId($this->id_sous_categorie);
		}
		return $this->sous_categorie;
	}

	// Getter/Setter | Accesseur/Mutateur | Accessor/Mutator
	public function getId()
	{
		return $this->id;
	}
	public function getReference()
	{
		return $this->reference;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getPrix()
	{
		return $this->prix;
	}
	public function getTva()
	{
		return $this->tva;
	}
	public function getPhoto()
	{
		return $this->photo;
	}
	public function getPoids()
	{
		return $this->poids;
	}
	public function getActif()
	{
		return $this->actif;
	}
	public function getStock()
	{
		return $this->stock;
	}
	public function getIdSousCategorie()
	{
		return $this->id_sous_categorie;
	}

	public function getListeAvis()
	{
		if ($this->avis === null)
		{
			$avisManager = new AvisManager($this->link);
			$this->avis = $avisManager->findByProduit($this);
		}
		return $this->avis;
	}
	
	public function setReference($reference)
	{
		if (strlen($reference) < 4)
			throw new Exception ("Nom trop court (< 4)");
		else if (strlen($reference) > 63)
			throw new Exception ("Nom trop long (> 63)");
		$this->reference = $reference;
	}
	public function setNom($nom)
	{
		if (strlen($nom) < 4)
			throw new Exception ("Nom trop court (< 4)");
		else if (strlen($nom) > 63)
			throw new Exception ("Nom trop long (> 63)");
		$this->nom = $nom;
	}
	public function setDescription($description)
	{
		if (strlen($description) < 15)
			throw new Exception ("Content trop court (< 20)");
		else if (strlen($description) > 511)
			throw new Exception ("Content trop long (> 511)");
		$this->description = $description;
	}
	public function setPrix($prix)
	{
		$prix = floatval($prix);
		if ($prix < 0)
			throw new Exception ("le prix doit être supérieur ou égal à 0");
		$this->prix = $prix;
	}
	public function setTva($tva)
	{
		$tva = floatval($tva);
		if ($tva < 0)
			throw new Exception ("la tva doit être supérieur ou égal à 0");
		$this->tva = $tva;
	}
	public function setPhoto($photo)
	{
		$this->photo = $photo;
	}
	public function setPoids($poids)
	{
		$poids = floatval($poids);
		if ($poids < 0)
			throw new Exception ("le poids doit être supérieur ou égal à 0");
		$this->poids = $poids;
	}
	public function setActif($actif)
	{
		$actif = intval($actif);
		if ( ($actif < 0) || ($actif > 1) )
			throw new Exception ("actif est = à 0 ou 1");
		$this->actif = $actif;
	}
	public function setStock($stock)
	{
		$stock = intval($stock);
		if ($stock < 0) 
			throw new Exception ("le stock doit être supérieur ou égal à 0");
		$this->stock = $stock;
	}
	public function setIdSousCategorie($id_sous_categorie)
	{
		$id_sous_categorie = intval($id_sous_categorie);
		if ($id_sous_categorie <= 0) 
			throw new Exception ("l'id de la sous categorie doit être supérieur à 0");
		$this->id_sous_categorie = $id_sous_categorie;
	}

}
?>