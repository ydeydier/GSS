<?php
// OK
class stock {
	var $idStock;
	var $nom;
	var $tLigneStock;	// tableau de ligneStock
	
	static function charger($idStock) {
		// Charger les données principales
		$result = executeSqlSelect("SELECT * FROM stock where idStock=".$idStock);
		$row = mysqli_fetch_array($result);
		$stock = new stock();
		$stock->idStock=$idStock;
		$stock->nom=$row['nom'];
		// Charger les lignes
		$result = executeSqlSelect("SELECT * FROM ligneStock, article where ligneStock.idArticle=article.idArticle AND ligneStock.idStock=".$idStock);
		$stock->tLigneStock = array();
		while($row = mysqli_fetch_array($result)) {
			$ligneStock = ligneStock::instanceDepuisSqlRow($row, $stock);
			$stock->tLigneStock[$ligneStock->article->idArticle]=$ligneStock;
		}
		return $stock;
	}
}
?>