<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$idSortie=$_GET["id"];
	$sortie = sortie::charger($idSortie, $stock);
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

<br><br>

Sortie <b>"<?php echo $sortie->nom;?>"</b>
<br><br>
Etat <b><?php echo $sortie->libeleEtat();?></b>
<br><br><br>
<table class="tableCommune">
<tr><th>Nom</th><th>Quantité</th><th>Prix<br>unitaire</th><th>Prix<br>total</th></tr>
<?php
	foreach ($sortie->tLigneSortie as $ligneSortie) {
		$nom=$ligneSortie->article->nom;
		$prixSortie=$ligneSortie->prixSortie;
		$quantite=$ligneSortie->quantite;
		$prixTotal=$prixSortie * $quantite;
		$prixTotal=number_format($prixTotal, 2, '.', ' ');
		echo "<tr><td>$nom</td><td class=\"tdQuantite\">$quantite</td><td class=\"tdPrix\">$prixSortie</td><td class=\"tdPrix\">$prixTotal</td></tr>";
	}
	echo "<tr><td>Total</td><td></td><td></td><td class=\"tdPrix\">$sortie->coutTotal</td></tr>";
?>
</table>
<br><br>
<?php
	if ($sortie->etat==sortie::$VIRTUELLE) {
		$changerEtat="Rendre REELLE";
		$fctChangeEtat="rendreReelle($sortie->idSortie)";	// Fonction javascript à appeler
	} else {
		$changerEtat="Rendre VIRTUELLE";
		$fctChangeEtat="rendreVirtuelle($sortie->idSortie)";	// Fonction javascript à appeler
	}
?>


<a class="menu" href="javascript:javascript:modifier(<?php echo $sortie->idSortie;?>, '<?php echo $sortie->etat;?>')">Modifier</a><br>
<a class="menu" href="javascript:<?php echo $fctChangeEtat;?>"><?php echo $changerEtat;?></a><br>
<a class="menu" href="consulterSorties.php">Retour à la liste des sorties</a><br>
</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>
