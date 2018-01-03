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

function modifier(idSortie, etat) {
	if (etat=="<?php echo sortie::$REELLE;?>") {
		alert('ATTENTION : avant de pouvoir modifier une sortie, vous devez la rendre virtuelle.');
	} else {
		window.location="modifierSortie.php?id=" + idSortie;
	}
}

function supprimer(idSortie) {
	if (confirm('Etes vous sur(e) de vouloir supprimer (mettre à la corbeille) cette sortie ?')) {
		window.location="consulterSorties_trt.php?action=Supprimer&idSortie=" + idSortie;
	}
}
</script>


<CENTER>

<br>
<h1>Liste des sorties</h1>
<br>

<table class="tableCommune">
<tr><th>Nom</th><th>Date</th><th>Etat</th><th>Coût total<br>(TTC)</th><th>Nbre<br>articles</th><th>Consulter</th><th>Modifier</th><th>Supprimer<br>(corbeille)</th><th>Changer état</th></tr>
<?php
	$sorties = sortie::chargerPourStockSansLigne($stock, 'N');
	foreach ($sorties as $sortie) {
		if ($sortie->etat==sortie::$VIRTUELLE) {
			$changerEtat="Rendre REELLE";
			$fctChangeEtat="rendreReelle($sortie->idSortie)";	// Fonction javascript à appeler
		} else {
			$changerEtat="Rendre VIRTUELLE";
			$fctChangeEtat="rendreVirtuelle($sortie->idSortie)";	// Fonction javascript à appeler
		}
		$libelleEtat=$sortie->libelleEtat();
		echo "<tr><td>$sortie->nom</td><td>$sortie->date</td><td>$libelleEtat</td><td class=\"tdPrix\">$sortie->coutTotal</td><td class=\"tdQuantite\">$sortie->nbreArticles</td>";
		echo "<td><a href=\"consulterSortie.php?id=$sortie->idSortie\">Consulter</a></td><td><a href=\"javascript:modifier($sortie->idSortie, '$sortie->etat');\">Modifier</a></td><td><a href=\"javascript:supprimer($sortie->idSortie);\">Supprimer</a></td><td><a href=\"javascript:$fctChangeEtat;\">$changerEtat</a></td></tr>";
	}
?>
</table>
<br><br>
<a class="menu" href="ajouterSortie.php">Ajouter une sortie</a><br>
<a class="menu" href="consulterSortiesCorbeille.php">Voir la corbeille</a><br>
<a class="menu" href="pagePrincipale.php">*** Retour Page Accueil ***</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>