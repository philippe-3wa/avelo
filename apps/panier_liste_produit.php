<?php
	
	$produits = $panier->getProduits();

	$compteur = 0;
	$max = sizeof($produits);
	
	while ($compteur < $max) 
	{
		$produit = $produits[$compteur];
		require('views/panier_liste_produit.phtml');
		$compteur++;
	}
	
?>