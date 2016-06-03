<?php

class SousCategorie
{
	// Déclaration des propriétés privées
	private $id;
	private $nom;
	private $description;
	private $id_categorie;
	private $actif;

	private $link;

	private $categorie;
	private $produits;

	public function __construct($link)
	{
		$this->link = $link;
	}


	// Getter/Setter | Accesseur/Mutateur | Accessor/Mutator
	public function getId()
	{
		return $this->id;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getIdCategorie()
	{
		return $this->id_categorie;
	}
	public function getActif()
	{
		return $this->actif;
	}
	
	
	

	public function getCategorie()
	{
		if ($this->categorie === null)
		{
			$manager = new CategorieManager($this->link);
			$this->categorie = $manager->findById($this->id_categorie);
		}
		return $this->categorie;
	}
	public function setNom($nom)
	{
		if (strlen($nom) < 3)
			throw new Exception ("Nom trop court (< 3)");
		else if (strlen($nom) > 63)
			throw new Exception ("Nom trop long (> 63)");
		$this->nom = $nom;
	}
	public function setDescription($description)
	{
		if (strlen($description) < 15)
			throw new Exception ("description trop court (< 15)");
		else if (strlen($description) > 127)
			throw new Exception ("description trop long (> 127)");
		$this->description = $description;
	}
	public function setIdCategorie($id_categorie)
	{
		$id_categorie = intval($id_categorie);
		$this->id_categorie = $id_categorie;
	}

	public function setActif($actif)
	{
		$actif = intval($actif);
		if ( ($actif < 0) || ($actif > 1) )
			throw new Exception ("actif doit être = à 0 ou 1");
		$this->actif = $actif;
	}

	public function getProduits()
	{
		if ($this->produits === null)
		{
			$produitManager = new ProduitManager($this->link);
			$this->produits = $produitManager->findBySousCategorie($this);
		}
		return $this->produits;
	}

}
?>