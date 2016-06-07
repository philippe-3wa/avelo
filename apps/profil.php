<?php
if (isset($_SESSION['id'])) {
	$manager = new UserManager($link);
	$user = $manager->findById($_SESSION['id']);
	require('views/profil.phtml');
}
else
	require('views/error.phtml');

?>