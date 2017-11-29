<?php
	require "inc_commun.php";
	$action=$_GET["action"];
	$idEvenement=$_GET["idEvenement"];
	$evenements = evenement::charger($idEvenement);
	$evenements->chargerArticles();
	$stock->chargerArticles();
	if ($action=="RendreReel") {
		$evenements->rendreReel($stock);
	}
	if ($action=="RendreVirtuel") {
		$evenements->rendreVirtuel($stock);
	}
	header('Location: visualiserEvenements.php');
?>