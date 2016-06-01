<?php
if (!isset($_SESSION['admin']))
{
	header('Location: index.php');
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
				header('Location: index.php?page=admin');
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
					header('Location: index.php?page=admin');
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
				header('Location: index.php?page=admin');
				exit;
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
				header('Location: index.php?page=admin');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
}
?>