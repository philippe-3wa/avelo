<?php
	$id = $_GET['id'];

	$sous_categories = $categorie->getSousCategories();

	$count = 0;
	$max = sizeof($sous_categories);
	while ($count < $max)
	{
		$sous_categorie = $sous_categories[$count];
		require('views/admin_bloc_produit_add_liste_sous_categorie.phtml');
		$count++;
	}

?>