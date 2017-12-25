<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$bUtiliseBeneficiaire=($stock->utiliseBeneficiaire=="O");
?>
<script type="text/javascript">
function validerForm() {
	valid=true;
	if ( document.formulaire.txtNomSortie.value.trim() == "" ) {
		alert ( "Veuillez saisir un nom de sortie !" );
		valid=false;
	}
	return valid;
}
</script>

<CENTER>

<br>
<h1>Ajout d'une sortie</h1>
<br>

<form method="POST" name="formulaire" onsubmit="return validerForm();" action="ajouterSortie_trt.php">
Nom de la sortie <input autofocus type="text" value="" name="txtNomSortie">
<br><br><br><br>
<table class="tableCommune">
<tr><th>Nom</th><?php if ($bUtiliseBeneficiaire) echo "<th>Bénéficiaire</th>";?><th>Prix</th><th>Stock<br>réel</th><th>Stock<br>virtuel</th><th>Quantité</th></tr>
<?php
	chargerStock(); // impose de rechargement du stock
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$quantiteReelle=$ligneStock->quantiteReelle;
		$quantiteVirtuelle=$ligneStock->quantiteVirtuelle;
		if ($quantiteReelle==$quantiteVirtuelle) $quantiteVirtuelle="";
		echo "<tr>";
		echo "<td>$article->nom</td>";
		if ($bUtiliseBeneficiaire) echo "<td><input type='text' size='25' name='BENEF_$idArticle' value=''></td>";
		echo "<td>$article->prixCourant</td>";
		echo "<td class=\"tdQuantiteReelle\">$quantiteReelle</td>";
		echo "<td class=\"tdQuantiteVirtuelle\">$quantiteVirtuelle</td>";
		echo "<td><input size='5' name=\"QUANTITE_$idArticle\" type='text'></td>";
		echo "</tr>";
	}
?>
</table>
<br><br>
<button type="submit" class="boutonValider">Valider</button>
&nbsp;&nbsp;&nbsp
<button type="button" class="boutonAnnuler" onclick="javascript:window.location='pagePrincipale.php'">Annuler</button>
</form>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>