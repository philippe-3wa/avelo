<?php
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'ajout_panier')
	{
		$manager = new PanierManager($link);
		try
		{	
			$panier = $manager->findByIdUserActif($_SESSION['id']);
			if (!$panier)
			{
				$panier = $manager->create($_POST);
			}
				$produit = new ProduitManager($link);
				$produit = $produit->findById($_POST['id_produit']);

				
				$compteur = 0;
				$max = intval($_POST['quantite']);
				while ($compteur < $max) {
					$panier->addProduit($produit);
					$compteur++;
				}

			$manager->update($panier);

			header('Location: index.php');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}
}
?>