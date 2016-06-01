<?php
if (!isset($_GET['action']))
{
	$manager = new UserManager($link);
	try
	{
		$users = $manager->findAll();
		$count = 0;
		$max = sizeof($users);
		while ($count < $max)
		{
			$user = $users[$count];
			require('views/admin_bloc_user_liste.phtml');
			$count++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
}
else
	{
		$option = $_GET['option'];

		$manager = new UserManager($link);
		try
		{
			$users = $manager->findAll();
			$count = 0;
			$max = sizeof($users);
			while ($count < $max)
			{
				$user = $users[$count];
				require('views/admin_bloc_user_liste.phtml');
				$count++;
			}
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}

		if ($option == "edit_user")
			require('views/admin_bloc_user_edit.phtml');
	}
?>