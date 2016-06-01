<?php

if (!isset($_GET['option']))
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
			require('views/admin_bloc_categorie_liste.phtml');
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

		$manager = new CategorieManager($link);
		try
		{
			$categories = $manager->findAll();
			$count = 0;
			$max = sizeof($categories);
			while ($count < $max)
			{
				$categorie = $categories[$count];
				require('views/admin_bloc_categorie_liste.phtml');
				$count++;
			}
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}

	}
?>