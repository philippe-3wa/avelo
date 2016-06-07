<?php
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'create')
	{
		if (isset($_SESSION['id']))
		{
			$manager = new AdresseManager($link);
			try
			{
				$adresse = $manager->create($_POST);
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
		if (isset($_SESSION['id']))
		{
			$manager = new AdresseManager($link);
			try
			{
				$adresse = $manager->findById($_POST['id']);
				$adresse->setNom($_POST['nom']);
				$adresse->setNumero($_POST['numero']);
				$adresse->setRue($_POST['rue']);
				$adresse->setCp($_POST['cp']);
				$adresse->setVille($_POST['ville']);
				$adresse->setPays($_POST['pays']);
				$adresse->setTelephone($_POST['telephone']);
				$adresse->setType($_POST['type']);
				$adresse->setIdUser($_POST['id_user']);
				$manager->update($adresse);
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
		if (isset($_SESSION['id'], $_POST['id']))
		{
			$manager = new AdresseManager($link);
			try
			{
				$adresse = $manager->findById($_POST['id']);
				$manager->remove($adresse);
				header('Location: index.php?page=adresse');
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