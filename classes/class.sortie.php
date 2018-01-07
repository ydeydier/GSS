<?php
class sortie {
	var $idSortie;
	var $stock;
	var $nom;
	var $date;
	var $commentaire;
	var $coutTotal;
	var $nbreArticles;
	var $etat;					// "VIRTUELLE" ou "REELLE"
	var $corbeille;				// 'O' ou 'N'
	var $tLigneSortie;			// Tableau de 'ligneSortie'
	
	static $VIRTUELLE="VIRTUELLE";
	static $REELLE="REELLE";
	
	function __construct() {
		$tLigneSortie=array();
	}

	static function chargerPourStockSansLigne($stock, $corbeille) {
		$idStock=$stock->idStock;
		$result = executeSqlSelect("SELECT * FROM sortie where idStock=$idStock and corbeille='$corbeille'");
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
		$sortie->date=date_fr($row['date']);
		$sortie->commentaire=$row['commentaire'];
		$sortie->coutTotal=$row['coutTotal'];
		$sortie->nbreArticles=$row['nbreArticles'];
		$sortie->corbeille=$row['corbeille'];
		$sortie->etat=$row['etat'];
		return $sortie;
	}

	static function chargerSortiesVirtuelles($stock) {
		$idStock=$stock->idStock;
		$result = executeSqlSelect("SELECT idSortie FROM sortie where idStock=$idStock and corbeille='N' and etat='VIRTUELLE'");
		$sorties = array();
		while($row = mysqli_fetch_array($result)) {
			$idSortie=$row['idSortie'];
			$sortie=self::charger($idSortie, $stock);
			$sorties[$idSortie]=$sortie;
		}
		return $sorties;
	}

	static function charger($idSortie, $stock) {
		// Chargement des données principales
		$result = executeSqlSelect("SELECT * FROM sortie where idSortie=".$idSortie);
		$row = mysqli_fetch_array($result);
		$sortie = self::instanceDepuisSqlRow($row, $stock);
		// Chargement des lignes
		$result = executeSqlSelect("SELECT * FROM ligne_sortie, article where ligne_sortie.idArticle=article.idArticle and idSortie=$idSortie");
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
	
	function quantiteArticle($article) {
		$quantite=0;
		foreach ($this->tLigneSortie as $ligneSortie) {
			if ($ligneSortie->article->idArticle==$article->idArticle) {
				$quantite=$ligneSortie->quantite;
				break;
			}
		}
		return $quantite;
	}

	function update() {
		$this->calculeCoutTotal();
		$this->calculeNbreArticles();
		$nom=mysqlEscape($this->nom);
		$commentaire=mysqlEscape($this->commentaire);
		$date=dateMySql($this->date);
		$sql="update sortie set nom='$nom', commentaire='$commentaire', date=$date, coutTotal=$this->coutTotal, nbreArticles=$this->nbreArticles, etat='$this->etat' where idSortie=$this->idSortie";
		executeSql($sql);
	}
	
	function insert() {
		$idStock=$this->stock->idStock;
		$this->calculeCoutTotal();
		$this->calculeNbreArticles();
		$nom=mysqlEscape($this->nom);
		$commentaire=mysqlEscape($this->commentaire);
		$date=dateMySql($this->date);
		$sql="insert into sortie (idStock, nom, commentaire, date, coutTotal, nbreArticles, corbeille, etat) values ($idStock, '$nom', '$commentaire', $date, $this->coutTotal, $this->nbreArticles, 'N', '$this->etat')";
		executeSql($sql);
		$this->idSortie=dernierIdAttribue();
		// Insertion des ligneSortie
		foreach ($this->tLigneSortie as $ligneSortie) {
			$ligneSortie->insert();
		}
	}
	
	function delete() {
		$sql="delete from ligne_sortie where idSortie=$this->idSortie";
		executeSql($sql);
		$sql="delete from sortie where idSortie=$this->idSortie";
		executeSql($sql);
		// Suppression des articles qui ne sont plus référencés
		article::purge();
	}
	
	function calculeCoutTotal() {
		$this->coutTotal=0;
		foreach ($this->tLigneSortie as $ligneSortie) {
			$this->coutTotal = $this->coutTotal + round($ligneSortie->prixSortie * $ligneSortie->quantite, 2);
		}
	}

	function calculeNbreArticles() {
		$this->nbreArticles=sizeof($this->tLigneSortie);
	}

	function supprimer() {
		$sql="update sortie set corbeille='O' where idSortie=$this->idSortie";
		executeSql($sql);
	}

	function restaurer() {
		$sql="update sortie set corbeille='N' where idSortie=$this->idSortie";
		executeSql($sql);
	}

	function rendreReelle($stock) {
		beginTransaction();
		$this->etat=$this::$REELLE;
		$this->update();
		foreach ($this->tLigneSortie as $ligneSortie) {
			$article=$ligneSortie->article;
			$quantite=$ligneSortie->quantite;
			$stock->retirerArticle($article, $quantite);
		}
		$stock->calculerQuantitesVirtuelles();
		commit();
	}
	
	function rendreVirtuelle($stock) {
		beginTransaction();
		$this->etat=$this::$VIRTUELLE;
		$this->update();
		foreach ($this->tLigneSortie as $ligneSortie) {
			$article=$ligneSortie->article;
			$quantite=$ligneSortie->quantite;
			$stock->ajouterArticle($article, $quantite);
		}
		$stock->calculerQuantitesVirtuelles();
		commit();
	}
	
	function libelleEtat() {
		if ($this->etat==$this::$REELLE) {
			$libelle="REELLE";
		} else {
			$libelle="VIRTUELLE";
		}
		return $libelle;
	}
}
?>