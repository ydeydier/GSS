<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>
<CENTER>

<br>
<h1>Modifier un stock</h1>
<br><br><br>

<form method="POST" action="modifierStock_trt.php">
<?php
	$idStock=$_GET["idStock"];
	$stock = stock::charger($idStock);
	$_SESSION["stock"]=$stock;
	echo "Nom : <input name=\"txtNomStock\" type=\"text\" value=\"$stock->nom\">";
?>
<br><br><br>
<button type="submit" class="boutonValider">Valider</button>
&nbsp;&nbsp;&nbsp
<button type="button" class="boutonAnnuler" onclick="javascript:window.location='gererStocks.php'">Annuler</button>
</form>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>