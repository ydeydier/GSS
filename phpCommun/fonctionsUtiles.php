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
?>