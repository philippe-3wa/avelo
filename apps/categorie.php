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
	$categorie = $manager->findById($id);
	if ($categorie)
		require('views/categorie.phtml');
	else
		require('views/error.phtml');
}
?>