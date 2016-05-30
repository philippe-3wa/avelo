<?php
if (!isset($_GET['action']))
{
	$manager = new SousCategorieManager($link);
	try
	{
		$sous_categories = $manager->findAll();
		$count = 0;
		$max = sizeof($sous_categories);
		while ($count < $max)
		{
			$sous_categorie = $sous_categories[$count];
			require('views/admin_sous_categories.phtml');
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

		if ($action == "ajout_sous_categorie")
			require('views/admin_add_sous_categorie.phtml');
		else if ($action == "edit_sous_categorie")
			require('views/admin_edit_sous_categorie.phtml');
	}
?>