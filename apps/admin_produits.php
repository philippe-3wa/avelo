<?php
if (!isset($_GET['action']))
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
		$action = $_GET['action'];

		if ($action == "ajout_produit")
			require('views/admin_bloc_produit_add.phtml');
		else if ($action == "edit_produit")
			require('views/admin_bloc_produit_edit.phtml');
	}
?>