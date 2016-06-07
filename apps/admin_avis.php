<?php
if (isset($_GET['action']))
{
	$option = $_GET['option'];
}

	$manager = new AvisManager($link);

		$liste_avis = $manager->findAll();

		$count = 0;
		$max = sizeof($liste_avis);
		while ($count < $max)
		{
			$avis = $liste_avis[$count];
			$user = $avis->getUser($avis->getIdUser());
			$produit = $avis->getProduit($avis->getIdProduit());
			require('views/admin_bloc_avis_liste.phtml');
			$count++;
		}
?>