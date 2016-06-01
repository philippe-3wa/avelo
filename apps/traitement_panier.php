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

				
				// creer objet produit avec produit manager puis ajouter l'objet produit + quantite
			$panier->AddProduit($produit);
			$panier->setQuantite($_POST['quantite']);

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