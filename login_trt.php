<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	require_once "fonctionsSql.php";
	require_once "classes/class.utilisateur.php";
	session_start();
	require_once "connexion.php";

	$login=$_POST["txtLogin"];
	$password=$_POST["txtPassword"];
	$utilisateur=utilisateur::verifierLoginPasswordBase($login, $password);
	if ($utilisateur!=FALSE) {
		$utilisateur->chargerStocksAutorise();
		echo "<pre>";print_r($utilisateur);echo "</pre>";
		$redirigeVers="pagePrincipale.php";
		$_SESSION["estConnecte"]="OUI";
		$_SESSION["idStock"]=$utilisateur->idStockDefaut;
		$_SESSION["utilisateur"]=$utilisateur;
		setcookie('login', $login, time() + 5*365*24*3600, null, null, false, true);
		setcookie('password', $password, time() + 5*365*24*3600, null, null, false, true);
	} else {
		$redirigeVers="login.php?loginIncorrect=oui";
	}
	header("Location: $redirigeVers");
?>