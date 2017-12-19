<?php
	// Lecture du fichier de configuration
	if (!isset($_SESSION["fichierConfiguration"])) {
		$_SESSION["fichierConfiguration"]=parse_ini_file("../configuration.ini", true);
	}
	$tConfiguration = $_SESSION["fichierConfiguration"];
	$tConnexion = $tConfiguration["connexionBDD"];
	$base=$tConnexion["base"];
	$host=$tConnexion["host"];
	$login=$tConnexion["login"];
	$password=$tConnexion["password"];

	// Connexion
	$link = mysqli_connect($host, $login, $password);
	
	/* Vérification de la connexion */
	if (mysqli_connect_errno()) {
		printf("Échec de la connexion : %s\n", mysqli_connect_error());
		unset($_SESSION["fichierConfiguration"]);
		exit();
	}

	/* Change la base de données courante */
	if (!mysqli_select_db($link, $base)) {
		echo "Database $base non trouvée ! -> " . mysqli_error($link);
		unset($_SESSION["fichierConfiguration"]);
		exit;
	}
?>