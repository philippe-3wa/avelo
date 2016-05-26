<?php
class User
{
	private $link;
	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findAll()
	{
		$list = [];
		$request = "SELECT * FROM user";
		$res = mysqli_query($this->link, $request);
		while ($user = mysqli_fetch_object($res, "User"))
			$list[] = $user;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM user WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User");
		return $user;
	}
	public function findByEmail($email)
	{
		$email = mysqli_real_escape_string($this->link, $email);
		$request = "SELECT * FROM user WHERE email='".$email."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User");
		return $user;
	}
	public function findByLogin($login)
	{
		$login = mysqli_real_escape_string($this->link, $login);
		$request = "SELECT * FROM user WHERE login='".$login."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User");
		return $user;
	}
	public function findByPrenom($prenom)
	{
		$prenom = mysqli_real_escape_string($this->link, $prenom);
		$request = "SELECT * FROM user WHERE prenom='".$prenom."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User");
		return $user;
	}
	public function findByNom($nom)
	{
		$nom = mysqli_real_escape_string($this->link, $nom);
		$request = "SELECT * FROM user WHERE nom='".$nom."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User");
		return $user;
	}
	public function create($data)
	{
		if (!isset($_SESSION['id']))
			throw new Exception ("Vous devez être connecté");
		$user = new User();
		
		if (!isset($data['email']))
			throw new Exception ("Missing paramater : email");
		if (!isset($data['login']))
			throw new Exception ("Missing paramater : login");
		if (!isset($data['password']))
			throw new Exception ("Missing paramater : password");
		if (!isset($data['prenom']))
			throw new Exception ("Missing paramater : prenom");
		if (!isset($data['nom']))
			throw new Exception ("Missing paramater : nom");
		if (!isset($data['sexe']))
			throw new Exception ("Missing paramater : sexe");
		if (!isset($data['date_naissance']))
			throw new Exception ("Missing paramater : date_naissance");
		if (!isset($data['date_inscription']))
			throw new Exception ("Missing paramater : date_inscription");
		if (!isset($data['actif']))
			throw new Exception ("Missing paramater : actif");
		if (!isset($data['admin']))
			throw new Exception ("Missing paramater : admin");
		$user->setEmail($data['email']);
		$user->setLogin($data['login']);
		$user->setPassword($data['password']);
		$user->setPrenom($data['prenom']);
		$user->setNom($data['nom']);
		$user->setSexe($data['sexe']);
		$user->setDateNaissance($data['date_naissance']);
		$user->setDateInscription($data['date_inscription']);
		$user->setActif($data['actif']);
		$user->setAdmin($data['admin']);
	
			$email = $user->getEmail();
			$login = $user->getLogin();
			$password = $user->getPassword();
			$prenom = $user->getPrenom();
			$nom = $user->getNom();
			$sexe = $user->getSexe();
			$date_naissance = $user->getDateNaissance();
			$date_inscription = $user->getDateInscription();
			$id = $_SESSION['id'];
			$request = "INSERT INTO user (email, login, password, prenom, nom, sexe, date_inscription, date_naissance, actif, admin) VALUES('".$email."', '".$login."', '".$password."', '".$prenom."', '".$nom."', '".$sexe."', '".$date_inscription."')";
			$res = mysqli_query($this->link, $request);
			if ($res)
			{
				$id = mysqli_insert_id($this->link);
				if ($id)
				{
					$user = $this->findById($id);
					return $user;
				}
				else
					throw new Exception ("Internal server error");
			}
			else
				throw new Exception ("Internal server error");
	}
	public function getById($id)
	{
		return $this->findById($id);
	}
	public function update(User $user)
	{
		$id = $user->getId();
		if ($id)
		{
			$email = mysqli_real_escape_string($this->link, $user->getEmail());
			$password = mysqli_real_escape_string($this->link, $user->getPassword());
			$request = "UPDATE user SET email='".$email."', password='".$password."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception ("Internal server error");
		}
	}
	public function remove(User $user)
	{
		$id = $user->getId();
		if ($id)
		{
			$request = "DELETE FROM user WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $user;
			else
				throw new Exception ("Internal server error");
		}
	}
}
?>