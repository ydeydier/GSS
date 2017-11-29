<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$idEvenement=$_GET["id"];
	$evenement = evenement::charger($idEvenement);
	$evenement->chargerArticles();
	$_SESSION["evenement"]=$evenement;
?>
<script type="text/javascript">
function montrerTableAjouterArticle() {
	var table = document.getElementById("tableAjouterArticle");
	if (table.style.display=="none") {
		table.style="display:inline;";
	} else {
		table.style="display:none;";
	}
}
</script>

<CENTER>

<br><br>
<h1>Modification d'un événement</h1>
<br><br>

<form method="POST" action="modifierEvenement_trt.php">
Nom de l'événement <input type="text" name="txtNomEvenement" value="<?php echo $evenement->nom;?>" name="txtNomEvenement">
<br><br><br><br>
<table class="tableCommune">
<tr><th>Nom</th><th>Quantité</th><th>Prix unitaire</th></tr>
<?php
	foreach ($evenement->articlesEvenement as $articleEvenement) {
		$nom=$articleEvenement->nom();
		$prixTotal=$articleEvenement->prix * $articleEvenement->quantite;
		$idArticleDeStock = $articleEvenement->idArticleDeStock();
		echo "<tr><td>$nom</td><td><input type='text' size='5' name='QUANTITE_$idArticleDeStock' value='$articleEvenement->quantite'></td><td><input type='text' size='7'  name='PRIX_$idArticleDeStock' value='$articleEvenement->prix'></td></tr>";
	}
?>
</table>

<br>
<a href="javascript:montrerTableAjouterArticle()">Ajouter des articles</a><br>
<br>
<table id="tableAjouterArticle" class="tableCommune" style="display:none;">
<tr><th>Nom</th><th>Prix</th><th>Stock<br>réel</th><th>Stock<br>virtuel</th><th>Quantité</th></tr>
<?php
	$stock->chargerArticles();
	$_SESSION["stock"]=$stock;
	foreach ($stock->articleDeStocks as $articleDeStock) {
		$idArticleDeStock=$articleDeStock->idArticleDeStock;
		if (!$evenement->contientArticle($idArticleDeStock)) {
			echo "<tr><td>$articleDeStock->nom</td><td>$articleDeStock->prix</td><td>$articleDeStock->quantiteReelle</td><td>$articleDeStock->quantiteVirtuelle</td><td><input size='5' name=\"QTE_AJOUT_$idArticleDeStock\" type='text'></td></tr>";
		}
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