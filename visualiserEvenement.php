<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$idEvenement=$_GET["id"];
	$evenement = evenement::charger($idEvenement);
	$evenement->chargerArticles();
?>

<CENTER>

<br><br>
Consulter un événement
<br><br>

<?php
	echo "<h1>$evenement->nom</h1>";
?>
<br><br>
<table class="tableCommune">
<tr><th>Nom</th><th>Quantité</th><th>Prix unitaire</th><th>Prix total</th></tr>
<?php
	foreach ($evenement->articlesEvenement as $articleEvenement) {
		$nom=$articleEvenement->nom();
		$prixTotal=$articleEvenement->prix * $articleEvenement->quantite;
		echo "<tr><td>$nom</td><td>$articleEvenement->quantite</td><td>$articleEvenement->prix</td><td>$prixTotal</td></tr>";
	}
	$totalPrix=$evenement->getTotalPrix();
	echo "<tr><td>Total</td><td></td><td></td><td>$totalPrix</td></tr>";
?>
</table>
<br><br>
<a class="menu" href="modifierEvenement.php?id=<?php echo $evenement->idEvenement;?>">Modifier</a><br>
<a class="menu" href="visualiserEvenements.php">Retour à la liste des événements</a><br>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>
