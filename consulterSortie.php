<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$idSortie=$_GET["id"];
	$sortie = sortie::charger($idSortie, $stock);
?>

<CENTER>

<br><br>
Consulter une sortie
<br><br>

<?php
	echo "<h1>$sortie->nom</h1>";
?>
<br><br>
<table class="tableCommune">
<tr><th>Nom</th><th>Quantité</th><th>Prix unitaire</th><th>Prix total</th></tr>
<?php
	foreach ($sortie->tLigneSortie as $ligneSortie) {
		$nom=$ligneSortie->article->nom;
		$prixSortie=$ligneSortie->prixSortie;
		$quantite=$ligneSortie->quantite;
		$prixTotal=$prixSortie * $quantite;
		echo "<tr><td>$nom</td><td>$quantite</td><td>$prixSortie</td><td>$prixTotal</td></tr>";
	}
	echo "<tr><td>Total</td><td></td><td></td><td>$sortie->coutTotal</td></tr>";
?>
</table>
<br><br>
<a class="menu" href="modifierSortie.php?id=<?php echo $sortie->idSortie;?>">Modifier</a><br>
<a class="menu" href="consulterSorties.php">Retour à la liste des sorties</a><br>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>
