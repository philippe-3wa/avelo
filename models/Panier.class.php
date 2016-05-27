<?php

class Panier
{
	// Déclaration des propriétés privées
	private $id;
	private $date;
	private $nbr_produits;
	private $statut;
	private $prix;
	private $poids;
	private $id_user;



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
	public function getDate()
	{
		return $this->date;
	}
	public function getNbrProduits()
	{
		return $this->nbr_produits;
	}
	public function getStatut()
	{
		return $this->statut;
	}
	public function getPrix()
	{
		return $this->prix;
	}
	public function getPoids()
	{
		return $this->poids;
	}
	public function getIdUser()
	{
		return $this->id_user;
	}
	
	

	public function setNbrProduits($nbr_produits)
	{
		$nbr_produits = intval($actif);
		if ($nbr_produits < 0)
			throw new Exception ("doit être > ou = à 0");
		$this->nbr_produits = $nbr_produits;
	}

	public function setStatut($statut)
	{
		$statut = intval($statut);
		if ($nbr_produits < 0)
			throw new Exception ("doit être > ou = à 0");
		$this->statut = $statut;
	}

	public function setPrix($prix)
	{
		$prix = floatval($prix);
		if ($prix < 0)
			throw new Exception ("doit être > ou = à 0");
		$this->prix = $prix;
	}

	public function setPoids($poids)
	{
		$poids = floatval($poids);
		if ($poids < 0)
			throw new Exception ("doit être > ou = à 0");
		$this->poids = $poids;
	}

	public function setIdUser()
	{
		$this->id_user = $_SESSION['id'];
	}

}
?>