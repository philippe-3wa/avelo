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

	private $link

	public function __construct($link)
	{
		$this->link = $link;
	}

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

	public function setTelephone($telephone)
	{
		if (preg_match(''[0-9]{8,12}'',$telephone)
			$this->telephone = $telephone;
		else
			throw new Exception("Numéro invalide");
	}
	public function setCp($cp)
	{
		if (preg_match(''[0-9]{5}'',$cp)
			$this->cp = $cp;
		else
			throw new Exception("Numéro invalide");
	}
	if (empty($_POST['numero']))
		throw new Exception("Le numéro de rue n'a pas été renseigné");
	else
		$numero=$_POST['numero'];
	if (empty($_POST['rue']))
		throw new Exception("Le nom de la rue n'a pas été renseignée");
	else
		$rue=$_POST['rue'];
	if (empty($_POST['ville']))
		throw new Exception("La ville n'a pas été renseignée");
	else
		$ville=$_POST['ville'];
	if (empty($_POST['pays']))
		throw new Exception("le pays n'a pas été renseigné");
	else
		$pays=$_POST['pays'];

}
?>