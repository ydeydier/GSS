<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	session_start();
	session_destroy();
	header("Location: login.php");
?>