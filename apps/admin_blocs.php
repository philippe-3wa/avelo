<?php
if (!isset($_GET['bloc']))
{
	require('views/admin_bloc_categorie.phtml');
	require('views/admin_bloc_sous_categorie.phtml');
	require('views/admin_bloc_user.phtml');
	require('views/admin_bloc_produit.phtml');
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

	if (isset($_GET['option']))
	{
		$option = $_GET['option'];

		if ($option == "add_categorie")
			require('views/admin_bloc_categorie_add.phtml');
		if ($option == "edit_categorie")
			require('views/admin_bloc_categorie_edit.phtml');
		else if ($option == "add_sous_categorie")
			require('views/admin_bloc_sous_categorie_add.phtml');
		else if ($option == "edit_sous_categorie")
			require('views/admin_bloc_sous_categorie_edit.phtml');
		else if ($option == "add_produit")
			require('views/admin_bloc_produit_add.phtml');
		else if ($option == "edit_produit")
			require('views/admin_bloc_produit_edit.phtml');
	}
} 
// testtt
?>