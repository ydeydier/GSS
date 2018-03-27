<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>
<script type="text/javascript">
function restaurer(idSortie) {
	if (confirm('Etes vous sur(e) de vouloir restaurer (sortir de la corbeille) cette sortie ?')) {
		window.location="consulterSortiesCorbeille_trt.php?action=Restaurer&idSortie=" + idSortie;
	}
}
function supprimer(idSortie) {
	if (confirm('Etes vous sur(e) de vouloir supprimer définitivement cette sortie ?')) {
		window.location="consulterSortiesCorbeille_trt.php?action=Supprimer&idSortie=" + idSortie;
	}
}
</script>


<CENTER>

<br>
<h1>Liste des sorties en corbeille (supprimées)</h1>
<br>


<table class="tableCommune">
<tr><th>ID</th><th>Nom</th><th>Etat</th><th>Coût total<br>(TTC)</th><th>Nbre articles</th><th>Restaurer</th><th>Supprimer<br>définitivement</th><th</tr>
<?php
	$sorties = sortie::chargerPourStockSansLigne($stock, 'O');
	foreach ($sorties as $sortie) {
		$libelleEtat=$sortie->libelleEtat();
		echo "<tr><td>$sortie->idSortie</td><td>$sortie->nom</td><td>$libelleEtat</td><td>$sortie->coutTTCTotal</td><td>$sortie->nbreArticles</td>";
		echo "<td><a href=\"javascript:restaurer($sortie->idSortie);\">Restaurer</a></td>";
		echo "<td><a href=\"javascript:supprimer($sortie->idSortie);\">Supprimer</a></td>";
		echo "</tr>";
	}
?>
</table>
<br><br>
<a class="menu" href="consulterSorties.php">Consulter sorties non supprimées</a><br>
<a class="menu" href="pagePrincipale.php">*** Retour Page Accueil ***</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>