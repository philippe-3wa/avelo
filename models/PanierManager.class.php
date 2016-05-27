<?php
class Panier
{
	private $link;
	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findAll()
	{
		$list = [];
		$request = "SELECT * FROM panier";
		$res = mysqli_query($this->link, $request);
		while ($panier = mysqli_fetch_object($res, "Panier", [$this->link]))
			$list[] = $panier;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM panier WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$panier = mysqli_fetch_object($res, "Panier", [$this->link]);
		return $panier;
	}
	public function findByDate($date)
	{
		$date = mysqli_real_escape_string($this->link, $date);
		$request = "SELECT * FROM panier WHERE date='".$date."'";
		$res = mysqli_query($this->link, $request);
		$panier = mysqli_fetch_object($res, "Panier", [$this->link]);
		return $panier;
	}
	public function findByStatut($statut)
	{
		$statut = mysqli_real_escape_string($this->link, $statut);
		$request = "SELECT * FROM panier WHERE statut='".$statut."'";
		$res = mysqli_query($this->link, $request);
		$panier = mysqli_fetch_object($res, "Panier", [$this->link]);
		return $panier;
	}
	public function findByIdUser($id_user)
	{
		$id_user = mysqli_real_escape_string($this->link, $id_user);
		$request = "SELECT * FROM panier WHERE id_user='".$id_user."'";
		$res = mysqli_query($this->link, $request);
		$panier = mysqli_fetch_object($res, "Panier", [$this->link]);
		return $panier;
	}

	public function verifVariables($date)
	{
	if (!isset($data['date']))
		throw new Exception ("Missing paramater : date");
	if (!isset($data['nbr_produits']))
		throw new Exception ("Missing paramater : nbr_produits");
	if (!isset($data['statut']))
		throw new Exception ("Missing paramater : statut");
	if (!isset($data['prix']))
		throw new Exception ("Missing paramater : prix");
	if (!isset($data['poids']))
		throw new Exception ("Missing paramater : poids");
	if (!isset($data['id_user']))
		throw new Exception ("Missing paramater : id_user");
	}

	public function create($data)
	{
		if (!isset($_SESSION['user']))
			throw new Exception ("Vous devez être connecté");
		$panier = new Panier($this->link);
		
		$this->verifVariables($data);
		$user->setDate($data['date']);
		$user->setNbrProduits($data['nbr_produits']);
		$user->setStatut($data['statut']);
		$user->setPrix($data['prix']);
		$user->setPoids($data['poids']);
		$user->setIdUser($data['id_user']);
	
			$date = $user->getDate();
			$nbr_produits = $user->getNbrProduits();
			$statut = $user->getStatut();
			$prix = $user->getPrix();
			$poids = $user->getPoids();
			$id_user = $user->getIdUser();
			$id = $_SESSION['user'];
			$request = "INSERT INTO user (date, nbr_produits, statut, prix, poids, id_user) VALUES('".$date."', '".$nbr_produits."', '".$statut."', '".$prix."', '".$poids."', '".$id_user."')";
			$res = mysqli_query($this->link, $request);
			if ($res)
			{
				$id = mysqli_insert_id($this->link);
				if ($id)
				{
					$user = $this->findById($id);
					return $panier;
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
	public function update(Panier $panier)
	{
		if (!isset($_SESSION['user']))
			throw new Exception ("Vous devez être connecté");
		$panier = new Panier($this->link);
		$this->verifVariables($data);
		$id = $panier->getId();
		if ($id)
		{
			$date = mysqli_real_escape_string($this->link, $user->getDate());
			$nbr_produits = mysqli_real_escape_string($this->link, $user->getNbrProduits());
			$statut = mysqli_real_escape_string($this->link, $user->getStatut());
			$prix = mysqli_real_escape_string($this->link, $user->getPrix());
			$poids = mysqli_real_escape_string($this->link, $user->getPoids());
			$id_user = mysqli_real_escape_string($this->link, $user->getIdUser());;
			$request = "UPDATE panier SET date='".$date."', nbr_produits='".$nbr_produits."', statut='".$statut."', prix='".$prix."', poids='".$poids."', id_user='".$id_user."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
			{
				DELETE FROM link_panier_produit WHERE id_panier=$id
				$panier->getProduts();
				while
					INSERT INTO link_panier_produit () VALUES()
				return $this->findById($id);
			}
			else
				throw new Exception ("Internal server error");
		}
	}
	public function remove(Panier $panier)
	{
		if (!isset($_SESSION['user']))
			throw new Exception ("Vous devez être connecté");
		$panier = new Panier($this->link);
		$this->verifVariables($data);
		$id = $panier->getId();
		if ($id)
		{
			$request = "DELETE FROM panier WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $panier;
			else
				throw new Exception ("Internal server error");
		}
	}
}
?>