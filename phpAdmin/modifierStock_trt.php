<?php
	require "inc_commun.php";
	$nomStock=$_POST["txtNomStock"];
	$stock=$_SESSION["stock"];
	$stock->nom=$nomStock;
	$stock->update();
	// Redirection
	header('Location: gererStocks.php');
?>