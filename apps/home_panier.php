<?php	
$manager = new UserManager($link);

$id = $_SESSION['id'];
$user = $manager->findById($id);

$panier = $user->getPanier();

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
?>