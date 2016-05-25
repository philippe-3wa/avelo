<?php

class SousCategorie
{
	// Déclaration des propriétés privées
	private $id;
	private $nom;
	private $description;
	private $id_categorie;


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
	
	


	public function setNom($nom)
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
		else if (strlen($description) > 127)
			return "Content trop long (> 127)";
		$this->description = $description;
	}

}
?>