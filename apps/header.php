<?php
if (isset($_SESSION['login']))
	require('views/header_in.phtml');
else
	require('views/header.phtml');
?>