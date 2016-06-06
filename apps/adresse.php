<?php
if (!isset($_SESSION['id']))
	require('views/error.phtml');
else
	require('views/adresse.phtml');

if (isset($_GET['option']))
{
	$option = $_GET['option'];

	if ($option == "add_adresse")
		require ('views/adresse_add.phtml');
}
	
?>