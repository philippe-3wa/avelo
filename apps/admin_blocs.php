<?php
if (!isset($_GET['bloc']))
{
	require('views/admin_bloc_categorie.phtml');
	require('views/admin_bloc_sous_categorie.phtml');
	require('views/admin_bloc_user.phtml');
	require('views/admin_bloc_produit.phtml');
	require('views/admin_bloc_avis.phtml');
}
else
{
	$bloc = $_GET['bloc'];

	if ($bloc == "categorie")
		require('views/admin_bloc_categorie.phtml');
	else if ($bloc == "sous_categorie")
		require('views/admin_bloc_sous_categorie.phtml');
	else if ($bloc == "user")
		require('views/admin_bloc_user.phtml');
	else if ($bloc == "produit")
		require('views/admin_bloc_produit.phtml');
	else if ($bloc == "avis")
		require('views/admin_bloc_avis.phtml');

	if (isset($_GET['option']))
	{
		$option = $_GET['option'];

		if ($option == "add_categorie")
			require('views/admin_bloc_categorie_add.phtml');
		if ($option == "edit_categorie")
			{
				$manager = new CategorieManager($link);
				$id = $_GET['id'];
				$categorie = $manager->findById($id);
				require('views/admin_bloc_categorie_edit.phtml');
			}
		else if ($option == "add_sous_categorie")
			require('views/admin_bloc_sous_categorie_add.phtml');
		else if ($option == "edit_sous_categorie")
			{
				$manager = new SousCategorieManager($link);
				$id = $_GET['id'];
				$sous_categorie = $manager->findById($id);
				require('views/admin_bloc_sous_categorie_edit.phtml');
			}
		else if ($option == "add_produit")
			require('views/admin_bloc_produit_add.phtml');
		else if ($option == "edit_produit")
		{
			$manager = new ProduitManager($link);
			$id = $_GET['id'];
			$produit = $manager->findById($id);

			$sous_categorie_manager = new SousCategorieManager($link);
			$sous_categorie = $sous_categorie_manager->findById($produit->getIdSousCategorie());
			$firstCategorie = $sous_categorie->getCategorie();
			$idCategory = $firstCategorie->getId();
			
			require('views/admin_bloc_produit_edit.phtml');
		}
	}
} 
?>