<?php
if (isset($firstCategorie))
	$categorie = $firstCategorie;
else
{
	$manager = new CategorieManager($link);
	$categorie = $manager->findbyId($_GET['id']);
}
require('views/sous_categorieAjax.phtml'); 
?>