<?php
if (!isset($_GET['action']))
{$manager = new UserManager($link);
	try
	{
		$users = $manager->findAll();
		$count = 0;
		$max = sizeof($users);
		while ($count < $max)
		{
			$user = $users[$count];
			require('views/admin_gestion_user.phtml');
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
		$action = $_GET['action'];

		if ($action == "edit_user")
			require('views/admin_edit_user.phtml');
	}
?>