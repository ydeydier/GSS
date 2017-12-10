<?php
class utilisateur {
	var $idUtilisateur;
	var $nom;
	var $prenom;
	var $tStocks;	// Tableau des idStock auquel l'utilisateur est autorisé d'accéder
	var $idStockDefaut;
	
	static function verifierLoginPasswordBase($login, $password) {
		$login=strtolower(trim($login));
		$password=strtolower(trim($password));
		$result = executeSqlSelect("SELECT * FROM utilisateur where lower(trim(login))='$login' and lower(trim(password))='$password'");
		$row = mysqli_fetch_array($result);
		if ($row) {
			$utilisateur = new utilisateur();
			$utilisateur->idUtilisateur=$row['idUtilisateur'];
			$utilisateur->nom=$row['nom'];
			$utilisateur->prenom=$row['prenom'];
			return $utilisateur;
		} else {
			$utilisateur=false;
		}
	}
	
	function chargerStocksAutorise() {
		$result = executeSqlSelect("SELECT * FROM stock_autorise where idUtilisateur=$this->idUtilisateur");
		$this->tStocks=array();
		while($row = mysqli_fetch_array($result)) {
			$idStock=$row['idStock'];
			$this->tStocks[]=$idStock;
			if ($row['defaut']=="O") {
				$this->idStockDefaut=$idStock;
			}
		}
	}
}
?>