<?php
class article {
	var $idArticle;
	var $stock;
	var $nom;
	var $prixTTCCourant;
	var $tauxTVA;
	
	static function instanceDepuisSqlRow($row, $stock) {
		$article = new article();
		$article->idArticle=$row['idArticle'];
		$article->stock=$stock;
		$article->nom=$row['nom'];
		$article->prixTTCCourant=$row['prixTTCCourant'];
		$article->tauxTVA=$row['tauxTVA'];
		return $article;
	}
	function update() {
		$prixTTCCourant=nullSiVide($this->prixTTCCourant);
		$tauxTVA=nullSiVide($this->tauxTVA);
		$stock=$this->stock;
		$nom=mysqlEscape($this->nom);
		$sql="update article set nom='$nom', prixTTCCourant=$prixTTCCourant, tauxTVA=$tauxTVA where idStock=$stock->idStock and idArticle=$this->idArticle";
		executeSql($sql);
	}
	function insert() {
		$idStock=$this->stock->idStock;
		$prixTTCCourant=nullSiVide($this->prixTTCCourant);
		$tauxTVA=nullSiVide($this->tauxTVA);
		$nom=mysqlEscape($this->nom);
		$sql="insert into article (idStock, nom, prixTTCCourant, tauxTVA) values ($idStock, '$nom', $prixTTCCourant, $tauxTVA)";
		executeSql($sql);
		$this->idArticle=dernierIdAttribue();
	}
	static function purge() {
		$sql="delete from article where not exists (select 1 from ligne_sortie where ligne_sortie.idArticle=article.idArticle) and not exists (select 1 from ligne_stock where ligne_stock.idArticle=article.idArticle)";
		executeSql($sql);
	}
}
?>