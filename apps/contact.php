<?php
if (isset($_GET['message']))
	require('views/contact_ok.phtml');
else
	require('views/contact.phtml');
?>