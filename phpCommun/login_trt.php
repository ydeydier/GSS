<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	require_once "../phpCommun/fonctionsSql.php";
	require_once "../classes/class.utilisateur.php";
	session_start();
	require_once "../phpCommun/connexion.php";
	
	$sLdap = $tConfiguration["authentification"]["ldap"];
	$bAuthLDAP = (trim(strtolower($sLdap))=="oui");
	
	$login=$_POST["txtLogin"];
	$password=$_POST["txtPassword"];
	$tConnexionLDAP = $tConfiguration["connexionLDAP"];
	$utilisateur=utilisateur::verifierLoginPassword($login, $password, $bAuthLDAP, $tConnexionLDAP);
	if ($utilisateur!=FALSE) {
		if ($utilisateur->estAdministrateur()) {
			$redirigeVers="../phpAdmin/pagePrincipaleAdmin.php";
			$_SESSION["estConnecte"]="OUI";
			$_SESSION["estAdministrateur"]="OUI";
			$_SESSION["utilisateur"]=$utilisateur;
		} else {
			$utilisateur->chargerStocksAutorise();
			$redirigeVers="../phpUtilisateur/pagePrincipale.php";
			$_SESSION["estConnecte"]="OUI";
			$_SESSION["idStock"]=$utilisateur->idStockDefaut;
			$_SESSION["utilisateur"]=$utilisateur;
		}
		setcookie('login', $login, time() + 5*365*24*3600, null, null, false, true);
		setcookie('password', $password, time() + 5*365*24*3600, null, null, false, true);
	} else {
		$redirigeVers="../phpCommun/login.php?loginIncorrect=oui";
	}
	header("Location: $redirigeVers");
?>