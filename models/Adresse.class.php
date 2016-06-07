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

	private $link;

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
		if (strlen($telephone) < 4)		
			throw new Exception("telephone trop court");
		else if (strlen($telephone) > 63)		
			throw new Exception("telephone trop long");
		
		$this->telephone = $telephone;
			
	}
	public function setCp($cp)
	{
		if (strlen($cp) < 4)		
			throw new Exception("code postal trop court");
		else if (strlen($cp) > 15)		
			throw new Exception("code postal trop long");
		
		$this->cp = $cp;
	}
	public function setNom($nom)
	{
		if (strlen($nom) < 4)		
			throw new Exception("Nom trop court");
		else if (strlen($nom) > 63)		
			throw new Exception("Nom trop long");

		return $this->nom = $nom;
	}

	public function setNumero($numero)
	{
		if (strlen($numero) < 1)		
			throw new Exception("Numero trop court");
		else if (strlen($numero) > 7)		
			throw new Exception("Numero trop long");

		return $this->numero = $numero;
	}

	public function setRue($rue)
	{
		if (strlen($rue) < 5)		
			throw new Exception("Rue trop court");
		else if (strlen($rue) > 255)		
			throw new Exception("rue trop longue");

		return $this->rue = $rue;
	}

	public function setVille($ville)
	{
		if (strlen($ville) < 5)		
			throw new Exception("ville trop court");
		else if (strlen($ville) > 127)		
			throw new Exception("ville trop longue");

		return $this->ville = $ville;
	}

	public function setPays($pays)
	{
		if (strlen($pays) > 127)		
			throw new Exception("pays trop long");

		return $this->pays = $pays;
	}

	public function setType($type)
	{
		if (($type < 1) || ($type > 2))		
			throw new Exception("Type doit etre 1 ou 2");

		return $this->type = $type;
	}



}
?>