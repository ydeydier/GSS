<?php
	require "inc_commun.php";
	$action=$_GET["action"];
	$idSortie=$_GET["idSortie"];
	$sortie = sortie::charger($idSortie, $stock);

	if ($action=="Restaurer") {
		$sortie->restaurer();
	}
	header('Location: consulterSortiesCorbeille.php');
?>