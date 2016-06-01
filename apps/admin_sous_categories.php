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
			require('views/admin_bloc_sous_categorie_liste.phtml');
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

		$manager = new SousCategorieManager($link);
		try
		{
			$sous_categories = $manager->findAll();
			$count = 0;
			$max = sizeof($sous_categories);
			while ($count < $max)
			{
				$sous_categorie = $sous_categories[$count];
				require('views/admin_bloc_sous_categorie_liste.phtml');
				$count++;
			}
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}

		if ($option == "ajout_sous_categorie")
			require('views/admin_bloc_sous_categorie_add.phtml');
		else if ($option == "edit_sous_categorie")
			require('views/admin_bloc_sous_categorie_edit.phtml');
	}
?>