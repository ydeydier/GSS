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
<a class="menu" href="consulterSorties.php">Consulter les sorties</a><br>
<a class="menu" href="ajouterSortie.php">Ajouter une nouvelle sortie</a><br>
<br><br>

</CENTER>
<?php
	require "footer.php";
?>