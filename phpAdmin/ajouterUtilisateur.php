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
	txtLogin=document.formulaire.txtLogin.value;
	if ( txtLogin.trim() == "" ) {
		alert ( "Veuillez saisir un login !" );
		return false;
	}
	if ( txtLogin.indexOf(" ")!=-1 ) {
		alert ( "Le login ne doit pas comporter d'espace !" );
		return false;
	}
	return true;
}
</script>

<CENTER>
<br>
<h1>Ajouter un utilisateur</h1>
<br><br><br>

<form method="POST" name="formulaire" onsubmit="return validerForm();" action="ajouterUtilisateur_trt.php">
<table class="tableCommune">
<?php
	echo "<tr><th>Nom</th><td><input autofocus name=\"txtNom\" type=\"text\" value=\"\"></td></tr>";
	echo "<tr><th>Prénom</th><td><input name=\"txtPrenom\" type=\"text\" value=\"\"></td></tr>";
	echo "<tr><th>Login</th><td><input name=\"txtLogin\" type=\"text\" value=\"\"></td></tr>";
	echo "<tr><th>Mot de passe</th><td><input name=\"txtPassword\" type=\"password\" value=\"\"></td></tr>";
	echo "<tr>";
	echo "<th>Gère le(s) stock(s)</th>";
	echo "<td>";
		$tTousStocks = stock::chargerToutSansLigne();
		foreach ($tTousStocks as $stockForm) {
			$idStockForm=$stockForm->idStock;
		echo "<input name=\"chkStock[]\" id=\"id$idStockForm\" type=\"checkbox\" value=\"$idStockForm\"><label for=\"id$idStockForm\">$stockForm->nom</label><br>";
		}
	echo "</td>";
	echo "</tr>";
?>
</table>
<br><br><br>
<button type="submit" class="boutonValider">Valider</button>
&nbsp;&nbsp;&nbsp
<button type="button" class="boutonAnnuler" onclick="javascript:window.location='gererUtilisateurs.php'">Annuler</button>
</form>
<br><br><br>
<b>Remarque :</b> si un mot de passe est saisi, il ne sera pas<br>recherché dans l'annuaire LDAP au moment de la connexion.
</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>