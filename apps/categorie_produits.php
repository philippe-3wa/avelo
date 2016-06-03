<?php
$produits = $categorie->getProduits();
$count = 0;	
$max = sizeof($produits);
while ($count < $max)
{
	$produit = $produits[$count];
	require('views/categorie_produits.phtml');
	$count++;
}
?>