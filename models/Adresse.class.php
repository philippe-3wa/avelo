<?php
class Adresse
{
	private $id;
	private $nom;
	private $numero;
	private $rue;
	private $cp;
	private $ville;
	private $pays;
	private $telephone;
	private $type;
	private $id_user;

	public function getId()
	{
		return $this->id;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getNumero()
	{
		return $this->numero;
	}
	public function getRue()
	{
		return $this->rue;
	}
	public function getCp()
	{
		return $this->cp;
	}
	public function getVille()
	{
		return $this->ville;
	}
	public function getPays()
	{
		return $this->pays;
	}
	public function getTelephone()
	{
		return $this->telephone;
	}
	public function getType()
	{
		return $this->type;
	}
	public function getIdUser()
	{
		return $this->id_user;
	}

	public function setTitle($title)
	{
		if (strlen($title) < 4)
			return "Titre trop court (< 4)";
		else if (strlen($title) > 63)
			return "Titre trop long (> 63)";
		$this->title = $title;
	}
	public function setContent($content)
	{
		if (strlen($content) < 20)
			return "Content trop court (< 20)";
		else if (strlen($content) > 2023)
			return "Content trop long (> 2023)";
		$this->content = $content;
	}

}
?>