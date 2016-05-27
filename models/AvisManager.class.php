<?php
// models/AvisManager.class.php
class AvisManager
{
	private $link;

	// $this->link <===> $link index.php
	public function __construct($link)
	{
		$this->link = $link;
	}

	public function findAll()
	{
		$list = [];
		$request = "SELECT * FROM avis";
		$res = mysqli_query($this->link, $request);
		while ($avis = mysqli_fetch_object($res, "Avis", [$this->link]))
			$list[] = $avis;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM avis WHERE id=".$id;
		// SELECT * FROM avis WHERE id=1
		$res = mysqli_query($this->link, $request);
		$avis = mysqli_fetch_object($res, "Avis", [$this->link]);
		return $avis;
	}
	public function findByProduit(Produit $produit)
	{
		$id=$produit->getId();
		$list = [];
		$request = "SELECT * FROM avis WHERE id_produit=".$id;
		$res = mysqli_query($this->link, $request);
		while ($avis = mysqli_fetch_object($res, "Avis", [$this->link]))
			$list[] = $avis;
		return $list;
	}
	public function findByNote($note)
	{
		$note = mysqli_real_escape_string($this->link, $note);
		$request = "SELECT * FROM avis WHERE note='".$note."'";
		$res = mysqli_query($this->link, $request);
		$avis = mysqli_fetch_object($res, "Avis", [$this->link]);
		return $avis;
	}
	public function create($data)
	{
		if (!isset($_SESSION['id']))
			throw new Exception ("Vous devez être connecté");
		$avis = new Avis($this->link);

		if (!isset($data['contenu']))
			throw new Exception ("Missing paramater : contenu");
		if (!isset($data['note']))
			throw new Exception ("Missing paramater : note");
		// 
		$error = $avis->setnote($data['note']);
		$error = $avis->setContenu($data['contenu']);
		// 
		if ($error)
			return $error;
		else
		{
			$note = $avis->getNote();
			$contenu = $avis->getContenu();
			$id_author = $_SESSION['id'];
			$request = "INSERT INTO avis (note, contenu, id_author) VALUES('".$note."', '".$contenu."', '".$id_author."')";
			$res = mysqli_query($this->link, $request);
			if ($res)// Si la requete s'est bien passée
			{
				$id = mysqli_insert_id($this->link);
				if ($id)// si c'est bon id > 0
				{
					$avis = $this->findById($id);
					return $avis;
				}
				else // Sinon
					throw new Exception ("Internal server error");
			}
			else // Sinon
				throw new Exception ("Internal server error");
		}
	}
	public function getById($id)
	{
		return $this->findById($id);
	}
	public function update(Avis $avis)// type-hinting
	{
		$id = $avis->getId();
		if ($id)// true si > 0
		{
			$note = mysqli_real_escape_string($this->link, $avis->getNote());
			$contenu = mysqli_real_escape_string($this->link, $avis->getContenu());
			$request = "UPDATE avis SET note='".$note."', contenu='".$contenu."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				throw new Exception ("Internal server error");
		}
	}
	public function remove(Avis $avis)
	{
		$id = $avis->getId();
		// droit ? admin ? access ?
		if ($id)// true si > 0
		{
			$request = "DELETE FROM avis WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $avis;
			else
				throw new Exception ("Internal server error");
		}
	}
}
?>