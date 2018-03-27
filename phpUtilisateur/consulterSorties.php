<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	// Charge la liste des années et mois des sorties présentes dans le stock
	$listeAnneesMois = sortie::chargerListeAnneeMois($stock);
	// Si une période est passée en paramètre d'URL, elle définira la valeur du filtre
	if (isset($_GET['periode'])) {
		$periodeFiltre=$_GET['periode'];
	} else {
		$periodeFiltre="N30";
	}
	// Chargement des sorties, en fonction du filtre
	$sorties = sortie::chargerPourStockSansLigneAvecFiltre($stock, 'N', $periodeFiltre);
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
<br><br>
Filtre&nbsp;&nbsp;
<select onchange="javascript:window.location='consulterSorties.php?periode=' + this.value;">
<option <?php echo ($periodeFiltre=="TToutes"?" selected":""); ?> value="TToutes">Toutes</option>
<option <?php echo ($periodeFiltre=="N15"   ?" selected":""); ?> value="N15">Les 15 dernières</option>
<option <?php echo ($periodeFiltre=="N30"   ?" selected":""); ?> value="N30">Les 30 dernières</option>
	<?php
	foreach ($listeAnneesMois as $anneeMois) {
		list($annee, $mois) = split("-", $anneeMois);
		$mois=intval($mois);
		$moisLib=libelleDuMoisCourt($mois);
		echo "<option ".($periodeFiltre=="M$annee-$mois"?" selected":"")." value=\"M$annee-$mois\">$annee - $moisLib</option>";
	}
	?>
</select>
<br><br><br>

<table class="tableCommune">
<tr><th>Nom</th><th>Date</th><th>Etat</th><th>Coût total<br>(TTC)</th><th>Nbre<br>articles</th><th>Voir</th><th>Modif.</th><th>Sup.</th><th>Changer état</th></tr>
<?php
	foreach ($sorties as $sortie) {
		if ($sortie->etat==sortie::$VIRTUELLE) {
			$changerEtat="Rendre réelle";
			$couleurEtat="#006573";
			$fctChangeEtat="rendreReelle($sortie->idSortie)";	// Fonction javascript à appeler
		} else {
			$changerEtat="Rendre virtuelle";
			$fctChangeEtat="rendreVirtuelle($sortie->idSortie)";	// Fonction javascript à appeler
			$couleurEtat="#000000";
		}
		$libelleEtat=$sortie->libelleEtat();
		echo "<tr><td>$sortie->nom</td><td>$sortie->date</td><td style=\"color:$couleurEtat;\">$libelleEtat</td><td class=\"tdPrix\">$sortie->coutTTCTotal</td><td class=\"tdQuantite\">$sortie->nbreArticles</td>";
		echo "<td align=\"center\"><a href=\"consulterSortie.php?id=$sortie->idSortie\"><img onmouseover=\"this.src='../img/view_over.png'\" onmouseout=\"this.src='../img/view.png'\" src=\"../img/view.png\"></a></td><td align=\"center\"><a href=\"javascript:modifier($sortie->idSortie, '$sortie->etat');\"><img onmouseover=\"this.src='../img/edit_over.png'\" onmouseout=\"this.src='../img/edit.png'\" src=\"../img/edit.png\"></a></td><td align=\"center\"><a href=\"javascript:supprimer($sortie->idSortie);\"><img onmouseover=\"this.src='../img/delete_over.png'\" onmouseout=\"this.src='../img/delete.png'\" src=\"../img/delete.png\"></a></td><td><a href=\"javascript:$fctChangeEtat;\">$changerEtat</a></td></tr>";
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