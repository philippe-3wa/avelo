<?php
$manager = new CategorieManager($link);
	try
	{
		$categories = $manager->findAll();
		$count = 0;
		$max = sizeof($categories);
		while ($count < $max)
		{
			$categorie = getSousCategories();
			$categorie = $categories[$count];
			require('views/admin_bloc_produit_add_liste_sous_categorie.phtml');
			$count++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
?>