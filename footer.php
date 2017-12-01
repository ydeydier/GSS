</td>
<td align="center">
	Le stock<br><br>
	<table class="tableStockADroite">
	<tr><th>Nom</th><th>Prix</th><th>Quantite<br>réelle</th><th>Quantite<br>Virtuelle</th></tr>
	<?php
		chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
		foreach ($stock->tLigneStock as $ligneStock) {
			$article=$ligneStock->article;
			echo "<tr><td>$article->nom</td><td>$article->prixCourant</td><td>$ligneStock->quantiteReelle</td><td>$ligneStock->quantiteVirtuelle</td></tr>";
		}
	?>
	</table>
</td>
</tr>
</table>

</body>
</html>