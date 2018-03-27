<?php
	require "inc_commun.php";
	require "header_et_menu.php";
	// Charge la liste des années des sorties réelles présentes dans le stock
	$listeAnnees = sortie::chargerListeAnneeReelle($stock);

	// Si une année est passée en paramètre d'URL, elle définira la valeur du filtre
	if (isset($_GET['annee'])) {
		$anneeFiltre=$_GET['annee'];
	} else {
		if (count($listeAnnees)==0) {
			$anneeFiltre=date('Y');	// année courante
		} else {
			$anneeFiltre=$listeAnnees[0];	// année la plus récente parmis celles trouvées en base
		}
	}

	// Chargement des sorties
	$sorties = sortie::chargerReellesPourStockAnneeSansLigne($stock, $anneeFiltre);

	// Calcul des statistiques : coût par mois -> résultat dans $tableStatCoutMois
	$tableStatCoutMois = array();
	foreach ($sorties as $sortie) {
		$mois=intval(getMois($sortie->date));
		if (!isset($tableStatCoutMois[$mois])) $tableStatCoutMois[$mois]=0;
		$tableStatCoutMois[$mois]+=$sortie->coutTTCTotal;
	}

	// Calcul des statistiques : coût par mois et par nom de sortie -> résultat dans $tableStatCoutNbreMoisNom
	$tableStatCoutNbreMoisNom = array();
	foreach ($sorties as $sortie) {
		$nom=trim(ucfirst($sortie->nom));
		$mois=intval(getMois($sortie->date));
		if (!isset($tableStatCoutNbreMoisNom[$nom][$mois]["cout"])) {
			$tableStatCoutNbreMoisNom[$nom][$mois]["cout"]=0;
			$tableStatCoutNbreMoisNom[$nom][$mois]["nombre"]=0;
		}
		$tableStatCoutNbreMoisNom[$nom][$mois]["cout"]+=$sortie->coutTTCTotal;
		$tableStatCoutNbreMoisNom[$nom][$mois]["nombre"]+=1;
	}
?>
<CENTER>
<br>
<h1>Coût des sorties réelles, par mois</h1>
<br><br><br>

Année&nbsp;&nbsp;
<select onchange="javascript:window.location='statCoutParMois.php?annee=' + this.value;">
	<?php
	foreach ($listeAnnees as $annee) {
		if ($annee==$anneeFiltre)
			$selected=" selected";
		else
			$selected="";
		echo "<option $selected value=\"$annee\">$annee</option>";
	}
	?>
</select>

<br><br>
<h2>Total par mois</h2>
<br>
<table class="tableCommune">
<?php
	echo "<tr>";
	echo "<th></th>";
	for ($i=1;$i<=12;$i++) {
		$libelleMois=libelleDuMoisCourt($i);
		echo "<th width='30px'>$libelleMois</th>";
	}
	echo "</tr>";
	
	echo "<tr>";
	echo "<th style='width:150px'>Coût<br>(EUR TTC)</th>";
	for ($i=1;$i<=12;$i++) {
		if (isset($tableStatCoutMois[$i])) $cout=$tableStatCoutMois[$i]; else $cout=0;
		echo "<td align='center'>$cout</td>";
	}
	echo "</tr>";
?>
</table>

<br><br>
<h2>Total par sorties groupées (nombre / coût EUR TTC)</h2>
<br>
<table class="tableCommune">
<?php
	echo "<tr>";
	echo "<th></th>";
	for ($i=1;$i<=12;$i++) {
		$libelleMois=libelleDuMoisCourt($i);
		echo "<th width='30px'>$libelleMois</th>";
	}
	echo "</tr>";
	
	foreach ($tableStatCoutNbreMoisNom as $nom => $mois) {
		echo "<tr>";
		echo "<th style='width:150px'>$nom</th>";
		for ($i=1;$i<=12;$i++) {
			if (isset($mois[$i]["cout"])) {
				$cout=$mois[$i]["cout"];
				$nombre=$mois[$i]["nombre"];
			} else {
				$cout="";
				$nombre="";
			}
			echo "<td align='center'>$nombre<br>$cout</td>";
		}
		echo "</tr>";
	}
?>
</table>


<br><br><br><br>
<a class="menu" href="pagePrincipale.php">*** Retour Page Accueil ***</a>

</CENTER>
<br><br><br><br>
<?php
	require "footer.php";
?>