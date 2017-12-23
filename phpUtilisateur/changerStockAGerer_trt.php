<?php
	require "inc_commun.php";
	$idStockDefaut=$_POST["rdoStock"];
	
	$bStockDefaut=isset($_POST["chkStockDefaut"]);
	if($bStockDefaut) {
		$utilisateur->idStockDefaut=$idStockDefaut;
		$utilisateur->update();
	}
	
	$_SESSION["idStock"]=$idStockDefaut;
	unset($_SESSION['stock']);
	header('Location: pagePrincipale.php');
?>