<?php
	require "inc_commun.php";
	$nomStock=$_POST["txtNomStock"];
	$selDestinataire=$_POST["selDestinataire"];
	$stock=$_SESSION["stock"];
	$stock->nom=$nomStock;
	$stock->utiliseBeneficiaire=$selDestinataire;
	$stock->update();
	// Redirection
	header('Location: gererStocks.php');
?>