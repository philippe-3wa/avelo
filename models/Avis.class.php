<?php
// avis.class.php -> PascalCase
class avis
{
	// Déclaration des propriétés privées
	private $id;
	private $contenu;
	private $note;
	private $date;
	private $id_user;
	private $id_produit;


	// Ctor

	// Getter/Setter | Accesseur/Mutateur | Accessor/Mutator
	public function getId()
	{
		return $this->id;
	}
	public function getContenu()
	{
		return $this->contenu;
	}
	public function getNote()
	{
		return $this->idnote;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getIdUser()
	{
		return $this->id_user;
	}
	public function getIdProduit()
	{
		return $this->id_produit;
	}


	public function setContenu($contenu)
	{
		if (strlen($contenu) < 4)
			return "Contenu trop court (< 4)";
		else if (strlen($contenu )> 511)
			return "Contenu trop long (> 511)";
		$this->contenu = $contenu;
	}

	// Méthodes spécifiques
}
?>