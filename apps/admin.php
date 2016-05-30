<?php 
if (!isset($_SESSION['admin']))
{
	require('views/admin_off.phtml');
}
else
{
	require('views/admin.phtml');
}
?>