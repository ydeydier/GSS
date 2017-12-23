<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>

<CENTER>

<br>
<h1>Changer le stock à gérer</h1>
<br>

<form method="POST" action="changerStockAGerer_trt.php">
<table class="tableCommune">
<tr><th>Nom</th><th>Sélection</th></tr>
<?php
	$tTousStocks = stock::chargerToutSansLigne();
	foreach ($utilisateur->tStocks as $idStockForm) {
		$nomStock=$tTousStocks[$idStockForm]->nom;
		if ($idStockForm==$idStock) $checked='checked="checked"'; else $checked='';
		echo "<tr><td>$nomStock</td><td><input $checked type=\"radio\" value=\"$idStockForm\" name=\"rdoStock\"></td></tr>";
	}
?>
</table>
<br><br>

<?php
	if (sizeof($utilisateur->tStocks)>1) {
?>
<input name="chkStockDefaut" id="idChkStockDefaut" type="checkbox" value="idChkStockDefaut">
<label for="idChkStockDefaut" title="=Sélectionné au moment de la connexion">Faire de ce stock mon stock par défaut</label>
<br><br>
<?php
	}
?>

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