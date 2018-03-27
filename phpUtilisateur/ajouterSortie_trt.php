<?php
	require "inc_commun.php";
	$sortie = new sortie();
	$sortie->nom=$_POST["txtNomSortie"];
	$sortie->date=$_POST["txtDate"];
	$sortie->commentaire=$_POST["txtCommentaire"];
	$sortie->ressources=$_POST["txtRessources"];
	$sortie->stock=$stock;
	$sortie->etat=sortie::$VIRTUELLE;
	$bUtiliseBeneficiaire=($stock->utiliseBeneficiaire=="O");

	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		if ($bUtiliseBeneficiaire) {
			$beneficiaire=$_POST["BENEF_$idArticle"];
		} else {
			$beneficiaire=null;
		}
		$quantite=trim($_POST["QUANTITE_$idArticle"]);
		if (trim($quantite)!="") {
			if (!is_numeric($quantite)) {
				$quantite=0;
			}
			$quantite=round($quantite, 2);
			$prixTTCSortie=$_POST["PRIX_$idArticle"];
			$prixTTCSortie=str_replace(",", ".", $prixTTCSortie);
			if (!is_numeric($prixTTCSortie)) {
				$prixTTCSortie=null;
			}
			$ligneSortie = new ligneSortie();
			$ligneSortie->sortie=$sortie;
			$ligneSortie->article=$article;
			$ligneSortie->prixTTCSortie=$prixTTCSortie;
			$ligneSortie->quantite=$quantite;
			$ligneSortie->beneficiaire=$beneficiaire;
			$sortie->tLigneSortie[]=$ligneSortie;
		}
	}
	// Insertion de la sortie et de ses ligneSortie
	$sortie->insert();	// insertion en base (ce qui provoque la récupération de son $idSortie)
	// Recalcule des quantités virtuelles dans le stock
	$stock->calculerQuantitesVirtuelles();
	// Force le rechargement du stock
	unset($_SESSION['stock']);
	// Redirection
	header("Location: consulterSortie.php?id=$sortie->idSortie");
?>