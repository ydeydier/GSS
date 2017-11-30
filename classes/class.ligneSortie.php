<?php
class ligneSortie {
	var $sortie;
	var $article;
	var $prixSortie;
	var $quantite;
	
	static function instanceDepuisSqlRow($row, $sortie, $stock) {
		// Chargement de l'article
		$article=article::instanceDepuisSqlRow($row, $stock);
		// Création et enrichissement de l'instance ligneSortie
		$ligneSortie = new ligneSortie();
		$ligneSortie->sortie=$sortie;
		$ligneSortie->article=$article;
		$ligneSortie->prixSortie=$row['prixSortie'];
		$ligneSortie->quantite=$row['quantite'];
		return $ligneSortie;
	}

	function update() {
		$idArticle=$this->article->idArticle;
		$idSortie=$this->sortie->idSortie;
		$prixSortie=nullSiVide($this->prixSortie);
		$quantite=$this->quantite;
		$sql="update ligneSortie set prixSortie=$prixSortie, quantite=$quantite where idArticle=$idArticle and idSortie=$idSortie";
		executeSql($sql);
	}
	function insert() {
		$idArticle=$this->article->idArticle;
		$idSortie=$this->sortie->idSortie;
		$prixSortie=nullSiVide($this->prixSortie);
		$quantite=$this->quantite;
		$sql="insert into ligneSortie (idArticle, idSortie, prixSortie, quantite) values ($idArticle, $idSortie, $prixSortie, $quantite)";
		executeSql($sql);
	}
}
?>