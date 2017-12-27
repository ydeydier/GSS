<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	require_once "../phpCommun/fonctionsSql.php";
	require_once "../classes/class.utilisateur.php";
	session_start();
	require_once "../phpCommun/connexion.php";
	
	$login=$_POST["txtLogin"];
	$passwordSaisi=$_POST["txtPassword"];
	$tConnexionLDAP = $tConfiguration["connexionLDAP"];
	$utilisateur=utilisateur::charger($login);
	$passwordRenseigne=(trim($utilisateur->password)!="");
	if ($utilisateur!=FALSE) {
		if ($passwordRenseigne) {
			// Si un mot de passe existe en base, vérifier si celui saisi est identique
			$bPassword=$utilisateur->verifierLoginPasswordBase($passwordSaisi);
		} else {
			// Sinon demander au LDAP
			$bPassword=$utilisateur->verifierLoginPasswordLDAP($passwordSaisi, $tConnexionLDAP);
		}
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
			setcookie('password', $passwordSaisi, time() + 5*365*24*3600, null, null, false, true);
		} else {
			if ($passwordRenseigne) {
				$erreur="passwordIncorrectBase"; // TODO: tester tout cela !
			} else {
				$erreur="passwordIncorrectLDAP";
			}
			$redirigeVers="../phpCommun/login.php?erreur=".$erreur;
		}
	} else {
		$redirigeVers="../phpCommun/login.php?erreur=loginIncorrect";
	}
	header("Location: $redirigeVers");
?>