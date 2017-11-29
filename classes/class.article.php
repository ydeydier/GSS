<?php
class article {
	var $idArticle;
	var $stock;
	var $nom;
	var $prix;
	
	static function instanceDepuisSqlRow($row, $stock) {
		$article = new article();
		$article->idArticle=$row['idArticle'];
		$article->stock=$stock;
		$article->nom=$row['nom'];
		$article->prix=$row['prix'];
		return $article;
	}
	function update() {
		$prix=nullSiVide($this->prix);
		$stock=$this->stock;
		$nom=mysqlEscape($this->nom);
		$sql="update article set nom='$nom', prix=$prix where idStock=$stock->idStock and idArticle=$this->idArticle";
		executeSql($sql);
	}

	function insert() {
		$idStock=$this->stock->idStock;
		$prix=nullSiVide($this->prix);
		$nom=mysqlEscape($this->nom);
		$sql="insert into article (idStock, nom, prix) values ($idStock, '$nom', $prix)";
		executeSql($sql);
		$this->idArticle=dernierIdAttribue();
	}
}
?>