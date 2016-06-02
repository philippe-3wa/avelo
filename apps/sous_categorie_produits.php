<?php

$produits = $sous_categorie->getProduits();
$count = 0;	
$max = sizeof($produits);
while ($count < $max)
{
	$produit = $produits[$count];
	require('views/sous_categorie_produits.phtml');
	$count++;
}
	
?>