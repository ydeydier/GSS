<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>
<script type="text/javascript">
function rendreVirtuel(idEvenement) {
	if (confirm('Etes vous sur(e) de vouloir rendre VIRTUEL cet événement ?\nLes articles seront ré-intégrés dans le stock.')) {
		window.location="visualiserEvenements_trt.php?action=RendreVirtuel&idEvenement=" + idEvenement;
	}
}
function rendreReel(idEvenement) {
	if (confirm('Etes vous sur(e) de vouloir rendre REEL cet événement ?\nLes articles seront retirés du stock.')) {
		window.location="visualiserEvenements_trt.php?action=RendreReel&idEvenement=" + idEvenement;
	}
}
</script>


<CENTER>

<br><br>
Liste des événements
<br><br>


<table class="tableCommune">
<tr><th>ID</th><th>Nom</th><th>Etat</th><th>Coût total</th><th>Nbre articles</th><th>Consulter</th><th>Modifier</th><th>Supprimer<br>(corbeille)</th><th>Changer état</th></tr>
<?php
	$evenements = evenement::lireEnBasePourStock($stock);
	foreach ($evenements as $evenement) {
		$coutTotal=$evenement->coutTotal();
		$nbreArticles=$evenement->nbreArticles();
		if ($evenement->etat==evenement::$VIRTUEL) {
			$changerEtat="Rendre REEL";
			$fctChangeEtat="rendreReel($evenement->idEvenement)";	// Fonction javascript à appeler
		} else {
			$changerEtat="Rendre VIRTUEL";
			$fctChangeEtat="rendreVirtuel($evenement->idEvenement)";	// Fonction javascript à appeler
		}
		echo "<tr><td>$evenement->idEvenement</td><td>$evenement->nom</td><td>$evenement->etat</td><td>$coutTotal</td><td>$nbreArticles</td><td><a href=\"visualiserEvenement.php?id=$evenement->idEvenement\">Consulter</a></td><td><a href=\"modifierEvenement.php?id=$evenement->idEvenement\">Modifier</a></td><td><a href=\"\">Supprimer</a></td><td><a href=\"javascript:$fctChangeEtat;\">$changerEtat</a></td></tr>";
	}
?>
</table>
<br><br>
<a class="menu" href="ajouterEvenement.php">Ajouter un événement</a><br>
<a class="menu" href="">Voir la corbeille</a><br>
<a class="menu" href="pagePrincipale.php">Retour Page Accueil</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>