<?php
	require "inc_commun.php";
	$action=$_GET["action"];
	$idSortie=$_GET["idSortie"];
	$sortie = sortie::charger($idSortie, $stock);
	chargerStock();		// Force le rechargement du stock (stocké en session) pour s'assurer de travailler sur les dernières valeurs en BDD

	if ($action=="RendreReelle") {
		$sortie->rendreReelle($stock);
		chargerStock();		// Le stock a changé, il est nécessaire de le recharger
	}
	if ($action=="RendreVirtuelle") {
		$sortie->rendreVirtuelle($stock);
		chargerStock();		// Le stock a changé, il est nécessaire de le recharger
	}
	if ($action=="Supprimer") {
		$sortie->supprimer();
	}
	header("Location: consulterSortie.php?id=$idSortie");
?>