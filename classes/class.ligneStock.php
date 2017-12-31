<?php
// OK
class ligneStock {
	var $stock;
	var $article;
	var $quantiteReelle;
	var $quantiteVirtuelle;
	
	static function instanceDepuisSqlRow($row, $stock) {
		$ligneStock = new ligneStock();
		$ligneStock->stock=$stock;
		$ligneStock->article=article::instanceDepuisSqlRow($row, $stock);
		$ligneStock->quantiteReelle=$row['quantiteReelle'];
		$ligneStock->quantiteVirtuelle=$row['quantiteVirtuelle'];
		return $ligneStock;
	}
	function update() {
		$quantiteReelle=nullSiVide($this->quantiteReelle);
		$quantiteVirtuelle=nullSiVide($this->quantiteVirtuelle);
		$stock=$this->stock;
		$article=$this->article;
		$sql="update ligne_stock set quantiteReelle=$quantiteReelle, quantiteVirtuelle=$quantiteVirtuelle where idStock=$stock->idStock and idArticle=$article->idArticle";
		executeSql($sql);
	}
	function delete() {
		$stock=$this->stock;
		$article=$this->article;
		$sql="delete from ligne_stock where idStock=$stock->idStock and idArticle=$article->idArticle";
		executeSql($sql);
		// Suppression de l'article correspondant, s'il n'est pas utilisé dans une sortie
		article::purge();
	}
	
	function insert() {
		$idStock=$this->stock->idStock;
		$idArticle=$this->article->idArticle;
		$quantiteVirtuelle="null";
		$sql="insert into ligne_stock (idStock, idArticle, quantiteReelle, quantiteVirtuelle) values ($idStock, $idArticle, $this->quantiteReelle, $quantiteVirtuelle)";
		executeSql($sql);
	}
}
?>