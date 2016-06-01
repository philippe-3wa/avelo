<?php
if (!isset($_GET['option']))
{
	$manager = new ProduitManager($link);
	try
	{
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
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
}
else
	{
		$option = $_GET['option'];

		$manager = new ProduitManager($link);
		try
		{
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
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}

		if ($option == "ajout_produit")
			require('views/admin_bloc_produit_add.phtml');
		else if ($option == "edit_produit")
			require('views/admin_bloc_produit_edit.phtml');
	}
?>