<?php
	require "inc_commun.php";
	$sortie = new sortie();
	$sortie->nom=$_POST["txtNomSortie"];
	$sortie->stock=$stock;
	$sortie->etat=sortie::$VIRTUELLE;

	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		$quantite=trim($_POST["QUANTITE_$idArticle"]);
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
		}
	}
	// Insertion de la sortie et de ses ligneSortie
	$sortie->insert();	// insertion en base (ce qui provoque la récupération de son $idSortie)
	// Recalcule des quantités virtuelles dans le stock
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
	$stock->calculerQuantitesVirtuelles();
	// Redirection
	header("Location: consulterSortie.php?id=$sortie->idSortie");
?>