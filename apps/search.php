<?php
if (!isset($_GET['motcle']))
	require('views/search_nok.phtml');
else
{

$motcle = htmlentities($_GET['motcle']);
$manager = new ProduitManager($link);
$produits = $manager->findAllSearch($motcle);

if (!$produits)
{
	require('views/search_nok.phtml');
}
else
{
	$count = 0;
	$max = sizeof($produits);
	while ($count < $max)
	{
		$produit = $produits[$count];
		require('views/search_ok.phtml');
		$count++;
	}
}


		


}
?>