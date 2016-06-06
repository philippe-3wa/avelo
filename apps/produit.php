<?php
if (!isset($_GET['id']))
{
	require('views/error.phtml');
	exit;
}
else
{	
	$manager = new ProduitManager($link);

	$id = intval($_GET['id']);
	$produit = $manager->findById($id);
	
	if ($produit)
	{
		require('views/produit.phtml');
	

	$liste_avis = $produit->getListeAvis();
	$count = 0;
	$max = sizeof($liste_avis);
	while ($count < $max)
	{
		$avis = $liste_avis[$count];
		require('views/avis.phtml');
		$count++;
	}
	if (isset($_SESSION['id']))
		require('views/avis_add.phtml');
	
	}
	else
		require('views/error.phtml');	
}
?>