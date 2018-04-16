</td>
<td class="tdDroiteStock" align="center" valign="top">
	<br>
	Etat du stock<br><br>
	<table width="300px" class="tableStockADroite">
	<tr><th>Nom</th><th>Prix<br>TTC</th><th>Quantite<br>réelle</th><th>Quantite<br>Virtuelle</th></tr>
	<?php
		foreach ($stock->tLigneStock as $ligneStock) {
			$article=$ligneStock->article;
			$quantiteReelle=$ligneStock->quantiteReelle;
			$quantiteVirtuelle=$ligneStock->quantiteVirtuelle;
			if ($quantiteReelle==$quantiteVirtuelle) $quantiteVirtuelle="";
			$quantiteReelle=afficherEntierSansDec($quantiteReelle);
			$quantiteVirtuelle=afficherEntierSansDec($quantiteVirtuelle);
			if ($quantiteReelle>=0) {
				$styleQuantiteReelle="tdQuantite";
			} else {
				$styleQuantiteReelle="tdQuantiteNegative";
			}
			if ($quantiteVirtuelle>=0) {
				$styleVirtuelle="tdQuantiteVirtuelle";
			} else {
				$styleVirtuelle="tdQuantiteVirtuelleNegative";
			}
			echo "<tr><td>$article->nom</td><td class=\"tdPrix\">$article->prixTTCCourant</td><td class=\"$styleQuantiteReelle\">$quantiteReelle</td><td class=\"$styleVirtuelle\">$quantiteVirtuelle</td></tr>";
		}
	?>
	</table>
</td>
</tr>
</table>
</body>
</html>