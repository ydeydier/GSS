<?php
	require "inc_commun.php";
	$nomStock=$_POST["txtNomStock"];
	$stock=new stock();
	$stock->nom=$nomStock;
	$stock->insert();
	// Redirection
	header('Location: gererStocks.php');
?>