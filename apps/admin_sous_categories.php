<?php
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
?>