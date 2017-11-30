<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$idSortie=$_GET["id"];
	$sortie = sortie::charger($idSortie, $stock);
	$_SESSION["sortie"]=$sortie;	// Variable utile uniquement pour la page de traitement modifierSortie_trt.php
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
<h1>Modification d'une sortie</h1>
<br><br>

<form method="POST" action="modifierSortie_trt.php">
Nom de la sortie <input type="text" name="txtNomSortie" value="<?php echo $sortie->nom;?>" name="txtNomSortie">
<br><br><br><br>
<table class="tableCommune">
<tr><th>Nom</th><th>Quantité</th><th>Prix unitaire</th></tr>
<?php
	foreach ($sortie->tLigneSortie as $ligneSortie) {
		$article=$ligneSortie->article;
		$nom=$article->nom;
		$quantite=$ligneSortie->quantite;
		$prixSortie=$ligneSortie->prixSortie;
		$idArticle = $article->idArticle;
		echo "<tr><td>$nom</td><td><input type='text' size='5' name='QUANTITE_$idArticle' value='$quantite'></td><td><input type='text' size='7'  name='PRIX_$idArticle' value='$prixSortie'></td></tr>";
	}
?>
</table>

<br>
<a href="javascript:montrerTableAjouterArticle()">Ajouter des articles</a><br>
<br>
<table id="tableAjouterArticle" class="tableCommune" style="display:none;">
<tr><th>Nom</th><th>Prix</th><th>Stock<br>réel</th><th>Stock<br>virtuel</th><th>Quantité</th></tr>
<?php
	chargerStock(); // impose de rechargement du stock
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		if (!$sortie->contientArticle($article)) {
			echo "<tr><td>$article->nom</td><td>$article->prixCourant</td><td>$ligneStock->quantiteReelle</td><td>$ligneStock->quantiteVirtuelle</td><td><input size='5' name=\"QTE_AJOUT_$idArticle\" type='text'></td></tr>";
		}
	}
?>
</table>
<br><br>
<button type="submit" class="boutonValider">Valider</button>
&nbsp;&nbsp;&nbsp
<button type="button" class="boutonAnnuler" onclick="javascript:window.location='consulterSortie.php?id=<?php echo $idSortie;?>'">Annuler</button>
</form>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>