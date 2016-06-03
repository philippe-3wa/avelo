<?php
	
	$produits = $panier->getProduits();
	var_dump($produits);

	$compteur = 0;
	$max = sizeof($produits);
	while ($compteur < $max) 
	{
		$produit = $produits[$count];
		require('views/panier_liste_produit.phtml');
		$compteur++;
	}
	
?>