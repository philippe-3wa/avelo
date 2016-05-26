<?php
if (isset($_POST['email'], $_POST['login'], $_POST['password'], $_POST['prenom'], $_POST['nom'], $_POST['sexe'], $_POST['date_inscription'], $_POST['date_naissance'], $_SESSION['actif'], $_SESSION['admin'] $_SESSION['id']))
{
	$manager = new UserManager($link);
	$article = $manager->create($_POST);
	header('Location: index.php');
	exit;
}
?>