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
function agrandirCommentaire() {
	var text = document.getElementById("idCommentaire");
	if (text.style.width=="35em") {
		text.style.width="";
		text.style.height="";
	} else {
		text.style.width="35em";
		text.style.height="10em";
	}
}
function agrandirRessources() {
	var text = document.getElementById("idRessources");
	if (text.style.width=="35em") {
		text.style.width="";
		text.style.height="";
	} else {
		text.style.width="35em";
		text.style.height="10em";
	}
}
</script>

<CENTER>

<br>
<h1>Ajout d'une sortie</h1>
<br>

<form method="POST" name="formulaire" onsubmit="return validerForm();" action="ajouterSortie_trt.php">

<table class="tableCommune">
<tr><th align="left">Nom&nbsp;&nbsp;&nbsp;</th><td><input autofocus size="35" type="text" value="" name="txtNomSortie"></td></tr>
<tr><th align="left">Date (jj/mm/aaaa)&nbsp;&nbsp;&nbsp;</th><td><input size="11" maxlength="10" type="text" value="" name="txtDate"></td></tr>
<tr><th align="left">Commentaire&nbsp;&nbsp;&nbsp;</th><td><textarea id="idCommentaire" rows="2" cols="35" name="txtCommentaire"></textarea><br><a style="font-size:9px;" href="javascript:agrandirCommentaire()">Agrandir</a></td></tr>
<tr><th align="left">Ressources&nbsp;&nbsp;&nbsp;</th><td><textarea id="idRessources" rows="2" cols="35" name="txtRessources"></textarea><br><a style="font-size:9px;" href="javascript:agrandirRessources()">Agrandir</a></td></tr>
</table>

<br><br>
<table class="tableCommune">
<tr><th>Nom</th><?php if ($bUtiliseBeneficiaire) echo "<th>Bénéficiaire</th>";?><th>Prix<br>(TTC)</th><th>Quantité</th><th>Stock<br>réel</th><th>Stock<br>virtuel</th></tr>
<?php
	// TODO: vérifier la date en javascript
	chargerStock(); // impose de rechargement du stock
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$quantiteReelle=$ligneStock->quantiteReelle;
		$quantiteVirtuelle=$ligneStock->quantiteVirtuelle;
		if ($quantiteReelle==$quantiteVirtuelle) $quantiteVirtuelle="";
		$quantiteReelle=afficherEntierSansDec($quantiteReelle);
		$quantiteVirtuelle=afficherEntierSansDec($quantiteVirtuelle);
		echo "<tr>";
		echo "<td>$article->nom</td>";
		if ($bUtiliseBeneficiaire) echo "<td><input type='text' size='25' name='BENEF_$idArticle' value=''></td>";
		echo "<td><input size='5' name=\"PRIX_$idArticle\" value=\"$article->prixTTCCourant\" type='text'></td>";
		echo "<td><input size='5' name=\"QUANTITE_$idArticle\" type='text'></td>";
		echo "<td class=\"tdQuantite\">$quantiteReelle</td>";
		echo "<td class=\"tdQuantiteVirtuelle\">$quantiteVirtuelle</td>";
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