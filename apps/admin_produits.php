<?php
if (isset($_GET['option']))
{
	$option = $_GET['option'];
}

	$manager = new ProduitManager($link);

		$produits = $manager->findAll();
		$count = 0;
		$max = sizeof($produits);
		while ($count < $max)
		{
			$produit = $produits[$count];
			require('views/admin_bloc_produit_liste.phtml');
			$count++;
		}

?>