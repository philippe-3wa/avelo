<?php
	
	$produits = $panier->getProduits();

	$compteur = 0;
	$max = sizeof($produits);

	$nbProduitPanier = [];
	
	while ($compteur < $max) 
	{
		$produit = $produits[$compteur];
		$nbProduitPanier[] = ['id'=>$produit->getId(), 'prix'=>$produit->getPrix()];
		
		$compteur++;
	}

var_dump($nbProduitPanier);












	while ($compteur < $max) 
	{
		$produit = $produits[$compteur];
		require('views/panier_liste_produit.phtml');
		$compteur++;
	}
	
?>