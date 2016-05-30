<?php
$manager = new ProduitManager($link);
	try
	{
		$produits = $manager->findAll();
		$count = 0;
		$max = sizeof($produits);
		while ($count < $max)
		{
			$produit = $produits[$count];
			require('views/admin_gestion_produit.phtml');
			$count++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
?>