<?php
$manager = new CategorieManager($link);

	$categories = $manager->findAll();
	$count = 0;
	$max = sizeof($categories);
	while ($count < $max)
	{
		$categorie = $categories[$count];


		require('views/admin_bloc_produit_add_liste_sous_categorie.phtml');
		$count++;
	}
?>