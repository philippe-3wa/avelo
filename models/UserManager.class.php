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
	public function findByPassword($password)
	{
		$password = mysqli_real_escape_string($this->link, $password);
		$request = "SELECT * FROM user WHERE password='".$password."'";
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
			return "Vous devez être connecté";
		$user = new User();
		
		if (!isset($data['email']))
			return "Missing paramater : email";
		if (!isset($data['login']))
			return "Missing paramater : login";
		if (!isset($data['password']))
			return "Missing paramater : password";
		if (!isset($data['prenom']))
			return "Missing paramater : prenom";
		if (!isset($data['nom']))
			return "Missing paramater : nom";
		if (!isset($data['sexe']))
			return "Missing paramater : sexe";
		if (!isset($data['date_naissance']))
			return "Missing paramater : date_naissance";
		if (!isset($data['date_inscription']))
			return "Missing paramater : date_inscription";
		if (!isset($data['actif']))
			return "Missing paramater : actif";
		if (!isset($data['admin']))
			return "Missing paramater : admin";
		$error = $user->setEmail($data['email']);
		$error = $user->setLogin($data['login']);
		$error = $user->setPassword($data['password']);
		$error = $user->setPrenom($data['prenom']);
		$error = $user->setNom($data['nom']);
		$error = $user->setSexe($data['sexe']);
		$error = $user->setDateNaissance($data['date_naissance']);
		$error = $user->setDateInscription($data['date_inscription']);
		$error = $user->setActif($data['actif']);
		$error = $user->setAdmin($data['admin']);
		if ($error)
			return $error;
		else
		{
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
					return "Internal server error";
			}
			else
				return "Internal server error";
		}
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
				return "Internal server error";
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
				return "Internal server error";
		}
	}
}
?>