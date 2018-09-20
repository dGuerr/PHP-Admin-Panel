<?php
	session_destroy();
	header("Location: index.php?p=connexion&n=3");
	die;
?>