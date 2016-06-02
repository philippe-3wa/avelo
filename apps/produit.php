<?php
if (!isset($_GET['id']))
{
	require('views/error.phtml');
	exit;
}
else
{	
	$manager = new ProduitManager($link);
		try
		{
			$id = intval($_GET['id']);
			$produit = $manager->findById($id);
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
			
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
}
?>

