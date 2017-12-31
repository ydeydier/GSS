<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>
<script type="text/javascript">
function validerForm() {
	if ( document.formulaire.txtNom.value.trim() == "" ) {
		alert ( "Veuillez saisir un nom !" );
		return false;
	}
	return true;
}
</script>

<CENTER>
<br>
<h1>Modifier un utilisateur</h1>
<br><br><br>

<form method="POST" name="formulaire" onsubmit="return validerForm();" action="modifierUtilisateur_trt.php">
<table class="tableCommune">
<?php
	$login=$_GET["login"];
	$utilModif = utilisateur::charger($login);
	$_SESSION["utilModif"]=$utilModif;
	echo "<tr><th>Login</th><td>$utilModif->login</td></tr>";
	echo "<tr><th>Nom</th><td><input autofocus name=\"txtNom\" type=\"text\" value=\"$utilModif->nom\"></td></tr>";
	echo "<tr><th>Prénom</th><td><input name=\"txtPrenom\" type=\"text\" value=\"$utilModif->prenom\"></td></tr>";
	echo "<tr><th>Mot de passe</th><td><input name=\"txtPassword\" type=\"password\" value=\"$utilModif->password\"></td></tr>";
	if (! $utilModif->estAdministrateur()) {
		echo "<tr>";
		echo "<th>Gère le(s) stock(s)</th>";
		echo "<td>";
			$tTousStocks = stock::chargerToutSansLigne();
			foreach ($tTousStocks as $stockForm) {
				$idStockForm=$stockForm->idStock;
				if ($utilModif->autorisePourStock($idStockForm)) {
					$checked=" checked";
				} else {
					$checked="";
				}
			echo "<input $checked name=\"chkStock[]\" id=\"id$idStockForm\" type=\"checkbox\" value=\"$idStockForm\"><label for=\"id$idStockForm\">$stockForm->nom</label><br>";
			}
		echo "</td>";
		echo "</tr>";
	}
?>
</table>
<br><br><br>
<button type="submit" class="boutonValider">Valider</button>
&nbsp;&nbsp;&nbsp
<button type="button" class="boutonAnnuler" onclick="javascript:window.location='gererUtilisateurs.php'">Annuler</button>
</form>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>