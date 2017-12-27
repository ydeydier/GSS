<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>
<script type="text/javascript">
function supprimer(idStock) {
	if (confirm('Etes vous sur(e) de vouloir SUPPRIMER ce stock ?')) {
		window.location="gererStocks_trt.php?action=Supprimer&idStock=" + idStock;
	}
}
</script>
<CENTER>

<br>
<h1>Gérer les stocks</h1>
<br>

<table class="tableCommune">
<tr><th>ID</th><th>Nom</th><th>Modifier</th><th>Supprimer</th></tr>
<?php
	$stocks = stock::chargerToutSansLigne();
	foreach ($stocks as $stock) {
		echo "<tr><td>$stock->idStock</td><td>$stock->nom</td><td><a href=\"modifierStock.php?idStock=$stock->idStock\">Modifier</a></td><td><a href=\"javascript:supprimer($stock->idStock);\">Supprimer</a></td></tr>";
	}
?>
</table>
<br><br><br><br>
<a class="menu" href="ajouterStock.php">Ajouter un stock</a><br>
<a class="menu" href="pagePrincipaleAdmin.php">Retour Page Accueil</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>