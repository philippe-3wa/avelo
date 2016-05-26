<?php
if (isset($_POST['email'], $_POST['login'], $_POST['password'], $_POST['prenom'], $_POST['nom'], $_POST['sexe'], $_POST['date_inscription'], $_POST['date_naissance'], $_SESSION['actif'], $_SESSION['admin'] $_SESSION['id']))
{
	if ($_POST['action'] == 'create')
	{
		if (isset($_SESSION['admin']))
		{
			$manager = new UserManager($link);
			try
			{
				$user = $manager->create($_POST);
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
		if (isset($_SESSION['admin']))
		{
			$manager = new UserManager($link);
			try
			{
				$user = $manager->findById($_POST['id']);
				$user->setEmail($_POST['email']);
				$user->setLogin($_POST['login']);
				$user->setPassword($_POST['password']);
				$user->setPrenom($_POST['prenom']);
				$user->setNom($_POST['nom']);
				$user->setSexe($_POST['sexe']);
				$user->setDateNaissance($_POST['date_naissance']);
				$user->setDateInscription($_POST['date_inscription']);
				$user->setActif($_POST['actif']);
				$user->setAdmin($_POST['admin']);
				$manager->update($article);
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
		if (isset($_SESSION['admin']))
		{
			$manager = new UserManager($link);
			try
			{
				$user = $manager->findById($_POST['id']);
				$user->setEmail($_POST['email']);
				$user->setLogin($_POST['login']);
				$user->setPassword($_POST['password']);
				$user->setPrenom($_POST['prenom']);
				$user->setNom($_POST['nom']);
				$user->setSexe($_POST['sexe']);
				$user->setDateNaissance($_POST['date_naissance']);
				$user->setDateInscription($_POST['date_inscription']);
				$user->setActif($_POST['actif']);
				$user->setAdmin($_POST['admin']);
				$manager->remove($article);
				header('Location: index.php');
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