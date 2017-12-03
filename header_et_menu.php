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


<table style="height:100%;border-collapse:collapse;">
<tr height="5%">
<td colspan="2" style="padding-top:0px;padding-left:0px;padding-right:0px;padding-bottom:0px;">
	<table class="tableBandeauHaut">
	<tr>
	<td><img src="img/GSS.png"></td>
	<td width="100%" align="center">
	Stock actuel<br>
	<span class="spanNomStock"><?php echo "$stock->nom";?></span>
	</td>
	<td nowrap align="right" style="padding:5px;">
	<?php echo "$utilisateur->prenom $utilisateur->nom";?><br>
	<a href="">Se déconnecter</a>
	</td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td width="90%" valign="top">