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
	

	public function setReference($reference)
	{
		if (strlen($reference) < 4)
			return "Nom trop court (< 4)";
		else if (strlen($reference) > 63)
			return "Nom trop long (> 63)";
		$this->reference = $reference;
	}
	public function setTitre($nom)
	{
		if (strlen($nom) < 4)
			return "Nom trop court (< 4)";
		else if (strlen($nom) > 63)
			return "Nom trop long (> 63)";
		$this->nom = $nom;
	}
	public function setDescription($description)
	{
		if (strlen($description) < 15)
			return "Content trop court (< 20)";
		else if (strlen($description) > 511)
			return "Content trop long (> 511)";
		$this->description = $description;
	}

}
?>