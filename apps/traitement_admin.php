<?php
if (!isset($_SESSION['admin']))
{
	header('Location: index.php?page=user&action=logout');
	exit;
}
else
{
	if (isset($_POST['action']))
	{
		$action = $_POST['action'];

		if ($action == "categorie_add")
		{
			$manager = new CategorieManager($link);
			try
			{
				$categorie = $manager->create($_POST);
				header('Location: index.php?page=admin&bloc=categorie');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}

		else if ($action == "categorie_edit")
		{
			$manager = new CategorieManager($link);
			try
			{
				$categorie = $manager->findById($_POST['id']);
				if ($categorie)
				{
					$categorie->setNom($_POST['nom']);
					$categorie->setDescription($_POST['description']);
					$categorie->setActif($_POST['actif']);
					$manager->update($categorie);
					header('Location: index.php?page=admin&bloc=categorie');
					exit;
				}
				else
					$error = 'Categorie invalide';
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}

		else if ($action == "sous_categorie_add")
		{
			$manager = new SousCategorieManager($link);
			try
			{
				$sous_categorie = $manager->create($_POST);
				header('Location: index.php?page=admin&bloc=sous_categorie');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
		else if ($action == "sous_categorie_edit")
		{
			$manager = new SousCategorieManager($link);
			try
			{
				$sous_categorie = $manager->findById($_POST['id']);
				if ($sous_categorie)
				{
					$sous_categorie->setNom($_POST['nom']);
					$sous_categorie->setDescription($_POST['description']);
					$sous_categorie->setIdCategorie($_POST['id_categorie']);
					$sous_categorie->setActif($_POST['actif']);
					$manager->update($sous_categorie);
					header('Location: index.php?page=admin&bloc=sous_categorie');
					exit;
				}
				else
					$error = 'Sous Categorie invalide';
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}

		else if ($action == "produit_add")
		{
			$manager = new ProduitManager($link);
			try
			{
				$produit = $manager->create($_POST);
				header('Location: index.php?page=admin&bloc=produit');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
		else if ($action == "produit_edit")
		{
			$manager = new ProduitManager($link);
			try
			{
				$produit = $manager->findById($_POST['id']);
				if ($produit)
				{

					$produit->setReference($_POST['reference']);
					$produit->setNom($_POST['nom']);
					$produit->setDescription($_POST['description']);
					$produit->setPrix($_POST['prix']);
					$produit->setTva($_POST['tva']);
					$produit->setPhoto($_POST['photo']);
					$produit->setPoids($_POST['poids']);
					$produit->setActif($_POST['actif']);
					$produit->setStock($_POST['stock']);
					$produit->setIdSousCategorie($_POST['id_sous_categorie']);
					//$produit->setIdCategorie($_POST['id_categorie']);
					//$produit->setAvis($_POST['avis']);
					$manager->update($produit);
					header('Location: index.php?page=admin&bloc=produit');
					exit;
				}
				else
					$error = 'Produit invalide';
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}

		else if ($option == "update")
		{
			$manager = new UserManager($link);
			try
			{
				$user = $manager->findById('id');
				if ($user)
				{
					$user->setActif($_POST['actif']);
					$manager->remove($user);
					header('Location: index.php?page=admin');
					exit;
				}
				else
					$error = 'User inconnu';
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
}
?>
