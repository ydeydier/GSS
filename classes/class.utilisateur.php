<?php
require_once "../classes/class.ldap.php";
class utilisateur {
	var $idUtilisateur;
	var $login;
	var $password;
	var $nom;
	var $prenom;
	var $administrateur;	// 'O' ou 'N'
	var $tStocks;			// Tableau des idStock auquel l'utilisateur est autorisé d'accéder
	var $idStockDefaut;
	
	static function verifierLoginPassword($loginSaisi, $passwordSaisi, $bAuthLDAP, $tConnexionLDAP) {
		$utilisateur=self::charger($loginSaisi);
		if ($utilisateur!=FALSE) {
			if ($bAuthLDAP) {
				$bAuth=$utilisateur->verifierLoginPasswordLDAP($passwordSaisi, $tConnexionLDAP);
				if (!$bAuth) {
					if ($utilisateur->estAdministrateur()) {
						$bAuth=$utilisateur->verifierLoginPasswordBase($passwordSaisi);	// TODO: tester
					}
				}
			} else {
				$bAuth=$utilisateur->verifierLoginPasswordBase($passwordSaisi);
			}
			if (!$bAuth) $utilisateur=FALSE;
		}
		return $utilisateur;
	}

	static function charger($login) {
		$login=strtolower(trim($login));
		$result = executeSqlSelect("SELECT * FROM utilisateur where lower(trim(login))='$login'");
		$row = mysqli_fetch_array($result);
		if ($row) {
			$utilisateur = new utilisateur();
			$utilisateur->idUtilisateur=$row['idUtilisateur'];
			$utilisateur->login=$row['login'];
			$utilisateur->password=$row['password'];
			$utilisateur->nom=$row['nom'];
			$utilisateur->prenom=$row['prenom'];
			$utilisateur->administrateur=$row['administrateur'];
			return $utilisateur;
		} else {
			$utilisateur=false;
		}
	}
	
	function verifierLoginPasswordBase($passwordSaisi) {
		return strtolower(trim($passwordSaisi))==strtolower(trim($this->password));
	}

	function verifierLoginPasswordLDAP($passwordSaisi, $tConnexionLDAP) {
		return ldap::verifierLoginPassword($this->login, $passwordSaisi, $tConnexionLDAP);
	}

	function chargerStocksAutorise() {
		$result = executeSqlSelect("SELECT idStock, defaut FROM stock_autorise where idUtilisateur=$this->idUtilisateur");
		$this->tStocks=array();
		while($row = mysqli_fetch_array($result)) {
			$idStock=$row['idStock'];
			$this->tStocks[]=$idStock;
			if ($row['defaut']=="O") {
				$this->idStockDefaut=$idStock;
			}
		}
	}

	function estAdministrateur() {
		return ($this->administrateur=="O");
	}
}
?>