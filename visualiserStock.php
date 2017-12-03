<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>

<CENTER>

<br><br>
Contenu du stock
<br><br>


<table class="tableCommune">
<tr><th>ID</th><th>Nom</th><th>Prix</th><th>Quantite<br>réelle</th><th>Quantite<br>Virtuelle</th></tr>
<?php
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		echo "<tr><td>$idArticle</td><td>$article->nom</td><td class=\"tdPrix\">$article->prixCourant</td><td class=\"tdQuantite\">$ligneStock->quantiteReelle</td><td class=\"tdQuantite\">$ligneStock->quantiteVirtuelle</td></tr>";
	}
?>
</table>
<br><br>

<a class="menu" href="editerStock.php">Modifier</a><br>
<a class="menu" href="pagePrincipale.php">Retour au menu</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>