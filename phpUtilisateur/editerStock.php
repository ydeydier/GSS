<?php
	require "inc_commun.php";
	require "header_et_menu.php";
?>

<CENTER>

<br>
<h1>Modifier le stock</h1>
<br>

<form method="POST" name="leForm" action="editerStock_trt.php">
<table class="tableCommune">
<tr><th>ID</th><th>Nom</th><th>Prix</th><th>Quantite<br>réelle</th></tr>
<?php
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$nom=htmlspecialchars($article->nom, ENT_QUOTES);
		echo "<tr><td>$idArticle</td><td><input type='text' name='NOM_$idArticle' value='$nom'></td><td><input type='text' size='7' name='PRIX_$idArticle' value='$article->prixCourant'></td><td><input type='text' size='5' name='QUANTITEREELLE_$idArticle' value='$ligneStock->quantiteReelle'></td></tr>";
	}
	for ($i=1;$i<=5;$i++) {
		echo "<tr><td></td><td><input type='text' name='INSERT_NOM_$i' value=''></td><td><input type='text' size='7' name='INSERT_PRIX_$i' value=''></td><td><input type='text' size='5' name='INSERT_QUANTITEREELLE_$i' value=''></td></tr>";
	}
?>
</table>

<br><br>
<span class="attention"><b>Attention :</b> les modifications de noms d'article seront répercutées sur les sorties.
<br>En revanche les prix peuvent être modifiés ici sans affecter les sorties.</span>
<br>

<br><br>
<button type="submit" class="boutonValider">Valider</button>
&nbsp;&nbsp;&nbsp
<button type="button" class="boutonAnnuler" onclick="javascript:window.location='visualiserStock.php'">Annuler</button>

</form>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>