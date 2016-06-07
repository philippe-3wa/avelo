<?php
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'create')
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

	if ($_POST['action'] == 'login')
	{
		$manager = new UserManager($link);
		try
		{
			$user = $manager->login($_POST);
			header('Location: index.php');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
}

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'logout')
	{
		session_destroy();
		header('Location: index.php?page=home');
		exit;
	}
}
if (isset($_GET['option']))
{
	if ($_GET['option'] == 'update')
	{
		$manager = new UserManager($link);
		try
		{
			$id = intval($_GET['id']);
			$user = $manager->findById($id);
		

			$actif = $user->getActif();
			if ($actif == 0)
				$actif = 1;
			else
				$actif = 0;

			$user->setActif($actif);

			$manager->update($user);

			header('Location: index.php?page=admin&bloc=user');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
}
?>