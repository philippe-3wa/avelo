<?php
$sous_categories = $categorie->getSousCategories();
$count2 = 0;
$max2 = sizeof($sous_categories);
while ($count2 < $max2)
	{
		$sous_categorie = $sous_categories[$count2];
		require('views/header_menu_sous_categorie.phtml');
		$count2++;
	}
?>