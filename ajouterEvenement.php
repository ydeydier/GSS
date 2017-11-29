<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>

<CENTER>

<br><br>
<h1>Ajout d'un événement</h1>
<br><br>

<form method="POST" action="ajouterEvenement_trt.php">
Nom de l'événement <input type="text" value="" name="txtNomEvenement">
<br><br><br><br>
<table class="tableCommune">
<tr><th>Nom</th><th>Prix</th><th>Stock<br>réel</th><th>Stock<br>virtuel</th><th>Quantité</th></tr>
<?php
	$stock->chargerArticles();
	$_SESSION["stock"]=$stock;
	foreach ($stock->articleDeStocks as $articleDeStock) {
		$idArticleDeStock=$articleDeStock->idArticleDeStock;
		echo "<tr><td>$articleDeStock->nom</td><td>$articleDeStock->prix</td><td>$articleDeStock->quantiteReelle</td><td>$articleDeStock->quantiteVirtuelle</td><td><input size='5' name=\"NBRE_$idArticleDeStock\" type='text'></td></tr>";
	}
?>
</table>
<br><br>
<input type="submit" value="Valider"> <input type="button" value="Annuler" onclick="javascript:window.location='pagePrincipale.php'">
</form>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>