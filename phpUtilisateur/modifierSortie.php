<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	$idSortie=$_GET["id"];
	$sortie = sortie::charger($idSortie, $stock);
	$_SESSION["sortie"]=$sortie;	// Variable utile uniquement pour la page de traitement modifierSortie_trt.php
	$bUtiliseBeneficiaire=($stock->utiliseBeneficiaire=="O");
?>
<script type="text/javascript">
function montrerTableAjouterArticle() {
	var table = document.getElementById("tableAjouterArticle");
	if (table.style.display=="none") {
		table.style.display="";
	} else {
		table.style.display="none";
	}
}

function agrandirCommentaire() {
	var text = document.getElementById("idCommentaire");
	if (text.style.width=="35em") {
		text.style.width="";
		text.style.height="";
	} else {
		text.style.width="35em";
		text.style.height="10em";
	}
}

function agrandirRessources() {
	var text = document.getElementById("idRessources");
	if (text.style.width=="35em") {
		text.style.width="";
		text.style.height="";
	} else {
		text.style.width="35em";
		text.style.height="10em";
	}
}
</script>

<CENTER>

<br>
<h1>Modification d'une sortie</h1>
<br>

<form method="POST" action="modifierSortie_trt.php">

<table class="tableCommune">
<tr><th align="left">Nom&nbsp;&nbsp;&nbsp;</th><td><input autofocus size="35" type="text" value="<?php echo $sortie->nom;?>" name="txtNomSortie"></td></tr>
<tr><th align="left">Date (jj/mm/aaaa)&nbsp;&nbsp;&nbsp;</th><td><input size="11" maxlength="10" type="text" value="<?php echo $sortie->date;?>" name="txtDate"></td></tr>
<tr><th align="left">Commentaire&nbsp;&nbsp;&nbsp;</th><td><textarea id="idCommentaire" rows="2" cols="35" name="txtCommentaire"><?php echo $sortie->commentaire;?></textarea><br><a style="font-size:9px;" href="javascript:agrandirCommentaire()">Agrandir</a></td></tr>
<tr><th align="left">Ressources&nbsp;&nbsp;&nbsp;</th><td><textarea id="idRessources" rows="2" cols="35" name="txtRessources"><?php echo $sortie->ressources;?></textarea><br><a style="font-size:9px;" href="javascript:agrandirRessources()">Agrandir</a></td></tr>
</table>

<br><br><br>
<table class="tableCommune">
<tr><th>Nom</th><?php if ($bUtiliseBeneficiaire) echo "<th>Bénéficiaire</th>";?><th>Prix unit.<br>(TTC)</th><th>Quantité</th><th>Supprimer</th></tr>
<?php
	foreach ($sortie->tLigneSortie as $ligneSortie) {
		$article=$ligneSortie->article;
		$nom=$article->nom;
		$quantite=afficherEntierSansDec($ligneSortie->quantite);
		$prixTTCSortie=$ligneSortie->prixTTCSortie;
		$beneficiaire=$ligneSortie->beneficiaire;
		$idArticle = $article->idArticle;
		echo "<tr>";
		echo "<td>$nom</td>";
		if ($bUtiliseBeneficiaire) echo "<td><input type='text' size='25' name='BENEF_$idArticle' value='$beneficiaire'></td>";
		echo "<td><input type='text' size='7' name='PRIX_$idArticle' value='$prixTTCSortie'></td>";
		echo "<td><input type='text' size='5' name='QUANTITE_$idArticle' value='$quantite'></td>";
		echo "<td align=\"center\"><input type='checkbox' name='chkDel_$idArticle'></td>";
		echo "</tr>";
	}
?>
</table>

<br>
<a href="javascript:montrerTableAjouterArticle()">Ajouter des articles</a><br>
<br>
<table id="tableAjouterArticle" class="tableCommune" style="display:none">
<tr><th>Nom</th><?php if ($bUtiliseBeneficiaire) echo "<th>Bénéficiaire</th>";?><th>Prix<br>(TTC)</th><th>Stock<br>réel</th><th>Stock<br>virtuel</th><th>Quantité</th></tr>
<?php
	chargerStock(); // impose de rechargement du stock
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		if (!$sortie->contientArticle($article)) {
			echo "<tr>";
			echo "<td>$article->nom</td>";
			if ($bUtiliseBeneficiaire) echo "<td><input type='text' size='25' name='BENEF_AJOUT_$idArticle' value=''></td>";
			echo "<td><input type='text' size='7' name='PRIX_AJOUT_$idArticle' value='$article->prixTTCCourant'></td>";
			echo "<td>$ligneStock->quantiteReelle</td>";
			echo "<td>$ligneStock->quantiteVirtuelle</td>";
			echo "<td><input size='5' name=\"QTE_AJOUT_$idArticle\" type='text'></td>";
			echo "</tr>";
		}
	}
?>
</table>
<br><br>
<button type="submit" class="boutonValider">Valider</button>
&nbsp;&nbsp;&nbsp;
<button type="button" class="boutonAnnuler" onclick="javascript:window.location='consulterSortie.php?id=<?php echo $idSortie;?>'">Annuler</button>
</form>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>