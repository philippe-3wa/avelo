<?php
class UserManager
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
		while ($user = mysqli_fetch_object($res, "User", [$this->link]))
			$list[] = $user;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM user WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User", [$this->link]);
		return $user;
	}
	public function findByEmail($email)
	{
		$email = mysqli_real_escape_string($this->link, $email);
		$request = "SELECT * FROM user WHERE email='".$email."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User", [$this->link]);
		return $user;
	}
	public function findByCredentials($email, $login)
	{
		$email = mysqli_real_escape_string($this->link, $email);
		$login = mysqli_real_escape_string($this->link, $login);
		$request = "SELECT * FROM user WHERE email='".$email."' OR login='".$login."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User", [$this->link]);
		return $user;
	}
	public function findByLogin($login)
	{
		$login = mysqli_real_escape_string($this->link, $login);
		$request = "SELECT * FROM user WHERE login='".$login."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User", [$this->link]);
		return $user;
	}
	public function findByPrenom($prenom)
	{
		$prenom = mysqli_real_escape_string($this->link, $prenom);
		$request = "SELECT * FROM user WHERE prenom='".$prenom."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User", [$this->link]);
		return $user;
	}
	public function findByNom($nom)
	{
		$nom = mysqli_real_escape_string($this->link, $nom);
		$request = "SELECT * FROM user WHERE nom='".$nom."'";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User", [$this->link]);
		return $user;
	}

	public function verifVariables($data)
	{
	if (!isset($data['email']))
		throw new Exception ("Missing paramater : email");
	if (!isset($data['login']))
		throw new Exception ("Missing paramater : login");
	if (!isset($data['password1']))
		throw new Exception ("Missing paramater : password1");
	if (!isset($data['password2']))
		throw new Exception ("Missing paramater : password2");
	if ($data['password1'] != $data['password2'])
		throw new Exception ("les passwords ne correspondent pas");
	if (!isset($data['prenom']))
		throw new Exception ("Missing paramater : prenom");
	if (!isset($data['nom']))
		throw new Exception ("Missing paramater : nom");
	if (!isset($data['sexe']))
		throw new Exception ("Missing paramater : sexe");
	if (!isset($data['date_naissance']))
		throw new Exception ("Missing paramater : date_naissance");
	}

	public function create($data)
	{
		$user = new User($this->link);
		
		$this->verifVariables($data);

		$user->setEmail($data['email']);
		$user->setLogin($data['login']);
		$user->setPassword($data['password1']);
		$user->setPrenom($data['prenom']);
		$user->setNom($data['nom']);
		$user->setSexe($data['sexe']);
		$user->setDateNaissance($data['date_naissance']);
	
		$email = mysqli_real_escape_string($this->link, $user->getEmail());
		$login = mysqli_real_escape_string($this->link, $user->getLogin());
		$password = $user->getPassword();
		$prenom = mysqli_real_escape_string($this->link, $user->getPrenom());
		$nom = mysqli_real_escape_string($this->link, $user->getNom());
		$sexe = intval($user->getSexe());
		$date_naissance = $user->getDateNaissance();
		$request = "INSERT INTO user (email, login, password, prenom, nom, sexe, date_naissance) VALUES('".$email."', '".$login."', '".$password."', '".$prenom."', '".$nom."', '".$sexe."', '".$date_naissance."')";
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
		if (!isset($_SESSION['admin']))
			throw new Exception ("Vous devez être connecté");
		
		$id = $user->getId();
		if ($id)
		{
			$actif = $user->getActif();
			$request = "UPDATE user SET actif='".$actif."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception ("Internal server error");
		}else
			throw new Exception ("Internal server error2");

	}


	public function login($data)
	{
		if (!isset($data['login']) || empty($data['login']))
			throw new Exception ("Missing paramater : login");
		if (!isset($data['password']) || empty($data['password']))
			throw new Exception ("Missing paramater : password");

		$login = mysqli_real_escape_string($this->link, $data['login']);
		$password = mysqli_real_escape_string($this->link, $data['password']);
		$request = "SELECT * FROM user WHERE login='".$login."' AND actif=1 LIMIT 1";
		$res = mysqli_query($this->link, $request);
		$user = mysqli_fetch_object($res, "User", [$this->link]);
		if ($user)
		{
			$verif_password = $user->verifyPassword($password);
			if ($verif_password)
			{
				$_SESSION['id'] = $user->getID();
				$_SESSION['login'] = $user->getLogin();

				$is_admin = $user->isAdmin($user->getAdmin());
				if ($is_admin)
					$_SESSION['admin'] = $user->getAdmin();

				return $user;
			}
			else
				throw new Exception("Incorrect password");
		}
		else
			throw new Exception("User not found");
	}

	public function ProfileUpdate(User $user)
	{
		if (!isset($_SESSION['id']))
			throw new Exception ("Vous devez être connecté");
		
		$id = $user->getId();
		if ($id)
		{
			$login = $user->getLogin();
			$email = $user->getEmail();
			$password = $user->getPassword();
			$actif = $user->getActif();
			$request = "UPDATE user SET login='".$login."', email='".$email."', password='".$password."', actif='".$actif."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception ("Internal server error");
		}else
			throw new Exception ("Internal server error2");

	}
}
?>