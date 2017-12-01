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
	
	function retirerArticle($article, $quantite) {
		$ligneStock=$this->getLigneArticle($article);
		if ($ligneStock!=null) {
			echo $quantite;
			$ligneStock->quantiteReelle=$ligneStock->quantiteReelle-$quantite;
			$ligneStock->update();
		} else {
			// TODO : gérer !
		}
	}
	
	function ajouterArticle($article, $quantite) {
		$ligneStock=$this->getLigneArticle($article);
		if ($ligneStock!=null) {
			$ligneStock->quantiteReelle=$ligneStock->quantiteReelle+$quantite;
			$ligneStock->update();
		} else {
			// TODO : gérer !
		}
	}

	function getLigneArticle($article) {
		$ligne=null;
		foreach ($this->tLigneStock as $ligneStock) {
			if ($ligneStock->article->idArticle==$article->idArticle) {
				$ligne=$ligneStock;
				break;
			}
		}
		return $ligne;
	}
	
	function calculerQuantitesVirtuelles() {
		// TODO : A faire !
	}
}
?>