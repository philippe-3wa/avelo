<?php 
if (isset($_SESSION['admin']))
	require('views/admin.phtml');
else
	require('views/admin_off.phtml');
?>