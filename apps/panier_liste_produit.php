<?php
	
	$produits = $panier->getProduits();
	$quantity = [];
	$list = [];
	$ProduitPanier = [];
	$compteur = 0;
	$max = sizeof($produits);


	
	while ($compteur < $max) 
	{
		$produit = $produits[$compteur];
		if (!isset($quantity[$produit->getId()]))
		{
			$quantity[$produit->getId()] = 0;
			$list[] = $produit;
		}
		$quantity[$produit->getId()]++;
		$compteur++;
	}





$max = sizeof($list);
$compteur = 0;
	while ($compteur < $max) 
	{
		$produit = $list[$compteur];
		$quantite = $quantity[$produit->getId()];
		$prixParProduit = $produit->getPrix();
		$prixTotal = $quantite * $prixParProduit;
		require('views/panier_liste_produit.phtml');
		$compteur++;
	}
	
?>