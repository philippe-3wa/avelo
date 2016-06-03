<?php
$manager = new ProduitManager($link);

$produits = $manager->findAll();
$count = 0;
$max = sizeof($produits);
while ($count < $max)
{
	$produit = $produits[$count];
	require('views/home_fiche_produit.phtml');

	$count++;
}
?>