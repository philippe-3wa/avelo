<?php
class User
{
	private $id;
	private $email;
	private $login;
	private $password;
	private $prenom;
	private $nom;
	private $sexe;
	private $date_naissance;
	private $date_inscription;
	private $actif;
	private $admin;

	public function getId()
	{
		return $this->id;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getLogin()
	{
		return $this->login;
	}
	private function getPassword()
	{
		return $this->password;
	}
	public function getPrenom()
	{
		return $this->prenom;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getSexe()
	{
		return $this->sexe;
	}
	public function getDateNaissance()
	{
		return $this->date_naissance;
	}
	private function getDateInscription()
	{
		return $this->date_inscription;
	}
	private function getActif()
	{
		return $this->actif;
	}
	private function getAdmin()
	{
		return $this->admin;
	}

	public function setEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false)
		$error = 'Email non valide';
		$this->email = $email;
	}
	public function setLogin($login)
	{
		if (strlen($login) < 4)
			return "Login trop court (< 4)";
		else if (strlen($login) > 15)
			return "Login trop long (> 15)";
		$this->login = $login;
	}
	public function setPassword($password)
	{
		if (strlen($password) < 4)
			return "Mot de passe trop court (< 4)";
		else if (strlen($password) > 255)
			return "Mot de passe trop long (> 255)";
		$this->password = $password;
	}
	public function setPrenom($prenom)
	{
		if (strlen($prenom) < 2)
			return "Prénom trop court (< 2)";
		else if (strlen($prenom) > 63)
			return "Prénom trop long (> 63)";
		$this->prenom = $prenom;
	}
	public function setNom($nom)
	{
		if (strlen($nom) < 4)
			return "Nom trop court (< 4)";
		else if (strlen($nom) > 63)
			return "Nom trop long (> 63)";
		$this->nom = $nom;
	}
	public function setDateNaissance($date_naissance)
	{
		if (strlen($date_naissance) < 9)
			return "Date de naissance trop courte (< 9)";
		else if (strlen($date_naissance) > 11)
			return "Date de naissance trop longue (> 11)";
		$this->date_naissance = $date_naissance;
	}
	public function setActif($actif)
	{
		$actif = intval($actif);
		if (($actif < 0) || ($actif > 1))
			return "actif doit être = à 0 ou 1";
		$this->actif = $actif;
	}
	public function setAdmin($admin)
	{
		if ($admin = 1)
			return "admin doit être = 1";
		$this->admin = $admin;
	}

}
?>