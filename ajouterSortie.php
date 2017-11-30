<?php
	require "inc_commun.php";
	require "header_et_menu.php";
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

<br><br>
<h1>Ajout d'une sortie</h1>
<br><br>

<form method="POST" name="formulaire" onsubmit="return validerForm();" action="ajouterSortie_trt.php">
Nom de la sortie <input type="text" value="" name="txtNomSortie">
<br><br><br><br>
<table class="tableCommune">
<tr><th>Nom</th><th>Prix</th><th>Stock<br>réel</th><th>Stock<br>virtuel</th><th>Quantité</th></tr>
<?php
	chargerStock(); // impose de rechargement du stock
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		echo "<tr><td>$article->nom</td><td>$article->prixCourant</td><td>$ligneStock->quantiteReelle</td><td>$ligneStock->quantiteVirtuelle</td><td><input size='5' name=\"QUANTITE_$idArticle\" type='text'></td></tr>";
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