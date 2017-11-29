<?php
class ligneSortie
{
	var $articleDeStock;
	var $sortie;
	var $prix;
	var $quantite;
	var $typeUpdate;			// variable technique : "U" ou "I" : type d'update : UPDATE ou INSERT
	
	static function lireSqlRow($row, $sortie) {
		$ligneSortie = new ligneSortie();
		$idArticleDeStock=$row['idArticleDeStock'];
		$ligneSortie->articleDeStock=articleDeStock::charger($idArticleDeStock); // TODO : optimiser...
		$ligneSortie->sortie=$sortie;
		$ligneSortie->prix=$row['prix'];
		$ligneSortie->quantite=$row['quantite'];
		$ligneSortie->typeUpdate="U";
		return $ligneSortie;
	}

	function insert() {
		$idArticleDeStock=$this->articleDeStock->idArticleDeStock;
		$idEvenement=$this->sortie->idEvenement;
		$prix=nullSiVide($this->prix);
		$quantite=nullSiVide($this->quantite);
		$sql="insert into ligneSortie (idArticleDeStock, idEvenement, prix, quantite) values ($idArticleDeStock, $idEvenement, $prix, $quantite)";
		executeSql($sql);
		$ligneSortie->typeUpdate="U";
	}
	
	function update() {
		$idArticleDeStock=$this->articleDeStock->idArticleDeStock;
		$idEvenement=$this->sortie->idEvenement;
		$prix=nullSiVide($this->prix);
		$quantite=nullSiVide($this->quantite);
		$sql="update ligneSortie set prix=$prix, quantite=$quantite where idArticleDeStock=$idArticleDeStock and idEvenement=$idEvenement";
		executeSql($sql);
	}

	function nom() {
		return $this->articleDeStock->nom;
	}
	function idArticleDeStock() {
		return $this->articleDeStock->idArticleDeStock;
	}
}
?>