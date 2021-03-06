<?php
if (isset($_POST['action'], $_SESSION['id']))
{
	if ($_POST['action'] == 'create')
	{
		if (isset($_SESSION['id']))
		{
			$manager = new AdresseManager($link);
			try
			{
				$adresse = $manager->create($_POST);
				header('Location: index.php?page=adresse');
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
		if (!isset($_POST['id']))
			require('views/error.phtml');

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
				$manager->update($adresse);
				header('Location: index.php?page=adresse');
				exit;
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
	}

}
else if (isset($_GET['option'], $_SESSION['id'], $_GET['id']))
{
	$option = $_GET['option'];

 	if ($option == 'remove')
	{
		
			$manager = new AdresseManager($link);
			try
			{
				$adresse = $manager->findById($_GET['id']);
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
?>