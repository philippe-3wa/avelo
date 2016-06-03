<?php
if (isset($_GET['action']))
{
	$option = $_GET['option'];
}

	$manager = new UserManager($link);

		$users = $manager->findAll();
		$count = 0;
		$max = sizeof($users);
		while ($count < $max)
		{
			$user = $users[$count];
			require('views/admin_bloc_user_liste.phtml');
			$count++;
		}

?>