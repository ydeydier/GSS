<?php
class ligneSortie {
	var $sortie;
	var $article;
	var $prixSortie;
	var $quantite;
	var $beneficiaire;
	
	static function instanceDepuisSqlRow($row, $sortie, $stock) {
		// Chargement de l'article
		$article=article::instanceDepuisSqlRow($row, $stock);
		// Création et enrichissement de l'instance ligneSortie
		$ligneSortie = new ligneSortie();
		$ligneSortie->sortie=$sortie;
		$ligneSortie->article=$article;
		$ligneSortie->prixSortie=$row['prixSortie'];
		$ligneSortie->quantite=$row['quantite'];
		$ligneSortie->beneficiaire=$row['beneficiaire'];
		return $ligneSortie;
	}

	function update() {
		$idArticle=$this->article->idArticle;
		$idSortie=$this->sortie->idSortie;
		$prixSortie=nullSiVide($this->prixSortie);
		$quantite=$this->quantite;
		$beneficiaire=nullSiVideStr(mysqlEscape($this->beneficiaire));
		$sql="update ligne_sortie set prixSortie=$prixSortie, quantite=$quantite, beneficiaire=$beneficiaire where idArticle=$idArticle and idSortie=$idSortie";
		executeSql($sql);
	}
	
	function delete() {
		$idArticle=$this->article->idArticle;
		$idSortie=$this->sortie->idSortie;
		$sql="delete from ligne_sortie where idArticle=$idArticle and idSortie=$idSortie";
		executeSql($sql);
		// Suppression de l'article correspondant, s'il n'est pas utilisé dans une sortie
		article::purge();
	}

	function insert() {
		$idArticle=$this->article->idArticle;
		$idSortie=$this->sortie->idSortie;
		$prixSortie=nullSiVide($this->prixSortie);
		$quantite=$this->quantite;
		$beneficiaire=nullSiVideStr(mysqlEscape($this->beneficiaire));
		$sql="insert into ligne_sortie (idArticle, idSortie, prixSortie, quantite, beneficiaire) values ($idArticle, $idSortie, $prixSortie, $quantite, $beneficiaire)";
		executeSql($sql);
	}
}
?>