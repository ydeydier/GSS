<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>
<script type="text/javascript">
function supprimer(idUtilisateur) {
	if (confirm('Etes vous sur(e) de vouloir SUPPRIMER cet utilisateur ?')) {
		window.location="gererUtilisateurs_trt.php?action=Supprimer&idUtilisateur=" + idUtilisateur;
	}
}
</script>
<CENTER>

<br>
<h1>Gérer les utilisateurs</h1>
<br>

<table class="tableCommune">
<tr><th>Nom</th><th>Prénom</th><th>Login</th><th>Gère le(s) stock(s)</th><th>Admin</th><th>Modifier</th><th>Supprimer</th></tr>
<?php
	$tUtilisateurs = utilisateur::chargerTout();
	$tTousStocks = stock::chargerToutSansLigne();
	foreach ($tUtilisateurs as $util) {
		$nomsStock="";
		foreach ($util->tStocks as $idStockForm) {
			$nomsStock.="<li>".$tTousStocks[$idStockForm]->nom."</li>";
		}
		echo "<tr><td>$util->nom</td><td>$util->prenom</td><td>$util->login</td><td>$nomsStock</td><td>$util->administrateur</td><td><a href=\"modifierUtilisateur.php?login=$util->login\">Modifier</a></td><td><a href=\"javascript:supprimer('$util->idUtilisateur');\">Supprimer</a></td></tr>";
	}
?>
</table>
<br><br><br><br>
<a class="menu" href="ajouterUtilisateur.php">Ajouter un utilisateur</a><br>
<a class="menu" href="pagePrincipaleAdmin.php">Retour Page Accueil</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>