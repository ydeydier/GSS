<?php
	// TODO: appeler ce fichier autrement
	function executeSql($sql) {
		global $link;
		//echo $sql."<br><br>"; die();  // décommenter pour débugguer
		if (!mysqli_query($link, $sql)) {
			mysqli_rollback($link);
			die('Erreur SQL ! '.$sql.'<br>'.mysqli_error($link));
		}
	}

	function beginTransaction() {
		global $link;
		mysqli_autocommit($link, FALSE);
	}
	
	function commit() {
		global $link;
		mysqli_commit($link);
		mysqli_autocommit($link, TRUE);
	}
	
	function rollback() {
		global $link;
		mysqli_rollback($link);
	}

	function executeSqlSelect($sql) {
		global $link;
		$result=mysqli_query($link, $sql);
		if (!$result) {
			die('Erreur SQL ! '.$sql.'<br>'.mysqli_error($link));
		}
		return $result;
	}

	function nullSiVide($val) {
		if (trim($val)=="") {
			$ret="null";
		} else {
			$ret=$val;
		}
		return $ret;
	}
	
	function nullSiVideStr($val) {
		if (trim($val)=="") {
			$ret="null";
		} else {
			$ret="'$val'";
		}
		return $ret;
	}

	function dernierIdAttribue() {
		global $link;
		return mysqli_insert_id($link);
	}
	
	//
	// Ajoute les caractères d'échapement pour MySql (en supprimant l'opération effectuée par le magic_quotes)
	//
	function mysqlEscape($value) {
		global $link;
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		$value = mysqli_real_escape_string($link, $value);
		return $value;
	}

	function date_fr($date) {
		$datefr="";
		if (!is_null($date)) {
			$a = substr($date, 0, 4);
			$m = substr($date, 5, 2);
			$j = substr($date, 8, 2);
			$datefr=$j.'/'.$m.'/'.$a;
		}
		return $datefr;
	}

	function dateMySql($date) {
		$dateSql="null";
		if (!is_null($date) && $date!="") {
			$j = substr($date, 0, 2);
			$m = substr($date, 3, 2);
			$a = substr($date, 6, 4);
			$dateSql="'$a-$m-$j'";
		}
		return $dateSql;
	}

	function isInteger($nombre) {
		$val=strval($nombre);
		return ((int) $val)==$val;
	}
	
	// TODO: à implémenter partout
	function afficherEntierSansDec($nombre) {
		if (isInteger($nombre)) {
			$ret=(int) strval($nombre);
		} else {
			$ret=$nombre;
		}
		return $ret;
	}
?>