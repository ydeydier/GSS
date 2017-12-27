<?php
	require "inc_commun.php";
	$action=$_GET["action"];
	if ($action=="Supprimer") {
		$idStock=$_GET["idStock"];
		stock::delete($idStock);
	}
	// Redirection
	header('Location: gererStocks.php');
?>