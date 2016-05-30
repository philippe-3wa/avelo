<?php 
if (isset($_SESSION['admin']))
	require('views/admin.phtml');
else
	header('Location: index.php?page=user');
	exit;
?>