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
	foreach ($utilisateur->tStocks as $idStockFor) {
		$nomStock=stock::chargerNom($idStockFor);
		if ($idStockFor==$idStock) $checked='checked="checked"'; else $checked='';
		echo "<tr><td>$nomStock</td><td><input $checked type=\"radio\" value=\"$idStockFor\" name=\"rdoStock\"></td></tr>";
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