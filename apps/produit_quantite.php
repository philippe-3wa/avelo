<?php
$i = 1;
$max = ($produit->getStock()+1);
while ($i<$max) 
{
	require('views/produit_quantite.phtml');
	$i++;
}
?>