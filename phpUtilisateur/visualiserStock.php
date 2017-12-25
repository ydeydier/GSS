<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>

<CENTER>

<br>
<h1>Contenu du stock</h1>
<br>

<table class="tableCommune">
<tr><th>ID</th><th>Nom</th><th>Prix</th><th>Quantite<br>réelle</th><th>Quantite<br>Virtuelle</th></tr>
<?php
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$quantiteReelle=$ligneStock->quantiteReelle;
		$quantiteVirtuelle=$ligneStock->quantiteVirtuelle;
		if ($quantiteReelle==$quantiteVirtuelle) $quantiteVirtuelle="";
		echo "<tr><td>$idArticle</td><td>$article->nom</td><td class=\"tdPrix\">$article->prixCourant</td><td class=\"tdQuantite\">$quantiteReelle</td><td class=\"tdQuantiteVirtuelle\">$quantiteVirtuelle</td></tr>";
	}
?>
</table>
<br><br>

<a class="menu" href="editerStock.php">Modifier</a><br>
<a class="menu" href="pagePrincipale.php">*** Retour Page Accueil ***</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>