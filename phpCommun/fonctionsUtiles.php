<?php
	// Supprime les décimales inutiles : 23.0 -> 23 | 23.01 -> 23.01 | 23.6 -> 23.6
	// N'est utilisé que pour l'affichage
	function afficherEntierSansDec($nombre) {
		if (is_null($nombre) || trim($nombre)=="") {
			$nRet="";
		} else {
			$nRet=floatval($nombre);
		}
		return $nRet;
	}
	
	function libelleDuMoisCourt($nMois) {
		$libellesMois = array(
			1 => "Jan",
			2 => "Fév",
			3 => "Mars",
			4 => "Avril",
			5 => "Mai",
			6 => "Juin",
			7 => "Juil",
			8 => "Août",
			9 => "Sept",
			10=> "Oct",
			11=> "Nov",
			12=> "Déc",
		);
		return $libellesMois[$nMois];
	}
?>