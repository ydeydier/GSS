</td>
<td class="tdDroiteStock" align="center" valign="top">
	<br>
	Etat du stock<br><br>
	<table class="tableStockADroite">
	<tr><th>Nom</th><th>Prix</th><th>Quantite<br>réelle</th><th>Quantite<br>Virtuelle</th></tr>
	<?php
		chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
		foreach ($stock->tLigneStock as $ligneStock) {
			$article=$ligneStock->article;
			echo "<tr><td>$article->nom</td><td class=\"tdPrix\">$article->prixCourant</td><td class=\"tdQuantite\">$ligneStock->quantiteReelle</td><td class=\"tdQuantite\">$ligneStock->quantiteVirtuelle</td></tr>";
		}
	?>
	</table>
</td>
</tr>
</table>

</body>
</html>