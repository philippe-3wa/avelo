<?php

class Categorie
{
	// Déclaration des propriétés privées
	private $id;
	private $nom;
	private $description;
	private $actif;

	private $sous_categories;
	private $produits;

	private $link;

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
	public function getActif()
	{
		return $this->actif;
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
			throw new Exception ("description trop court (< 15)");
		else if (strlen($description) > 127)
			throw new Exception ("description trop long (> 127)");
		$this->description = $description;
	}
	public function setActif($actif)
	{
		$actif = intval($actif);
		if ( ($actif < 0) || ($actif > 1) )
			throw new Exception ("actif doit être = à 0 ou 1");
		$this->actif = $actif;
	}

	public function getSousCategories()
	{
		if ($this->sous_categories === null)
		{
			$sous_categorieManager = new SousCategorieManager($this->link);
			$this->sous_categories = $sous_categorieManager->findByCategorie($this);
		}
		return $this->sous_categories;
	}

	public function getProduits()
	{
		if ($this->produits === null)
		{
			$produitManager = new ProduitManager($this->link);
			$this->produits = $produitManager->findByCategorie($this);
		}
		return $this->produits;
	}

}
?>