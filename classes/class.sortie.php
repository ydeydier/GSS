<?php
class sortie {
	var $idSortie;
	var $stock;
	var $nom;
	var $coutTotal;
	var $nbreArticles;
	var $etat;					// "VIRTUELLE" ou "REELLE"
	var $tLigneSortie;			// Tableau de 'ligneSortie'
	
	static $VIRTUELLE="VIRTUELLE";
	static $REELLE="REELLE";
	
	function __construct() {
		$tLigneSortie=array();
	}

	static function chargerPourStockSansLigne($stock) {
		$idStock=$stock->idStock;
		$result = executeSqlSelect("SELECT * FROM sortie where idStock=".$idStock);
		$sorties = array();
		while($row = mysqli_fetch_array($result)) {
			$sortie = self::instanceDepuisSqlRow($row, $stock);
			$sorties[$sortie->idSortie]=$sortie;
		}
		return $sorties;
	}

	static function instanceDepuisSqlRow($row, $stock) {
		$sortie = new sortie();
		$sortie->idSortie=$row['idSortie'];
		$sortie->stock=$stock;
		$sortie->nom=$row['nom'];
		$sortie->coutTotal=$row['coutTotal'];
		$sortie->nbreArticles=$row['nbreArticles'];
		$sortie->etat=$row['etat'];
		return $sortie;
	}

	static function charger($idSortie, $stock) {
		// Chargement des données principales
		$result = executeSqlSelect("SELECT * FROM sortie where idSortie=".$idSortie);
		$row = mysqli_fetch_array($result);
		$sortie = self::instanceDepuisSqlRow($row, $stock);
		// Chargement des lignes
		$result = executeSqlSelect("SELECT * FROM ligneSortie, article where ligneSortie.idArticle=article.idArticle and idSortie=".$idSortie);
		$sortie->tLigneSortie = array();
		while($row = mysqli_fetch_array($result)) {
			$ligneSortie = ligneSortie::instanceDepuisSqlRow($row, $sortie, $stock);
			$sortie->tLigneSortie[]=$ligneSortie;
		}
		// Return
		return $sortie;
	}

	function contientArticle($article) {
		$contientArticle=false;
		foreach ($this->tLigneSortie as $ligneSortie) {
			if ($ligneSortie->article->idArticle==$article->idArticle) {
				$contientArticle=true;
				break;
			}
		}
		return $contientArticle;
	}

	function update() {
		$this->calculeCoutTotal();
		$this->calculeNbreArticles();
		$sql="update sortie set nom='$this->nom', coutTotal=$this->coutTotal, nbreArticles=$this->nbreArticles, etat='$this->etat' where idSortie=$this->idSortie";
		executeSql($sql);
	}
	
	function insert() {
		$idStock=$this->stock->idStock;
		$this->calculeCoutTotal();
		$this->calculeNbreArticles();
		$sql="insert into sortie (idStock, nom, coutTotal, nbreArticles, etat) values ($idStock, '$this->nom', $this->coutTotal, $this->nbreArticles, '$this->etat')";
		executeSql($sql);
		$this->idSortie=dernierIdAttribue();
		// Insertion des ligneSortie
		foreach ($this->tLigneSortie as $ligneSortie) {
			$ligneSortie->insert();
		}
	}
	
	function calculeCoutTotal() {
		$this->coutTotal=0;
		foreach ($this->tLigneSortie as $ligneSortie) {
			$this->coutTotal = $this->coutTotal + $ligneSortie->prixSortie * $ligneSortie->quantite;
		}
	}

	function calculeNbreArticles() {
		$this->nbreArticles=sizeof($this->tLigneSortie);
	}

	/*
	function rendreReelle($stock) {
		// TODO : finir
		foreach ($this->tLigneSortie as $articleEvenement) {
			
		}
	}
	
	function rendreVirtuelle($stock) {
		// TODO : finir
	}
	// TODO : supprimer une sortie (corbeille)
	// TODO : voir la corbeille
*/
}
?>