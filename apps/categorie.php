<?php
if (!isset($_GET['id']))
{
	require('views/error.phtml');
	exit;
}
else
{
	$id = intval($_GET['id']);
	$manager = new CategorieManager($link);
	try
	{
		$categorie = $manager->findById($id);
		require('views/categorie.phtml');
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
}


?>