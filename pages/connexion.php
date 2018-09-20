<?php
	if(isConnect()){
		header("Location: index.php?p=compte&n=2");
		die();
	}
	if(file_exists("functions/login.php"))
		include("functions/login.php");
?>

<center>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form class="well" action="index.php" method="get">
				<h3>Connexion</h3>
			  	<input name="p" type=hidden value="connexion" required>
			  	<div class="form-group">
					<label for="inputIdentifiant">Pseudonyme</label>
			    	<input name="Identifiant" type="text" class="form-control" id="inputIdentifiant" placeholder="Pseudonyme" required>
				 </div>
				 <div class="form-group">
				    <label for="inputMotDePasse">Mot de passe</label>
				    <input name="Mot_De_Passe" type="password" class="form-control" id="inputMotDePasse" placeholder="Mot de passe" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Connexion"></input>
				<p class="help-block">Vous n'avez pas de compte ? <a href="index.php?p=inscription">Inscrivez-vous ici.</a></p>
			</form>	
		</div>
	</div>
</center>