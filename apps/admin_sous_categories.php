<?php
if (isset($_GET['action']))
{
	$option = $_GET['option'];
}

	$manager = new SousCategorieManager($link);

		$sous_categories = $manager->findAll();
		$count = 0;
		$max = sizeof($sous_categories);
		while ($count < $max)
		{
			$sous_categorie = $sous_categories[$count];
			require('views/admin_bloc_sous_categorie_liste.phtml');
			$count++;
		}

?>