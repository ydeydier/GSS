<?php
	require "inc_commun.php";
	$sortie=$_SESSION["sortie"];
	$bUtiliseBeneficiaire=($stock->utiliseBeneficiaire=="O");
	
	// Modifications sur la sortie
	$sortie->nom=$_POST["txtNomSortie"];
	$sortie->date=$_POST["txtDate"];
	$sortie->commentaire=$_POST["txtCommentaire"];
	$sortie->ressources=$_POST["txtRessources"];
	
	// Modifications ou suppression de ligneSortie
	foreach ($sortie->tLigneSortie as $key => $ligneSortie) {
		$idArticle=$ligneSortie->article->idArticle;
		$bDelete=isset($_POST["chkDel_$idArticle"]);
		if ($bDelete) {
			$ligneSortie->delete();
			unset($sortie->tLigneSortie[$key]);
		} else {
			$quantite=$_POST["QUANTITE_$idArticle"];
			$quantite=str_replace(",", ".", $quantite);
			if (!is_numeric($quantite)) {
				$quantite=0;
			}
			$quantite=round($quantite, 2);
			$prixTTCSortie=$_POST["PRIX_$idArticle"];
			$prixTTCSortie=str_replace(",", ".", $prixTTCSortie);
			if (!is_numeric($prixTTCSortie)) {
				$prixTTCSortie=null;
			}
			if ($bUtiliseBeneficiaire) {
				$beneficiaire=$_POST["BENEF_$idArticle"];
			} else {
				$beneficiaire=null;
			}
			$ligneSortie->prixTTCSortie=$prixTTCSortie;
			$ligneSortie->quantite=$quantite;
			$ligneSortie->beneficiaire=$beneficiaire;
			$ligneSortie->update();
		}
	}
	
	// Ajout de ligneSortie, depuis le stock
	foreach ($stock->tLigneStock as $ligneStock) {
		$article=$ligneStock->article;
		$idArticle=$article->idArticle;
		if (!$sortie->contientArticle($article)) {
			$quantite=trim($_POST["QTE_AJOUT_$idArticle"]);
			$quantite=str_replace(",", ".", $quantite);
			if (trim($quantite)!="") {
				if (!is_numeric($quantite)) {
					$quantite=0;
				}
				$quantite=round($quantite, 2);
				$prixTTCSortie=$_POST["PRIX_AJOUT_$idArticle"];
				$prixTTCSortie=str_replace(",", ".", $prixTTCSortie);
				if (!is_numeric($prixTTCSortie)) {
					$prixTTCSortie=null;
				}
				if ($bUtiliseBeneficiaire) {
					$beneficiaire=$_POST["BENEF_AJOUT_$idArticle"];
				} else {
					$beneficiaire=null;
				}
				$ligneSortie = new ligneSortie();
				$ligneSortie->sortie=$sortie;
				$ligneSortie->article=$article;
				$ligneSortie->prixTTCSortie=$prixTTCSortie;
				$ligneSortie->quantite=$quantite;
				$ligneSortie->beneficiaire=$beneficiaire;
				$sortie->tLigneSortie[]=$ligneSortie;
				$ligneSortie->insert();
			}
		}
	}

	// Update en base de la sortie
	$sortie->update();
	
	// Recalcule des quantités virtuelles dans le stock
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD
	$stock->calculerQuantitesVirtuelles();
	// Suppression de la variable de session 'sortie'
	unset($_SESSION["sortie"]);
	// Redirection
	header("Location: consulterSortie.php?id=$sortie->idSortie");
?>