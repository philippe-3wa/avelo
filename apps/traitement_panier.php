<?php
if (isset($_POST['action']))
{
	$userManager = new UserManager($link);

	if ($_POST['action'] == 'ajout_panier')
	{
		
		try
		{
			$user = $userManager->findById($_SESSION['id']);
			$panier = $user->getPanier();

			$panierManager = new PanierManager($link);

			if (!$panier)
			{
				$panier = $panierManager->create($_POST);
			}
			$produit = new ProduitManager($link);
			$produit = $produit->findById($_POST['id_produit']);
			$compteur = 0;
			$max = intval($_POST['quantite']);
			while ($compteur < $max) 
			{
				$panier->addProduit($produit);
				$compteur++;
			}

			$panierManager->update($panier);

			header('Location: index.php');
			exit;
		}
		catch (Exception $exception)
		{
			$error = $exception->getMessage();
		}
	}

	if ($_POST['action'] == 'delete_produit')
	{
		$user = $userManager->findById($_SESSION['id']);
		$panier = $user->getPanier();

		$panierManager = new PanierManager($link);

		$produit = new ProduitManager($link);
		$produit = $produit->findById($_POST['id_produit']);
		$compteur = 0;
		$max = intval($_POST['quantite']);
		while ($compteur < $max) 
		{
			$panier->removeProduit($produit);
			$compteur++;
		}

		$panierManager->update($panier);

		header('Location: index.php?page=panier');
		exit;

	}

	if ($_POST['action'] == "paiementok")
	{
		$user_manager = new UserManager($link);
		$user = $user_manager->findById($_SESSION['id']); 
		$manager_panier = new PanierManager($link);

		$panier = $manager_panier->findByUserActif($user);

		//$produits = $panier->getProduits();
		//var_dump($produits);


		$manager_panier->remove($panier);

		header('Location: index.php?page=panier&paiement=ok');
		exit;
	}
}

?>