<?php
	require "inc_commun.php";
	$action=$_GET["action"];
	$idSortie=$_GET["idSortie"];
	$sorties = sortie::charger($idSortie);
	$sorties->chargerArticles();
	$stock->chargerArticles();
	if ($action=="RendreReelle") {
		$sorties->rendreReelle($stock);
	}
	if ($action=="RendreVirtuel") {
		$sorties->rendreVirtuelle($stock);
	}
	header('Location: consulterSorties.php');
?>