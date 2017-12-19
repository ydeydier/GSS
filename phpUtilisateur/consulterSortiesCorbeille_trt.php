<?php
	require "inc_commun.php";
	$action=$_GET["action"];
	$idSortie=$_GET["idSortie"];
	$sortie = sortie::charger($idSortie, $stock);

	if ($action=="Restaurer") {
		$sortie->restaurer();
	}
	// Recalcule des quantités virtuelles dans le stock
	chargerStock();		// Le stock a changé, il est nécessaire de le recharger
	$stock->calculerQuantitesVirtuelles();
	// Redirection
	header('Location: consulterSortiesCorbeille.php');
?>