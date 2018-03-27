<?php
	require "inc_commun.php";
	$idSortie=$_GET["id"];
	$sortie = sortie::charger($idSortie, $stock);
	$bUtiliseBeneficiaire=($stock->utiliseBeneficiaire=="O");
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
<h1><?php echo $sortie->nom;?></h1>
<br>
<table width="400px" class="tableCommune">
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
	echo "<tr><td colspan='$colSpan'><b>Total</b></td><td class=\"tdPrix\"><b>$sortie->coutTTCTotal</b></td></tr>";
?>
</table>
<br><br>
<a class="menu" href="javascript:window.print()">Imprimer</a><br>
<a class="menu" href="javascript:window.close()">Fermer</a><br>
</CENTER>
<br><br><br><br>
</body>
</html>