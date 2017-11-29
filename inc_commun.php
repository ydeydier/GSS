<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	//error_reporting(E_ALL ^ E_DEPRECATED);
	require_once "connexion.php";
	require_once "classes/class.stock.php";
	require_once "classes/class.article.php";
	require_once "classes/class.ligneStock.php";
	require_once "classes/class.ligneSortie.php";
	require_once "classes/class.sortie.php";
	require_once "classes/class.utilisateur.php";
	session_start();

	if (!isset($_SESSION["idStock"])) {
		$_SESSION["idStock"]=1;
	}
	$idStock=$_SESSION["idStock"];

	if (!isset($_SESSION['stock'])) {
		chargerStock();
	}
	$stock=$_SESSION["stock"];
	
	if (!isset($_SESSION['utilisateur'])) {
		$_SESSION["utilisateur"]=Utilisateur::charger(1);
	}
	$utilisateur=$_SESSION["utilisateur"];
	
	function chargerStock() {
		global $stock;
		$_SESSION["stock"]=Stock::charger($_SESSION["idStock"]);
		$stock=$_SESSION["stock"];
	}
?>