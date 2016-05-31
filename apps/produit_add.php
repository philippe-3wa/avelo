<?php
$manager = new CategorieManager($link);
	try
	{
		$categories = $manager->findAll();
		$count = 0;
		$max = sizeof($categories);
		while ($count < $max)
		{
			$variable = $categories[$count];

			$sous_categorie = $categorie->getSousCategories(1);

			require('views/admin_bloc_produit_add_liste_sous_categorie.phtml');
			$count++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
?>