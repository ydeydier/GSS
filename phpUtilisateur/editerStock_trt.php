<?php
	require "inc_commun.php";
	
	// Modifications ou suppression de ligneStock
	foreach ($stock->tLigneStock as $key => $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$bDelete=isset($_POST["CHKDEL_$idArticle"]);
		if ($bDelete) {
			$ligneStock->delete();
			unset($stock->tLigneStock[$key]);
		} else {
			$quantiteReelle=$_POST["QUANTITEREELLE_$idArticle"];
			$quantiteReelle=str_replace(",", ".", $quantiteReelle);
			if (!is_numeric($quantiteReelle)) {
				$quantiteReelle=0;
			}
			$prixCourant=$_POST["PRIX_$idArticle"];
			$prixCourant=str_replace(",", ".", $prixCourant);
			if (!is_numeric($prixCourant)) {
				$prixCourant=null;
			}
			$ligneStock->quantiteReelle=$quantiteReelle;
			$ligneStock->update();
			$article->nom=$_POST["NOM_$idArticle"];
			$article->prixCourant=$prixCourant;
			$article->update();
		}
	}
		
	// Insert
	foreach($_POST as $index=>$valeur) {
		if (substr($index, 0, 11)=="INSERT_NOM_") {			// Ex: INSERT_NOM_3
			$idLigne=substr($index, 11);					// Ex: 3
			$nom=$_POST["INSERT_NOM_$idLigne"];
			if (trim($nom)!="") {
				$quantiteReelle=$_POST["INSERT_QUANTITEREELLE_$idLigne"];
				$quantiteReelle=str_replace(",", ".", $quantiteReelle);
				if (!is_numeric($quantiteReelle)) {
					$quantiteReelle=0;
				}
				$prixCourant=$_POST["INSERT_PRIX_$idLigne"];
				$prixCourant=str_replace(",", ".", $prixCourant);
				if (!is_numeric($prixCourant)) {
					$prixCourant=null;
				}
				// Insertion de l'article en base (qui a pour effet de lui attribuer un idArticle, utile pour l'insertion de la ligneStock)
				$article = new article();
				$article->stock=$stock;
				$article->nom=$nom;
				$article->prixCourant=$prixCourant;
				$article->insert();
				// Insertion de la ligneStock en base
				$ligneStock = new ligneStock();
				$ligneStock->stock=$stock;
				$ligneStock->article=$article;
				$ligneStock->quantiteReelle=$quantiteReelle;
				$ligneStock->insert();
				$stock->tLigneStock[$article->idArticle]=$ligneStock;
			}
		}
	}
	// Recalcule des quantités virtuelles dans le stock
	$stock->calculerQuantitesVirtuelles();
	// Force le rechargement du stock
	unset($_SESSION['stock']);
	// Redirection
	header('Location: visualiserStock.php');
?>