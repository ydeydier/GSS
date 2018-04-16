<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>

<CENTER>

<br>
<h1>Contenu du stock</h1>
<br>
<table class="tableCommune">
<tr><th>Nom</th><th>TVA</th><th>Prix<br>TTC</th><th>Prix<br>HT</th><th>Quantite<br>réelle</th><th>Quantite<br>Virtuelle</th></tr>
<?php
	$totalTTC=0;
	$totalHT=0;
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$prixTTCCourant=$article->prixTTCCourant;
		$tauxTVA=$article->tauxTVA;
		$prixHTCourant=$prixTTCCourant / ($tauxTVA / 100 + 1);
		$prixHTCourant=number_format($prixHTCourant, 3, '.', ' ');
		$quantiteReelle=$ligneStock->quantiteReelle;
		$quantiteVirtuelle=$ligneStock->quantiteVirtuelle;
		$totalTTC+=$quantiteReelle*$prixTTCCourant;
		$totalHT +=$quantiteReelle*$prixHTCourant;
		if ($quantiteReelle==$quantiteVirtuelle) $quantiteVirtuelle="";
		$quantiteReelle=afficherEntierSansDec($quantiteReelle);
		if ($quantiteReelle>=0) {
			$styleQuantiteReelle="tdQuantite";
		} else {
			$styleQuantiteReelle="tdQuantiteNegative";
		}
		$quantiteVirtuelle=afficherEntierSansDec($quantiteVirtuelle);
		if ($quantiteVirtuelle>=0) {
			$styleVirtuelle="tdQuantiteVirtuelle";
		} else {
			$styleVirtuelle="tdQuantiteVirtuelleNegative";
		}
		echo "<tr>";
		echo "<td>$article->nom</td>";
		echo "<td class=\"tdPrix\">$tauxTVA</td>";
		echo "<td class=\"tdPrix\">$prixTTCCourant</td>";
		echo "<td class=\"tdPrix\">$prixHTCourant</td>";
		echo "<td class=\"$styleQuantiteReelle\">$quantiteReelle</td>";
		echo "<td class=\"$styleVirtuelle\">$quantiteVirtuelle</td>";
		echo "</tr>";
	}
	$totalTTC=number_format($totalTTC, 2, '.', ' ');
	$totalHT=number_format($totalHT, 2, '.', ' ');
?>
<tr><td><b>Total (prix * Qté réelle)</b></td><td></td><td><b><?php echo $totalTTC;?></b></td><td><b><?php echo $totalHT;?></b></td><td></td><td></td></tr>
<tr><td colspan="6" style="background:#FFFFFF;" align="right"><a target="_blank" href="imprimerStock.php"><img src="../img/printer.png"></a></td></tr>
</table>
<br><br>

<a class="menu" href="editerStock.php">Modifier</a><br>
<a class="menu" href="pagePrincipale.php">*** Retour Page Accueil ***</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>