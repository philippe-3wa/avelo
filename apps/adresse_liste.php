<?php

$manager = new AdresseManager($link);

$adresses = $manager->findByUser($user);
$count = 0;
$max = sizeof($adresses);
while ($count < $max)
{
	$adresse = $adresses[$count];
	require('views/adresse_liste.phtml');
	
	$count++;
}

?>