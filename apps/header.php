<?php
if (isset($_SESSION['id']) && isset($_SESSION['admin']))
	require('views/header_admin.phtml');
else if (isset($_SESSION['id']))
	require('views/header_in.phtml');
else
	require('views/header.phtml');
?>