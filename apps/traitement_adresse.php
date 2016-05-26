<?php
if (isset($_POST['nom'], $_POST['numero'], $_POST['rue'], $_POST['cp'], $_POST['ville'], $_POST['pays'], $_POST['telephone'], $_POST['type'] $_SESSION['id']))
{
	$manager = new AdresseManager($link);
	$article = $manager->create($_POST);
	header('Location: index.php');
	exit;
}
?>