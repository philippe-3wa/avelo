<?php
if (!isset($_GET['motcle']))
	require('views/search_ok.phtml');
else
{

$motcle = htmlentities($_GET['motcle']);
$manager = new ProduitManager($link);
$produit = $manager->findAllSearch($motcle);
if ($produit)
		require('views/search_nok.phtml');
}

?>