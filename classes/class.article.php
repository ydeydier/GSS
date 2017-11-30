<?php
class article {
	var $idArticle;
	var $stock;
	var $nom;
	var $prixCourant;
	
	static function instanceDepuisSqlRow($row, $stock) {
		$article = new article();
		$article->idArticle=$row['idArticle'];
		$article->stock=$stock;
		$article->nom=$row['nom'];
		$article->prixCourant=$row['prixCourant'];
		return $article;
	}
	function update() {
		$prixCourant=nullSiVide($this->prixCourant);
		$stock=$this->stock;
		$nom=mysqlEscape($this->nom);
		$sql="update article set nom='$nom', prixCourant=$prixCourant where idStock=$stock->idStock and idArticle=$this->idArticle";
		executeSql($sql);
	}
	function insert() {
		$idStock=$this->stock->idStock;
		$prixCourant=nullSiVide($this->prixCourant);
		$nom=mysqlEscape($this->nom);
		$sql="insert into article (idStock, nom, prixCourant) values ($idStock, '$nom', $prixCourant)";
		executeSql($sql);
		$this->idArticle=dernierIdAttribue();
	}
}
?>