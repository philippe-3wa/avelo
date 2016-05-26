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

	public function setTelephone($telephone)
	{
		if (preg_match(''[0-9]{8,12}'',$telephone)
			$this->telephone = $telephone;
		else
			return "Numéro invalide";
	}
	public function setCp($cp)
	{
		if (preg_match(''[0-9]{5}'',$cp)
			$this->cp = $cp;
		else
			return "Numéro invalide";
	}
	if (empty($_POST['numero']))
		return "Le numéro de rue n'a pas été renseigné";
	else
		$numero=$_POST['numero'];
	if (empty($_POST['rue']))
		return "Le nom de la rue n'a pas été renseignée";
	else
		$rue=$_POST['rue'];
	if (empty($_POST['ville']))
		return "La ville n'a pas été renseignée";
	else
		$ville=$_POST['ville'];
	if (empty($_POST['pays']))
		return "le pays n'a pas été renseigné";
	else
		$pays=$_POST['pays'];
}
?>