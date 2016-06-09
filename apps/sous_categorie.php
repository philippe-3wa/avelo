<?php
if (!isset($_GET['id']))
{
	require('views/error.phtml');
	exit;
}
else
{	$id = intval($_GET['id']);
	$manager = new SousCategorieManager($link);
	$sous_categorie = $manager->findById($id);
	if (!$sous_categorie)
	{
		require('views/error.phtml');
		exit;
	}

	$categorie = $sous_categorie->getCategorie();
	
	if ($sous_categorie)
		require('views/sous_categorie.phtml');
	else
		require('views/error.phtml');
}
?>