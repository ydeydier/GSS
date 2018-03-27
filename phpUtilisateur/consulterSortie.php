<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$idSortie=$_GET["id"];
	$sortie = sortie::charger($idSortie, $stock);
	$bUtiliseBeneficiaire=($stock->utiliseBeneficiaire=="O");

	if ($sortie->etat==sortie::$VIRTUELLE) {
		$changerEtat="Rendre réelle";
		$couleurEtat="#006573";
		$fctChangeEtat="rendreReelle($sortie->idSortie)";	// Fonction javascript à appeler
	} else {
		$changerEtat="Rendre virtuelle";
		$couleurEtat="#000000";
		$fctChangeEtat="rendreVirtuelle($sortie->idSortie)";	// Fonction javascript à appeler
	}
?>
<script type="text/javascript">
function rendreVirtuelle(idSortie) {
	if (confirm('Etes vous sur(e) de vouloir rendre VIRTUELLE cette sortie ?\nLes articles seront ré-intégrés dans le stock.')) {
		window.location="consulterSortie_trt.php?action=RendreVirtuelle&idSortie=" + idSortie;
	}
}
function rendreReelle(idSortie) {
	if (confirm('Etes vous sur(e) de vouloir rendre REELLE cette sortie ?\nLes articles seront retirés du stock.')) {
		window.location="consulterSortie_trt.php?action=RendreReelle&idSortie=" + idSortie;
	}
}

function modifier(idSortie, etat) {
	if (etat=="<?php echo sortie::$REELLE;?>") {
		alert('ATTENTION : avant de pouvoir modifier une sortie, vous devez la rendre virtuelle.');
	} else {
		window.location="modifierSortie.php?id=" + idSortie;
	}
}
</script>

<CENTER>

<br>
<h1>Sortie : <?php echo $sortie->nom;?></h1>
<br>
Etat : <b style="color:<?php echo $couleurEtat;?>;"><?php echo $sortie->libelleEtat();?></b>
<br><br>
<table width="40%" class="tableCommune">
<tr><th width="20%" nowrap align="left">Date (jj/mm/aaaa)&nbsp;&nbsp;&nbsp;</th><td width="80%"><?php echo $sortie->date;?></td></tr>
<tr><th nowrap align="left">Commentaire&nbsp;&nbsp;&nbsp;</th><td><?php echo str_replace("\n", "<br>", $sortie->commentaire);?></td></tr>
<tr><th nowrap align="left">Ressources&nbsp;&nbsp;&nbsp;</th><td><?php echo str_replace("\n", "<br>", $sortie->ressources);?></td></tr>
</table>
<br><br>
<table class="tableCommune">
<tr><th>Nom</th><?php if ($bUtiliseBeneficiaire) echo "<th>Bénéficiaire</th>";?><th>Prix unit.<br>(TTC)</th><th>Quantité</th><th>Prix total<br>(TTC)</th></tr>
<?php
	foreach ($sortie->tLigneSortie as $ligneSortie) {
		$nom=$ligneSortie->article->nom;
		$prixTTCSortie=$ligneSortie->prixTTCSortie;
		$quantite=afficherEntierSansDec($ligneSortie->quantite);
		$prixTotal=$prixTTCSortie * $quantite;
		$prixTotal=number_format($prixTotal, 2, '.', ' ');
		echo "<tr>";
		echo "<td>$nom</td>";
		if ($bUtiliseBeneficiaire) echo "<td>$ligneSortie->beneficiaire</td>";
		echo "<td class=\"tdPrix\">$prixTTCSortie</td><td class=\"tdQuantite\">$quantite</td><td class=\"tdPrix\">$prixTotal</td></tr>";
	}
	$colSpan=($bUtiliseBeneficiaire?4:3);
	echo "<tr><td colspan=\"$colSpan\"><b>Total</b></td><td class=\"tdPrix\"><b>$sortie->coutTTCTotal</b></td></tr>";
	$colSpan++;
	echo "<tr><td colspan=\"$colSpan\" style=\"background:#FFFFFF;\" align=\"right\"><a target=\"_blank\" href=\"imprimerSortie.php?id=$sortie->idSortie\"><img src=\"../img/printer.png\"></a></td></tr>";
?>
</table>
<br><br>
<a class="menu" href="javascript:modifier(<?php echo $sortie->idSortie;?>, '<?php echo $sortie->etat;?>')">Modifier</a><br>
<a class="menu" href="javascript:<?php echo $fctChangeEtat;?>"><?php echo $changerEtat;?></a><br>
<a class="menu" href="consulterSorties.php">Retour à la liste des sorties</a><br>
</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>
