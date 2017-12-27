<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	//error_reporting(E_ALL ^ E_DEPRECATED);
	session_start();
	require "header1.php";
	$login="";
	$password="";
	if (isset($_COOKIE['login'])) $login=$_COOKIE['login'];
	if (isset($_COOKIE['password'])) $password=$_COOKIE['password'];
	$messageLoginIncorrect="";
	if (isset($_GET['erreur'])) {
		$erreur=$_GET['erreur'];
		if ($erreur=="passwordIncorrectBase") $messageLoginIncorrect='<span style="color:red;font-weight:bold;">Mot de passe local incorrect !</span>';
		if ($erreur=="passwordIncorrectLDAP") $messageLoginIncorrect='<span style="color:red;font-weight:bold;">Mot de passe Windows incorrect !</span>';
		if ($erreur=="loginIncorrect")        $messageLoginIncorrect='<span style="color:red;font-weight:bold;">Login incorrect !</span>';
		if ($erreur=="aucunStockAutorise")    $messageLoginIncorrect='<span style="color:red;font-weight:bold;">Vous n\'avez à aucun stock !<br>Veuillez contacter l\'administrateur de l\'application.</span>';
	}
?>
<table class="tableLoginGSS">
<tr height="200px">
<td>
<img src="../img/GSS.png">
</td>
</tr>
<tr height="200px" style="BACKGROUND:#FFFFFF;">
<td>
	<?php echo $messageLoginIncorrect;?>
	<br><br>
	<form method="POST" action="login_trt.php">
	<table align="center" cellpadding="5px">
	<tr><td style="text-align:left;">Utilisateur</td><td><input spellcheck="false" type="text" name="txtLogin" value="<?php echo $login;?>" <?php if ($login=="") echo "autofocus";?>></td></tr>
	<tr><td style="text-align:left;">Mot de passe</td><td><input type="password" name="txtPassword" value="<?php echo $password;?>"></td></tr>
	</table>
	<br><br><br>
	<button type="submit" class="bouton" <?php if ($login!="") echo "autofocus";?>>Connexion</button>
	</form>
	<br><br>
</td>
</tr>

<tr>
<td style="color:#EEEEEE;" valign="bottom">
GSS Version 1.0 - <a class="lienFondVert" href="apropos.php">A propos de GSS</a></div>
</td>
</tr>

</table>
</body>
</html>