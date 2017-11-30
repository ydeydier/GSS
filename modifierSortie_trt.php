<?php
	require "inc_commun.php";
	$sortie=$_SESSION["sortie"];
	
	// Modifications sur la sortie
	$sortie->nom=$_POST["txtNomSortie"];
	
	// Modifications sur les ligneSortie
	foreach ($sortie->tLigneSortie as $ligneSortie) {
		$idArticle=$ligneSortie->article->idArticle;
		$quantite=$_POST["QUANTITE_$idArticle"];
		if (!is_numeric($quantite)) {
			$quantite=0;
		} else {
			$quantite=intval($quantite);
		}
		$prixSortie=$_POST["PRIX_$idArticle"];
		if (!is_numeric($prixSortie)) {
			$prixSortie=null;
		}
		$ligneSortie->prixSortie=$prixSortie;
		$ligneSortie->quantite=$quantite;
		$ligneSortie->update();
	}
	
	// Ajout de ligneSortie, depuis le stock
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		if (!$sortie->contientArticle($article)) {
			$quantite=trim($_POST["QTE_AJOUT_$idArticle"]);
			if (trim($quantite)!="") {
				if (!is_numeric($quantite)) {
					$quantite=0;
				} else {
					$quantite=intval($quantite);
				}
				$ligneSortie = new ligneSortie();
				$ligneSortie->sortie=$sortie;
				$ligneSortie->article=$article;
				$ligneSortie->prixSortie=$article->prixCourant;		// Le prix est copié depuis le stock, car il peut varier dans le stock. Il doit être associé à la sortie.
				$ligneSortie->quantite=$quantite;
				$sortie->tLigneSortie[]=$ligneSortie;
				$ligneSortie->insert();
			}
		}
	}

	// Update en base de la sortie
	$sortie->update();
	
	// Fin du traitement
	unset($_SESSION["sortie"]);
	header("Location: consulterSortie.php?id=$sortie->idSortie");
?>