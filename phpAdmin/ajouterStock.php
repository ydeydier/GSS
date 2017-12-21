<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>
<CENTER>

<br>
<h1>Ajouter un stock</h1>
<br><br><br>

<form method="POST" action="ajouterStock_trt.php">
<?php
	echo "Nom : <input autofocus name=\"txtNomStock\" type=\"text\" value=\"\">";
?>
<br><br><br><br>
<button type="submit" class="boutonValider">Valider</button>
&nbsp;&nbsp;&nbsp
<button type="button" class="boutonAnnuler" onclick="javascript:window.location='gererStocks.php'">Annuler</button>
</form>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>