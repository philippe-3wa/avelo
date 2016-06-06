<?php
$manager = new UserManager($link);

if (!isset($_SESSION['id']))
{
	require('views/error.phtml');
	exit;
}
else
{
	$id = $_SESSION['id'];
	$user = $manager->findById($id);

	$panier = $user->getPanier();

	if ($panier)
	{
		$prix = $panier->getPrix();
		$nombre_produits = $panier->getNbrProduits();
		$poids = $panier->getPoids();
		require('views/panier.phtml');
	}
	else
	{
		$prix = 0;
		$nombre_produits = 0;
		$poids = 0;
		require('views/panier_vide.phtml');
	}
}


?>