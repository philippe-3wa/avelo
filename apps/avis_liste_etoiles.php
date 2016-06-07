<?php 
for($i = 1; $i <= 5; $i++) :
	$isChecked = false;
	if($i <= $avis->getNote())
	{
		$isChecked = true;
	}

	require ('views/avis_liste_etoiles.phtml'); 
?>	
<?= 
	$isChecked ? "checked disabled" : ""; 
?>/>

<?php endfor; ?>