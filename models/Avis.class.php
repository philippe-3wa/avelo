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
	private $user;
	private $produit;

	// Ctor
	public function __construct($link)
	{
		$this->link = $link;
	}

	// Getter/Setter | Accesseur/Mutateur | Accessor/Mutator
	public function getUser()
	{
		if ($this->user === null)
		{
			$manager = new UserManager($this->link);
			$this->user = $manager->findById($this->id_user);
		}
		return $this->user;
	}
	public function getProduit()
	{
		if ($this->produit === null)
		{
			$manager = new ProduitManager($this->link);
			$this->produit = $manager->findById($this->id_produit);
		}
		return $this->produit;
	}
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
		return $this->note;
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
		$note = intval($note);
		if (($note < 1) || ($note > 5) || ($note===""))
			throw new Exception("Note doit aller de 1 à 5");
		return $this->note = $note;
	}

	public function setIdProduit($id_produit)
	{
		
		return $this->id_produit = $id_produit;
	}

	public function setContenu($contenu)
	{
		if (strlen($contenu) < 5)
			throw new Exception("Contenu trop court (< 5)");
		else if (strlen($contenu) > 2023)
			throw new Exception("Contenu trop long (> 2023)");
		return $this->contenu = $contenu;
	}

}
?>