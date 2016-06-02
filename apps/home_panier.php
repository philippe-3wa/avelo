<?php
$manager = new PanierManager($link);
	try
	{
		$user_id = $_SESSION['id'];
		$panier = $manager->findByIdUserActif($user_id);
		if ($panier)
		{
			$prix = $panier->getPrix();
			$nombre_produits = $panier->getNbrProduits();
		}
		else
		{
			$prix = 0;
			$nombre_produits = 0;
		}
		require('views/home_panier.phtml');

	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}

?>