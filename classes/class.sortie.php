<?php
class sortie {
	var $idSortie;
	var $stock;
	var $nom;
	var $etat;					// "VIRTUEL" ou "REEL"
	var $tLigneSortie;			// Tableau de 'ligneSortie'
	
	static $VIRTUELLE="VIRTUELLE";
	static $REELLE="REELLE";
	
	function __construct() {
		$tLigneSortie=array();
		$this->etat=self::$VIRTUELLE;		// Une nouvelle sortie est toujours VIRTUELLE
	}

	//
	// Fonction uniquement utilisée en lecture : retourne tous les événement liés au stock $idStock
	//
	static function instanceDepuisSqlRow($stock) {
		$idStock=$stock->idStock;
		$result = executeSqlSelect("SELECT * FROM evenement where idStock=".$idStock);
		$evenements = array();
		while($row = mysqli_fetch_array($result)) {
			$evenement = self::lireSqlRow($row);
			$evenements[$evenement->idSortie]=$evenement;
		}
		return $evenements;
	}

	static function charger($idSortie) {
		$result = executeSqlSelect("SELECT * FROM evenement where idSortie=".$idSortie);
		$row = mysqli_fetch_array($result);
		$evenement = self::lireSqlRow($row);
		return $evenement;
	}

	function chargerArticles() {
		$result = executeSqlSelect("SELECT * FROM articleEvenement where idSortie=".$this->idSortie);
		$this->tLigneSortie = array();
		while($row = mysqli_fetch_array($result)) {
			$articleEvenement = articleEvenement::lireSqlRow($row, $this);
			$this->tLigneSortie[]=$articleEvenement;
		}
	}

	function getTotalPrix() {
		$totalPrix=0;
		foreach ($this->tLigneSortie as $articleEvenement) {
			$totalPrix = $totalPrix+ $articleEvenement->prix * $articleEvenement->quantite;
		}
		return $totalPrix;
	}
	
	function insert() {
		$sql="insert into evenement (idStock, nom, etat) values ($this->idStock, '$this->nom', '$this->etat')";
		executeSql($sql);
		$this->idSortie=dernierIdAttribue();
		foreach ($this->tLigneSortie as $articleEvenement) {
			$articleEvenement->insert();
		}
	}

	function update() {
		$sql="update evenement set nom='$this->nom', etat='$this->etat' where idSortie=$this->idSortie";
		executeSql($sql);
		foreach ($this->tLigneSortie as $articleEvenement) {
			if ($articleEvenement->typeUpdate=="U") {
				$articleEvenement->update();
			}
			if ($articleEvenement->typeUpdate=="I") {
				$articleEvenement->insert();
			}
		}
	}
	
	static function lireSqlRow($row) {
		$evenement = new evenement();
		$evenement->idSortie=$row['idSortie'];
		$evenement->idStock=$row['idStock'];
		$evenement->nom=$row['nom'];
		$evenement->etat=$row['etat'];
		return $evenement;
	}

	function ajouteNouvelArticleEvenement($articleEvenement) {
		$articleEvenement->typeUpdate="I";
		$this->tLigneSortie[]=$articleEvenement;
	}
	
	function contientArticle($idArticleDeStock) {
		$contientArticle=false;
		foreach ($this->tLigneSortie as $articleEvenement) {
			if ($articleEvenement->idArticleDeStock()==$idArticleDeStock) {
				$contientArticle=true;
				break;
			}
		}
		return $contientArticle;
	}
	
	function rendreReel($stock) {
		foreach ($this->tLigneSortie as $articleEvenement) {
			
		}
	}
	
	function rendreVirtuel($stock) {
		// TODO : finir
	}
	
	function coutTotal() {
		return "50 EUR";	// TODO : finir
	}
	function nbreArticles() {
		return 15;			// TODO : finir
	}
}
?>