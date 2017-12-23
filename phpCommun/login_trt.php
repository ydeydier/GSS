<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	require_once "../phpCommun/fonctionsSql.php";
	require_once "../classes/class.utilisateur.php";
	session_start();
	require_once "../phpCommun/connexion.php";
	
	$login=$_POST["txtLogin"];
	$password=$_POST["txtPassword"];
	$tConnexionLDAP = $tConfiguration["connexionLDAP"];
	$utilisateur=utilisateur::charger($login);
	if ($utilisateur!=FALSE) {
		$bPassword=$utilisateur->verifierPassword($password, $tConnexionLDAP);
		if ($bPassword!=FALSE) {
			if ($utilisateur->estAdministrateur()) {
				$redirigeVers="../phpAdmin/pagePrincipaleAdmin.php";
				$_SESSION["estConnecte"]="OUI";
				$_SESSION["estAdministrateur"]="OUI";
				$_SESSION["utilisateur"]=$utilisateur;
			} else {
				if ($utilisateur->idStockDefaut!=null) {
					$redirigeVers="../phpUtilisateur/pagePrincipale.php";
					$_SESSION["estConnecte"]="OUI";
					$_SESSION["idStock"]=$utilisateur->idStockDefaut;
					$_SESSION["utilisateur"]=$utilisateur;
				} else {
					$redirigeVers="../phpCommun/login.php?erreur=aucunStockAutorise";
				}
			}
			setcookie('login', $login, time() + 5*365*24*3600, null, null, false, true);
			setcookie('password', $password, time() + 5*365*24*3600, null, null, false, true);
		} else {
			$redirigeVers="../phpCommun/login.php?erreur=passwordIncorrect";
		}
	} else {
		$redirigeVers="../phpCommun/login.php?erreur=loginIncorrect";
	}
	header("Location: $redirigeVers");
?>