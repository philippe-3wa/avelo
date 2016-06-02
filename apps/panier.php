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
			$poids = $panier->getPoids();
		}
		else
		{
			$prix = 0;
			$nombre_produits = 0;
			$poids = 0;
		}
		require('views/panier.phtml');

	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}

?>