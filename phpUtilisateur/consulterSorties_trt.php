<?php
	// TODO : factoriser avec consulterSortie_trt.php (sans le 's' à Sortie)
	require "inc_commun.php";
	$action=$_GET["action"];
	$idSortie=$_GET["idSortie"];
	$sortie = sortie::charger($idSortie, $stock);
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD

	if ($action=="RendreReelle") {
		$sortie->rendreReelle($stock);
	}
	if ($action=="RendreVirtuelle") {
		$sortie->rendreVirtuelle($stock);
	}
	if ($action=="Supprimer") {
		$sortie->supprimer();
	}
	// Recalcule des quantités virtuelles dans le stock
	chargerStock();		// Le stock a changé, il est nécessaire de le recharger
	$stock->calculerQuantitesVirtuelles();
	// Redirection
	header('Location: consulterSorties.php');
?>