<?php
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'create')
	{
		$manager = new UserManager($link);
		try
		{
			$user = $manager->create($_POST);
			header('Location: index.php?page=user&message=ok');
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


	if($_POST['action'] == 'update_user')
	{
		if (isset($_SESSION['id']))
		{
			if ($_SESSION['id'] == $_POST['id'])
			{
				$manager = new UserManager($link);
				$user = $manager->findById($_POST['id']);

				try
				{	
									
					$password1 =$_POST['password1']; 
					$password1 = $user->verifyPassword($password1);
					if (!$password1)
					{
						header('Location: index.php?page=error');
						exit;
					}
				
					if ($_POST['password2'] != "")
					{
						$password2 = $_POST['password2'];
						$password3 = $_POST['password3'];
						if ($password2 != $password3) 
						{
							header('Location: index.php?page=error');
							exit;
						}
						else
							$password = $user->setPassword($password2);

					}

					$login = $user->setLogin($_POST['login']);
					$email = $user->setEmail($_POST['email']);
					$actif = $user->setActif($_POST['actif']);
					$manager->ProfileUpdate($user);

					if ($_POST['actif'] == '0')
					{
						header('location:index.php?page=user&action=logout');
						exit;
					}
					else 
					{
						header('Location: index.php?page=profil&message=ok');
						exit;
					}
					
									
				}
				catch (Exception $exception)
				{
					$error = $exception->getMessage();
				}
			}
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