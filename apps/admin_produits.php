<?php
if (!isset($_GET['option']))
{
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
}
else
	{
		$option = $_GET['option'];

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

		if ($option == "ajout_produit")
			require('views/admin_bloc_produit_add.phtml');
		else if ($option == "edit_produit")
			require('views/admin_bloc_produit_edit.phtml');
	}
?>