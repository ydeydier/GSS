<?php
	require "inc_commun.php";
	
	// Update
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$ligneStock->quantiteReelle=$_POST["QUANTITEREELLE_$idArticle"];
		$ligneStock->update();
		$article->nom=$_POST["NOM_$idArticle"];
		$article->prix=$_POST["PRIX_$idArticle"];
		$article->update();
	}
		
	// Insert TODO
	foreach($_POST as $index=>$valeur) {
		if (substr($index, 0, 11)=="INSERT_NOM_") {			// Ex: INSERT_NOM_3
			$idLigne=substr($index, 11);					// Ex: 3
			$nom=$_POST["INSERT_NOM_$idLigne"];
			$prix=$_POST["INSERT_PRIX_$idLigne"];
			$quantiteReelle=$_POST["INSERT_QUANTITEREELLE_$idLigne"];
			if (trim($nom)!="") {
				if (!is_numeric($quantiteReelle)) {
					$quantiteReelle=0;
				} else {
					$quantiteReelle=intval($quantiteReelle);
				}
				if (!is_numeric($prix)) {
					$prix=null;
				}
				// Insertion de l'article en base (qui a pour effet de lui attribuer un idArticle, utile pour l'insertion de la ligneStock)
				$article = new article();
				$article->stock=$stock;
				$article->nom=$nom;
				$article->prix=$prix;
				$article->insert();
				// Insertion de la ligneStock en base
				$ligneStock = new ligneStock();
				$ligneStock->stock=$stock;
				$ligneStock->article=$article;
				$ligneStock->quantiteReelle=$quantiteReelle;
				$ligneStock->insert();
			}
		}
	}
	header('Location: visualiserStock.php');
?>