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
		$sql="update ligneStock set quantiteReelle=$quantiteReelle, quantiteVirtuelle=$quantiteVirtuelle where idStock=$stock->idStock and idArticle=$article->idArticle";
		executeSql($sql);
	}
	function insert() {
		$idStock=$this->stock->idStock;
		$idArticle=$this->article->idArticle;
		$quantiteVirtuelle="null";
		$sql="insert into ligneStock (idStock, idArticle, quantiteReelle, quantiteVirtuelle) values ($idStock, $idArticle, $this->quantiteReelle, $quantiteVirtuelle)";
		executeSql($sql);
	}
}
?>