<?php
	require "inc_commun.php";
	$action=$_GET["action"];
	$idSortie=$_GET["idSortie"];
	$sortie = sortie::charger($idSortie, $stock);

	if ($action=="Restaurer") {
		$sortie->restaurer();
	}
	if ($action=="Supprimer") {
		$sortie->delete();
	}
	// Recalcule des quantités virtuelles dans le stock
	$stock->calculerQuantitesVirtuelles();
	// Force le rechargement du stock
	unset($_SESSION['stock']);
	// Redirection
	header('Location: consulterSortiesCorbeille.php');
?>