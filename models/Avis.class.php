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

	private $link;

	// Ctor
	public function __construct($link)
	{
		$this->link = $link;
	}

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


	public function setNote($note)
	{
		
		return $this->Note;
	}

	public function setContenu($contenu)
	{
		if (strlen($contenu) < 20)
			throw new Exception("Contenu trop court (< 20)");
		else if (strlen($contenu) > 2023)
			throw new Exception("Contenu trop long (> 2023)");
		$this->contenu = $contenu;
	}

	// Méthodes spécifiques
	// public function getListComment / getCommentList / getComments / getList
	
}
?>