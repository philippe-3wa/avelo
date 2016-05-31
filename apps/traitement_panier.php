<?php
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'create')
	{
		$manager = new ProduitManager($link);
		try
		{
			$produit = $manager->create($_POST);
			header('Location: index.php');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
}
else if ($_POST['action'] == 'update')
	{
		if (isset($_SESSION['user']))
		{
			$manager = new ProduitManager($link);
			try
			{
				$produit = $manager->findById($_POST['id']);
				$produit->setDate($_POST['date']);
				$produit->setNbrProduits($_POST['nbr_produits']);
				$produit->setStatu($_POST['statu']);
				$produit->setPrix($_POST['prix']);
				$produit->setPoids($_POST['poids']);
				$produit->setIdUser($_POST['id_user']);
				header('Location: index.php');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
	else if ($_POST['action'] == 'remove')
	{
		if (isset($_SESSION['user']))
		{
			$manager = new produitManager($link);
			try
			{
				$produit = $manager->findById($_POST['id']);
				$manager->remove($produit);
				header('Location: index.php');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
		}
	}
?>