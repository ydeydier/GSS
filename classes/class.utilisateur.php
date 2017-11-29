<?php
class utilisateur
{
	var $idUtilisateur;
	var $nom;
	var $prenom;
	var $stocks;	// Tableau des idStock auquel l'utilisateur est autorisé d'accéder
	
	static function charger($idUtilisateur) {
		$result = executeSqlSelect("SELECT * FROM utilisateur where idUtilisateur=".$idUtilisateur);
		$row = mysqli_fetch_array($result);
		$utilisateur = new utilisateur();
		$utilisateur->idUtilisateur=$row['idUtilisateur'];
		$utilisateur->nom=$row['nom'];
		$utilisateur->prenom=$row['prenom'];
		$strStocks=$row['stocks'];
		$utilisateur->stocks=explode( "," , $strStocks);
		return $utilisateur;
	}
}
?>