<?php
	require "inc_commun.php";
	$rdoStock=$_POST["rdoStock"];
	$_SESSION["idStock"]=$rdoStock;
	unset($_SESSION['stock']);
	header('Location: pagePrincipale.php');
?>