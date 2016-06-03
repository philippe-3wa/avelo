<?php
if (isset($_GET['option']))
{
	$option = $_GET['option'];
}

	$manager = new AdresseManager($link);

		$adresse = $manager->findAll();
		$count = 0;
		$max = sizeof($adresse);
		while ($count < $max)
		{
			$categorie = $adresse[$count];
			require('views/admin_bloc_adresse_liste.phtml');
			$count++;
		}

?>