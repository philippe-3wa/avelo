<?php

if (!isset($_GET['option']))
{
	$manager = new AdresseManager($link);
	try
	{
		$adresse = $manager->findAll();
		$count = 0;
		$max = sizeof($adresse);
		while ($count < $max)
		{
			$categorie = $adresse[$count];
			require('views/admin_bloc_adresse_liste.phtml');
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

		$manager = new AdresseManager($link);
		try
		{
			$adresse = $manager->findAll();
			$count = 0;
			$max = sizeof($adresse);
			while ($count < $max)
			{
				$categorie = $adresse[$count];
				require('views/admin_bloc_adresse_liste.phtml');
				$count++;
			}
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}

		if ($option == "ajout_adresse")
			require('views/admin_bloc_adresse_add.phtml');
	}
?>