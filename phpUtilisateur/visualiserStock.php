<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>

<CENTER>

<br>
<h1>Contenu du stock</h1>
<br>
<table class="tableCommune">
<tr><th>Nom</th><th>Prix<br>(TTC)</th><th>Quantite<br>réelle</th><th>Quantite<br>Virtuelle</th></tr>
<?php
	$total=0;
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$prixCourant=$article->prixCourant;
		$quantiteReelle=$ligneStock->quantiteReelle;
		$quantiteVirtuelle=$ligneStock->quantiteVirtuelle;
		$total+=$quantiteReelle*$prixCourant;
		if ($quantiteReelle==$quantiteVirtuelle) $quantiteVirtuelle="";
		$quantiteReelle=afficherEntierSansDec($quantiteReelle);
		$quantiteVirtuelle=afficherEntierSansDec($quantiteVirtuelle);
		echo "<tr>";
		echo "<td>$article->nom</td>";
		echo "<td class=\"tdPrix\">$prixCourant</td>";
		echo "<td class=\"tdQuantite\">$quantiteReelle</td>";
		echo "<td class=\"tdQuantiteVirtuelle\">$quantiteVirtuelle</td>";
		echo "</tr>";
	}
	$total=number_format($total, 2, '.', ' ');
?>
<tr><td><b>Total TTC (prix * Qté réelle)</b></td><td><b><?php echo $total;?></b></td></tr>
<tr><td colspan="4" style="background:#FFFFFF;" align="right"><a target="_blank" href="imprimerStock.php"><img src="../img/printer.png"></a></td></tr>
</table>
<br><br>

<a class="menu" href="editerStock.php">Modifier</a><br>
<a class="menu" href="pagePrincipale.php">*** Retour Page Accueil ***</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>