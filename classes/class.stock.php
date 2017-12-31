<?php
// OK
class stock {
	var $idStock;
	var $nom;
	var $utiliseBeneficiaire;	// 'O' si la colonne "bénéficiaire" doit être utilisée sur les sorties. 'N' sinon.
	var $tLigneStock;			// tableau de ligneStock
	
	static function charger($idStock) {
		// Charger les données principales
		$result = executeSqlSelect("SELECT * FROM stock where idStock=".$idStock);
		$row = mysqli_fetch_array($result);
		$stock = new stock();
		$stock->idStock=$idStock;
		$stock->nom=$row['nom'];
		$stock->utiliseBeneficiaire=$row['utiliseBeneficiaire'];
		// Charger les lignes
		$result = executeSqlSelect("SELECT * FROM ligne_stock, article where ligne_stock.idArticle=article.idArticle AND ligne_stock.idStock=".$idStock);
		$stock->tLigneStock = array();
		while($row = mysqli_fetch_array($result)) {
			$ligneStock = ligneStock::instanceDepuisSqlRow($row, $stock);
			$stock->tLigneStock[$ligneStock->article->idArticle]=$ligneStock;
		}
		return $stock;
	}
	
	static function chargerToutSansLigne() {
		$stocks = array();
		// Charger les données principales
		$result = executeSqlSelect("SELECT * FROM stock");
		while($row = mysqli_fetch_array($result)) {
			$stock = new stock();
			$stock->idStock=$row['idStock'];
			$stock->nom=$row['nom'];
			$stock->utiliseBeneficiaire=$row['utiliseBeneficiaire'];
			$stocks[$stock->idStock]=$stock;
		}
		return $stocks;
	}

	function retirerArticle($article, $quantite) {
		$ligneStock=$this->getLigneArticle($article);
		if ($ligneStock!=null) {
			$ligneStock->quantiteReelle=$ligneStock->quantiteReelle-$quantite;
			$ligneStock->update();
		} else {
			rollback();
			die("Erreur dans class.stock.retirerArticle()");
		}
	}
	
	function ajouterArticle($article, $quantite) {
		$ligneStock=$this->getLigneArticle($article);
		if ($ligneStock!=null) {
			$ligneStock->quantiteReelle=$ligneStock->quantiteReelle+$quantite;
			$ligneStock->update();
		} else {
			rollback();
			die("Erreur dans class.stock.ajouterArticle() : impossible de ré-insérer '$article->nom' dans le stock, car cet article a été supprimé du stock. Cette sortie ne peut plus être rendue virtuelle.");
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
		// Initialisation des quantité virtuelle
		foreach ($this->tLigneStock as $ligneStock) {
			$ligneStock->quantiteVirtuelle=$ligneStock->quantiteReelle;
		}
		// Soustraction avec toutes les sorties virtuelles
		$tSortiesVirtuelles=sortie::chargerSortiesVirtuelles($this);
		foreach ($this->tLigneStock as $ligneStock) {
			$article=$ligneStock->article;
			foreach ($tSortiesVirtuelles as $sortieVirtuelle) {
				$qte = $sortieVirtuelle->quantiteArticle($article);
				$ligneStock->quantiteVirtuelle-=$qte;
			}
			$ligneStock->update();
		}
	}

	function update() {
		$nom=mysqlEscape($this->nom);
		$sql="update stock set nom='$nom', utiliseBeneficiaire='$this->utiliseBeneficiaire' where idStock=$this->idStock";
		executeSql($sql);
	}

	function insert() {
		$nom=mysqlEscape($this->nom);
		$sql="insert into stock (nom, utiliseBeneficiaire) value ('$nom', '$this->utiliseBeneficiaire')";
		executeSql($sql);
	}
	
	static function delete($idStock) {
		beginTransaction();
		$sql="delete from ligne_sortie where idSortie in (select idSortie from sortie where idStock=$idStock)";
		executeSql($sql);
		$sql="delete from sortie where idStock=$idStock";
		executeSql($sql);
		$sql="delete from ligne_stock where idStock=$idStock";
		executeSql($sql);
		$sql="delete from article where idStock=$idStock";
		executeSql($sql);
		$sql="delete from stock_autorise where idStock=$idStock";
		executeSql($sql);
		$sql="delete from stock where idStock=$idStock";
		executeSql($sql);
		commit();
	}
}
?>