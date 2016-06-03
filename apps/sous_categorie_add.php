<?php
$manager = new CategorieManager($link);
	
	$categories = $manager->findAll();
	$count = 0;
	$max = sizeof($categories);
	while ($count < $max)
	{
		$categorie = $categories[$count];
		$toto = "";
		require('views/admin_bloc_sous_categorie_add_liste_categorie.phtml');

		$count++;
	}
?>