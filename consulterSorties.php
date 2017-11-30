<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>
<script type="text/javascript">
function rendreVirtuelle(idSortie) {
	if (confirm('Etes vous sur(e) de vouloir rendre VIRTUELLE cette sortie ?\nLes articles seront ré-intégrés dans le stock.')) {
		window.location="consulterSorties_trt.php?action=RendreVirtuelle&idSortie=" + idSortie;
	}
}
function rendreReelle(idSortie) {
	if (confirm('Etes vous sur(e) de vouloir rendre REELLE cette sortie ?\nLes articles seront retirés du stock.')) {
		window.location="consulterSorties_trt.php?action=RendreReelle&idSortie=" + idSortie;
	}
}
</script>


<CENTER>

<br><br>
Liste des sorties
<br><br>


<table class="tableCommune">
<tr><th>ID</th><th>Nom</th><th>Etat</th><th>Coût total</th><th>Nbre articles</th><th>Consulter</th><th>Modifier</th><th>Supprimer<br>(corbeille)</th><th>Changer état</th></tr>
<?php
	$sorties = sortie::chargerPourStockSansLigne($stock);
	foreach ($sorties as $sortie) {
		if ($sortie->etat==sortie::$VIRTUELLE) {
			$changerEtat="Rendre REELLE";
			$fctChangeEtat="rendreReelle($sortie->idSortie)";	// Fonction javascript à appeler
		} else {
			$changerEtat="Rendre VIRTUELLE";
			$fctChangeEtat="rendreVirtuelle($sortie->idSortie)";	// Fonction javascript à appeler
		}
		echo "<tr><td>$sortie->idSortie</td><td>$sortie->nom</td><td>$sortie->etat</td><td>$sortie->coutTotal</td><td>$sortie->nbreArticles</td>";
		echo "<td><a href=\"consulterSortie.php?id=$sortie->idSortie\">Consulter</a></td><td><a href=\"modifierSortie.php?id=$sortie->idSortie\">Modifier</a></td><td><a href=\"\">Supprimer</a></td><td><a href=\"javascript:$fctChangeEtat;\">$changerEtat</a></td></tr>";
	}
?>
</table>
<br><br>
<a class="menu" href="ajouterSortie.php">Ajouter une sortie</a><br>
<a class="menu" href="">Voir la corbeille</a><br>
<a class="menu" href="pagePrincipale.php">Retour Page Accueil</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>