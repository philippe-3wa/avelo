<?php

if (!isset($_GET['action']))
{
	$manager = new CategorieManager($link);
	try
	{
		$categories = $manager->findAll();
		$count = 0;
		$max = sizeof($categories);
		while ($count < $max)
		{
			$categorie = $categories[$count];
			require('views/admin_categorie.phtml');
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

		if ($action == "ajout_acategorie")
		{
			require('views/admin_add_categorie.phtml');
		}
	}
?>