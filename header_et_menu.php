<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<HEAD>
<TITLE>Gestock</TITLE>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<meta http-equiv="imagetoolbar" content="no">
<META name="keywords" content="gestion,stock">
<LINK media="screen" href="style.css" type="text/css" rel="stylesheet">
</HEAD>
<BODY>
<table class="tableBandeauHaut">
<tr>
<td><img src="img/GSS.png"></td>
<td width="100%" align="center">
<?php
echo "$utilisateur->nom - $utilisateur->prenom";
echo "<br>";
echo "Stock actuel : $stock->nom";
?>
</td>
</tr>
</table>