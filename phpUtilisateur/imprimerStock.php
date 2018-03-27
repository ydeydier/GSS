<?php
	require "inc_commun.php";
?>
<!DOCTYPE html>
<html>
<HEAD>
<TITLE>GSS</TITLE>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="imagetoolbar" content="no">
<META name="keywords" content="gestion,stock">
<LINK media="screen" href="../phpCommun/style.css" type="text/css" rel="stylesheet">
<LINK media="print" href="../phpCommun/stylePrint.css" type="text/css" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="../img/GSS.ico" />
</HEAD>
<BODY>
<script type="text/javascript">
	window.print();
</script>
<CENTER>
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
		$prixTTCCourant=$article->prixTTCCourant;
		$quantiteReelle=$ligneStock->quantiteReelle;
		$quantiteVirtuelle=$ligneStock->quantiteVirtuelle;
		$total+=$quantiteReelle*$prixTTCCourant;
		if ($quantiteReelle==$quantiteVirtuelle) $quantiteVirtuelle="";
		$quantiteReelle=afficherEntierSansDec($quantiteReelle);
		$quantiteVirtuelle=afficherEntierSansDec($quantiteVirtuelle);
		echo "<tr>";
		echo "<td>$article->nom</td>";
		echo "<td class=\"tdPrix\">$prixTTCCourant</td>";
		echo "<td class=\"tdQuantite\">$quantiteReelle</td>";
		echo "<td class=\"tdQuantiteVirtuelle\">$quantiteVirtuelle</td>";
		echo "</tr>";
	}
	$total=number_format($total, 2, '.', ' ');
	echo "<tr><td><b>Total TTC (prix * Qté réelle)</b></td><td><b>$total</b></td></tr>";
?>
</table>
<br><br>
<a class="menu" href="javascript:window.print()">Imprimer</a><br>
<a class="menu" href="javascript:window.close()">Fermer</a><br>
</CENTER>
<br><br><br><br>
</body>
</html>