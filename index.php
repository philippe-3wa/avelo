<?php
session_start();

require('config.php');
$link = mysqli_connect($db_host, $db_login, $db_pass, $db_name);

if (!$link) 
{
    require('views/mysql_error.php');
}

$page = 'home';
$error ='';

function __autoload($className)
{
	require('models/'.$className.'.class.php');
}

$access = array('home', 'produit', 'user', 'categorie', 'avis', 'panier', 'admin', 'contact', 'profil');

if (isset($_GET['page']))
{

	if (in_array($_GET['page'], $access))
		$page = $_GET['page'];
}

$access_traitement = array(/*'user', */'avis', /*'panier', 'admin',*/'adresse');

if (in_array($page, $access_traitement))
	require('apps/traitement_'.$page.'.php');
require('apps/skel.php');

mysqli_close($link);
?>