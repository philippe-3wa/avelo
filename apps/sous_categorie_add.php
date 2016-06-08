<?php
	$manager = new CategorieManager($link);
	if (!isset($firstCategorie))
		$firstCategorie = null;
	$categories = $manager->findAll();
	$count = 0;
	$max = sizeof($categories);
	while ($count < $max)
	{
		$categorie = $categories[$count];
		if ($firstCategorie === null)
			$firstCategorie = $categorie;
		require('views/admin_bloc_sous_categorie_add_liste_categorie.phtml');

		$count++;
	}
?>