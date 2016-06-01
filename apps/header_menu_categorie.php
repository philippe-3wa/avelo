<?php

$manager = new CategorieManager($link);
	try
	{
		$categories = $manager->findAll();
		$count = 0;	
		$max = sizeof($categories);
		while ($count < $max)
		{
			$categorie = $categories[$count];
			require('views/header_menu_categorie.phtml');
			$count++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}

/*
	$manager = new SousCategorieManager($link);
	try
	{
		$sous_categories = $manager->findAllGroup();
		$count = 0;
		$max = sizeof($sous_categories);
		while ($count < $max)
		{
			$sous_categorie = $sous_categories[$count];
			require('views/header_menu_sous_categorie.phtml');
			$count++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
*/
?>