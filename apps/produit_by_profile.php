<?php
if (isset($_SESSION['id']))
	require('views/produit_in.phtml');
else
	require('views/produit_out.phtml');
?>