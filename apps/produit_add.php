// <?php
$manager = new SousCategorieManager($link);
	try
	{
		$sous_categories = $manager->findAll();
		$count = 0;
		$max = sizeof($sous_categories);
		while ($count < $max)
		{
			$sous_categorie = $sous_categories[$count];
			require('views/admin_bloc_produit_add_liste_sous_categorie.phtml');
			$count++;
		}
	}
	catch (Exception $exception)
	{
		$error = $exception->getMessage();
	}
?>