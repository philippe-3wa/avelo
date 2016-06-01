<?php
if (isset($_POST['action']))
{
	if ($_POST['action'] == 'ajout_panier')
	{
		$manager = new PanierManager($link);
		try
		{
			$panier = $manager->create($_POST);
			$panier->setIdProduit($_POST['id_produit']);
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