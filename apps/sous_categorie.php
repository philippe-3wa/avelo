<?php
if (!isset($_GET['id']))
{
	require('views/error.phtml');
	exit;
}
else
{	$id = intval($_GET['id']);
	$manager = new SousCategorieManager($link);
	try
	{
		$sous_categorie = $manager->findById($id);
		require('views/sous_categorie.phtml');
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
}


?>