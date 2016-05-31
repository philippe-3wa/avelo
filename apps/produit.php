<?php
$manager = new ProduitManager($link);
	try
	{
		$id = intval($_GET['id']);
		$produit = $manager->findById($id);

		require('views/produit.phtml');

		
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}

	
?>