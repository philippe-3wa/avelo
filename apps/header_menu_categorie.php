<?php
$manager = new CategorieManager($link);
$categories = $manager->findAllActif();
$count = 0;	
$max = sizeof($categories);
while ($count < $max)
{
	$categorie = $categories[$count];
	require('views/header_menu_categorie.phtml');
	$count++;
}
?>