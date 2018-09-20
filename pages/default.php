<?php 
	if(isConnect()){
		header("Location: index.php?p=compte");
	}else{

		header("Location: index.php?p=connexion");	
	}
?>