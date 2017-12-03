<?php
	function executeSql($sql) {
		global $link;
		//echo $sql."<br><br>"; die();  // décommenter pour débugguer
		if (!mysqli_query($link, $sql)) {
			mysqli_rollback($link);
			die('Erreur SQL !'.$sql.'<br>'.mysqli_error());
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
	
	function executeSqlSelect($sql) {
		global $link;
		return mysqli_query($link, $sql);
	}

	function nullSiVide($val) {
		if (trim($val)=="") {
			$ret="null";
		} else {
			$ret=$val;
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

	/*
	function date_fr($date) {
		$a = substr($date, 0, 4);
		$m = substr($date, 5, 2);
		$j = substr($date, 8, 2);
		$h = substr($date, 11, 2);
		$min = substr($date, 14, 2);
		$s = substr($date, 17, 2);
		$datefr=$j.'/'.$m.'/'.$a;
		$heurefr=$h.':'.$min;
		return $datefr." à ".$heurefr;
	}
	*/
?>