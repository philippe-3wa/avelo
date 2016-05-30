<?php
$manager = new UserManager($link);
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
?>