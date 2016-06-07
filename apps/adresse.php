<?php
if (!isset($_SESSION['id']))
	require('views/error.phtml');
else
	require('views/adresse.phtml');

if (isset($_GET['option'], $_SESSION['id']))
{
	$option = $_GET['option'];

	if ($option == "add_adresse")
		require ('views/adresse_add.phtml');

	if ($option == "edit_adresse")
	{
		if (isset($_GET['id']))
		{
			$id = $_GET['id'];
			$manager = new AdresseManager($link);
			$adresse = $manager->findById($id);
			if ($_SESSION['id'] == $adresse->getIdUser())
				require ('views/adresse_edit.phtml');
			else
				require('views/error.phtml');
		}
		else
			require('views/error.phtml');
	}
}	
?>