<?php
	require "inc_commun.php";
	$evenement=$_SESSION["evenement"];
	$evenement->nom=$_POST["txtNomEvenement"];
	
	// Modifications
	foreach ($evenement->articlesEvenement as $articleEvenement) {
		$idArticleDeStock = $articleEvenement->idArticleDeStock();
		$articleEvenement->prix=$_POST["PRIX_$idArticleDeStock"];
		$articleEvenement->quantite=$_POST["QUANTITE_$idArticleDeStock"];
	}
	
	// Ajout, depuis le stock
	foreach ($stock->articleDeStocks as $articleDeStock) {
		$idArticleDeStock=$articleDeStock->idArticleDeStock;
		if (!$evenement->contientArticle($idArticleDeStock)) {
			$quantite=trim($_POST["QTE_AJOUT_$idArticleDeStock"]);
			if ($quantite!="") {
				$articleEvenement = new articleEvenement();
				$articleEvenement->articleDeStock=$articleDeStock;
				$articleEvenement->evenement=$evenement;
				$articleEvenement->prix=$articleDeStock->prix;		// Le prix est copié depuis le stock, car il peut varier dans le stock. Il doit être associé à l'événement
				$articleEvenement->quantite=$quantite;
				$evenement->ajouteNouvelArticleEvenement($articleEvenement);
			}
		}
	}
	$evenement->update();
	unset($_SESSION["evenement"]);
	header("Location: visualiserEvenement.php?id=$evenement->idEvenement");
?>