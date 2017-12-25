<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$idSortie=$_GET["id"];
	$sortie = sortie::charger($idSortie, $stock);
	$_SESSION["sortie"]=$sortie;	// Variable utile uniquement pour la page de traitement modifierSortie_trt.php
	$bUtiliseBeneficiaire=($stock->utiliseBeneficiaire=="O");
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

<br>
<h1>Modification d'une sortie</h1>
<br>

<form method="POST" action="modifierSortie_trt.php">
Nom de la sortie <input type="text" size="30" name="txtNomSortie" value="<?php echo $sortie->nom;?>" name="txtNomSortie">
<br><br><br><br>
<table class="tableCommune">
<tr><th>Nom</th><?php if ($bUtiliseBeneficiaire) echo "<th>Bénéficiaire</th>";?><th>Prix unitaire</th><th>Quantité</th><th>Supprimer</th></tr>
<?php
	foreach ($sortie->tLigneSortie as $ligneSortie) {
		$article=$ligneSortie->article;
		$nom=$article->nom;
		$quantite=$ligneSortie->quantite;
		$prixSortie=$ligneSortie->prixSortie;
		$beneficiaire=$ligneSortie->beneficiaire;
		$idArticle = $article->idArticle;
		echo "<tr>";
		echo "<td>$nom</td>";
		if ($bUtiliseBeneficiaire) echo "<td><input type='text' size='25' name='BENEF_$idArticle' value='$beneficiaire'></td>";
		echo "<td><input type='text' size='7' name='PRIX_$idArticle' value='$prixSortie'></td>";
		echo "<td><input type='text' size='5' name='QUANTITE_$idArticle' value='$quantite'></td>";
		echo "<td align=\"center\"><input type='checkbox' name='chkDel_$idArticle'></td>";
		echo "</tr>";
	}
?>
</table>

<br>
<a href="javascript:montrerTableAjouterArticle()">Ajouter des articles</a><br>
<br>
<table id="tableAjouterArticle" class="tableCommune" style="display:none;">
<tr><th>Nom</th><?php if ($bUtiliseBeneficiaire) echo "<th>Bénéficiaire</th>";?><th>Prix</th><th>Stock<br>réel</th><th>Stock<br>virtuel</th><th>Quantité</th></tr>
<?php
	chargerStock(); // impose de rechargement du stock
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		if (!$sortie->contientArticle($article)) {
			echo "<tr>";
			echo "<td>$article->nom</td>";
			if ($bUtiliseBeneficiaire) echo "<td><input type='text' size='25' name='BENEF_AJOUT_$idArticle' value=''></td>";
			echo "<td>$article->prixCourant</td>";
			echo "<td>$ligneStock->quantiteReelle</td>";
			echo "<td>$ligneStock->quantiteVirtuelle</td>";
			echo "<td><input size='5' name=\"QTE_AJOUT_$idArticle\" type='text'></td>";
			echo "</tr>";
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