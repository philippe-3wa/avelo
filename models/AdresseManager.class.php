<?php
class AdresseManager
{
	private $link;

	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findAll() // faut ajouter pour un seul ID ms je sais pas comment
	{
		$list = [];
		$request = "SELECT * FROM adresse";
		$res = mysqli_query($this->link, $request);
		while ($adresse = mysqli_fetch_object($res, "Adresse", [$this->link]))
			$list[] = $adresse;
		return $list;
	}
	public function findbyUser(User $user) // faut ajouter pour un seul ID ms je sais pas comment
	{
		$list = [];
		$id = $user->getId();
		$request = "SELECT * FROM adresse WHERE id_user=".$id;
		$res = mysqli_query($this->link, $request);
		while ($adresse = mysqli_fetch_object($res, "Adresse", [$this->link]))
			$list[] = $adresse;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM adresse WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$adresse = mysqli_fetch_object($res, "Adresse", [$this->link]);
		return $adresse;
	}
	public function findByType($type) // pareil, faut ajouter pour un seul ID ms je sais pas comment
	{
		$type = mysqli_real_escape_string($this->link, $type);
		$request = "SELECT * FROM adresse WHERE type='".$type."'";
		$res = mysqli_query($this->link, $request);
		$adresse = mysqli_fetch_object($res, "Adresse", [$this->link]);
		return $adresse;
	}
	public function create($data)
	{
		if (!isset($_SESSION['id']))
			throw new Exception("Vous devez être connecté");
		
		$adresse = new Adresse($this->link);

		if (!isset($data['nom']))
			throw new Exception("Remplir le champs : nom");
		if (!isset($data['numero']))
			throw new Exception("Remplir le champs : numéro de rue");
		if (!isset($data['rue']))
			throw new Exception("Remplir le champs : rue");
		if (!isset($data['cp']))
			throw new Exception("Remplir le champs : CP");
		if (!isset($data['ville']))
			throw new Exception("Remplir le champs : ville");
		if (!isset($data['pays']))
			throw new Exception("Remplir le champs : pays");
		if (!isset($data['telephone']))
			throw new Exception("Remplir le champs : téléphone");

		
		$adresse->setNom($data['nom']);
		$adresse->setNumero($data['numero']);
		$adresse->setRue($data['rue']);
		$adresse->setCp($data['cp']);
		$adresse->setVille($data['ville']);
		$adresse->setPays($data['pays']);
		$adresse->setTelephone($data['telephone']);
		
		$nom = mysqli_real_escape_string($this->link, $adresse->getNom());
		$numero = intval($adresse->getNumero());
		$rue = mysqli_real_escape_string($this->link, $adresse->getRue());
		$cp = intval($adresse->getCp());
		$ville = mysqli_real_escape_string($this->link, $adresse->getVille());
		$pays = mysqli_real_escape_string($this->link, $adresse->getPays());
		$telephone = mysqli_real_escape_string($this->link, $adresse->gettelephone());
		$id_user = $_SESSION['id'];	// à vérifier

		$request = "INSERT INTO adresse (nom, numero, rue, cp, ville, pays, telephone, id_user) VALUES('".$nom."', '".$numero."', '".$rue."', '".$cp."', '".$ville."', '".$pays."', '".$telephone."', '".$id_user."')";

			$res = mysqli_query($this->link, $request);
			if ($res)// Si la requete s'est bien passée
			{
				$id = mysqli_insert_id($this->link);
				if ($id)// si c'est bon id > 0
				{
					$adresse = $this->findById($id);
					return $adresse;
				}
				else// Sinon
					throw new Exception("Internal server error");
			}
			else// Sinon
				throw new Exception("Internal server error");
		
	}
	public function getById($id)
	{
		return $this->findById($id);
	}

	public function update(Adresse $adresse)// type-hinting
	{
		$id = $adresse->getId();
		if ($id)// true si > 0
		{
			$nom = mysqli_real_escape_string($this->link, $adresse->getNom());
			$numero = mysqli_real_escape_string($this->link, $adresse->getNumero());
			$rue = mysqli_real_escape_string($this->link, $adresse->getRue());
			$cp = mysqli_real_escape_string($this->link, $adresse->getCp());
			$ville = mysqli_real_escape_string($this->link, $adresse->getVille());
			$pays = mysqli_real_escape_string($this->link, $adresse->getPays());
			$telephone = mysqli_real_escape_string($this->link, $adresse->getTelephone());

			$request = "UPDATE adresse SET nom='".$nom."', numero='".$numero."',rue='".$rue."',cp='".$cp."',ville='".$ville."',pays='".$pays."',telephone='".$telephone."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception("Internal server error");
		}
	}
	public function remove(Adresse $adresse)
	{
		$id = $adresse->getId();
		if ($id)
		{
			$request = "DELETE FROM adresse WHERE id='".$id."' LIMIT 1";
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $adresse;
			else
				throw new Exception("Internal server error");
		}
	}
}
?>