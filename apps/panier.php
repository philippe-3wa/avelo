<?php
if (!isset($_SESSION['id']))
{
	require('views/error.phtml');
	exit;
}
else
{
	if ((isset($_GET['paiement'])) && ($_GET['paiement'] == "ok"))
	{
		require ('views/paiement_ok.phtml');

	}
	else
	{

		$id = $_SESSION['id'];

		$manager = new UserManager($link);
		$user = $manager->findById($id);
		$panier = $user->getPanier();

		if ($panier)
		{
				$prix = $panier->getPrix();
				$nombre_produits = $panier->getNbrProduits();
				$poids = $panier->getPoids();

				if ($nombre_produits > 0)
				{
					require('views/panier.phtml');

					if (isset($_GET['option']))
					{
						if (isset($_GET['adresse']))
						{
						$getAdresse = intval($_GET['adresse']);
						
							if ($_GET['option'] == "finaliser")
							{
								$adresse_manager = new AdresseManager($link);
								$adresse = $adresse_manager->getById($getAdresse);
								require('views/panier_finaliser.phtml');
							}
						}
					}
				}
				else
					require('views/panier_vide.phtml');
				
		}
		else
		{
				$prix = 0;
				$nombre_produits = 0;
				$poids = 0;
				require('views/panier_vide.phtml');
		}
	}

}


?>