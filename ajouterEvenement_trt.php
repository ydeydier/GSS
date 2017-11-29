<?php
	require "inc_commun.php";
	$evenement = new evenement();
	$evenement->nom=$_POST["txtNomEvenement"];
	$evenement->idStock=$stock->idStock;
	foreach($_POST as $index=>$valeur) {
		if (substr($index, 0, 5)=="NBRE_") {				// Ex: NBRE_699
			$idArticleDeStock=substr($index, 5);			// Ex: 699
			$quantite=$valeur;
			if (trim($quantite)!="") {
				$articleEvenement = new articleEvenement();
				$articleDeStock=$stock->getArticle($idArticleDeStock);
				$articleEvenement->articleDeStock=$articleDeStock;
				$articleEvenement->evenement=$evenement;
				$articleEvenement->prix=$articleDeStock->prix;		// Le prix est copié depuis le stock, car il peut varier dans le stock. Il doit être associé à l'événement
				$articleEvenement->quantite=$quantite;
				$evenement->ajouteNouvelArticleEvenement($articleEvenement);
			}
		}
	}
	$evenement->insert();
	header('Location: visualiserEvenements.php');
?>