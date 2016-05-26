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
		while ($adresse = mysqli_fetch_object($res, "Adresse"))
			$list[] = $adresse;
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$request = "SELECT * FROM adresse WHERE id=".$id;
		$res = mysqli_query($this->link, $request);
		$adresse = mysqli_fetch_object($res, "Adresse");
		return $adresse;
	}
	public function findByType($type) // pareil, faut ajouter pour un seul ID ms je sais pas comment
	{
		$type = mysqli_real_escape_string($this->link, $type);
		$request = "SELECT * FROM adresse WHERE type='".$type."'";
		$res = mysqli_query($this->link, $request);
		$adresse = mysqli_fetch_object($res, "Adresse");
		return $adresse;
	}
	public function create($data)
	{
		if (!isset($_SESSION['id']))
			return "Vous devez être connecté";
		$adresse = new Adresse();
		// Choix 1
		if (isset($data['title']))
			$error = $adresse->setTitle($data['title']);
		else
			return "Missing paramater : title";
		if (isset($data['content']))
			$error = $article->setContent($data['content']);
		else
			return "Missing paramater : content";
		// OU Choix 2
		if (!isset($data['nom']))
			return "Remplir le champs : nom";
		if (!isset($data['numéro']))
			return "Remplir le champs : numéro de rue";
		if (!isset($data['rue']))
			return "Remplir le champs : rue";
		if (!isset($data['cp']))
			return "Remplir le champs : CP";
		if (!isset($data['ville']))
			return "Remplir le champs : ville";
		if (!isset($data['pays']))
			return "Remplir le champs : pays";
		if (!isset($data['telephone']))
			return "Remplir le champs : téléphone";
		if (!isset($data['type']))
			return "Remplir le champs : type d'adresse";
		$error = $article->setTitle($data['title']);
		$error = $article->setContent($data['content']);
		if ($error)
			return $error;
		else
		{
			$title = $article->getTitle();
			$content = $article->getContent();
			$id_author = $_SESSION['id'];
			$request = "INSERT INTO article (title, content, id_author) VALUES('".$title."', '".$content."', '".$id_author."')";
			$res = mysqli_query($this->link, $request);
			if ($res)// Si la requete s'est bien passée
			{
				$id = mysqli_insert_id($this->link);
				if ($id)// si c'est bon id > 0
				{
					$article = $this->findById($id);
					return $article;
				}
				else// Sinon
					return "Internal server error";
			}
			else// Sinon
				return "Internal server error";
		}
	}
	public function getById($id)
	{
		return $this->findById($id);
	}
	public function update(Article $article)// type-hinting
	{
		$id = $article->getId();
		if ($id)// true si > 0
		{
			$title = mysqli_real_escape_string($this->link, $article->getTitle());
			$content = mysqli_real_escape_string($this->link, $article->getContent());
			$request = "UPDATE article SET title='".$title."', content='".$content."' WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $this->findById($id);
			else
				return "Internal server error";
		}
	}
	public function remove(Article $article)
	{
		$id = $article->getId();
		// droit ? admin ? access ?
		if ($id)// true si > 0
		{
			$request = "DELETE FROM article WHERE id=".$id;
			$res = mysqli_query($this->link, $request);
			if ($res)
				return $article;
			else
				return "Internal server error";
		}
	}
}
?>