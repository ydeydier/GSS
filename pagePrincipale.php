<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>

<CENTER>
<br><br><br><br>
<h1>Stock "<?php echo $stock->nom;?>"</h1>
<br><br><br><br>
<a class="menu" href="visualiserStock.php">Consulter le stock (réel et virtuel)</a><br>
<a class="menu" href="editerStock.php">Modifier le contenu du stock</a><br>
<br><br>
<a class="menu" href="visualiserEvenements.php">Consulter les événements</a><br>
<a class="menu" href="ajouterEvenement.php">Ajouter un nouvel événement</a><br>
<br><br>

</CENTER>
<?php
	require "footer.php";
?>