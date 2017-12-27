<?php
	require "inc_commun.php";
	$action=$_GET["action"];
	if ($action=="Supprimer") {
		$idUtilisateur=$_GET["idUtilisateur"];
		utilisateur::delete($idUtilisateur);
	}
	// Redirection
	header('Location: gererUtilisateurs.php');
?>