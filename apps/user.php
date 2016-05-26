<?php
if isset($_SESSION['id'])
	require('views/profil.phtml');
else
{
	if (isset($_POST['action'])
	{
		$action = $_POST['action'];
		if ($action == "login")
			require('views/login.phtml');
		else if ($action == "register")
			require('views/register.phtml')
	}
	else
		require('views/login.phtml');
}
?>