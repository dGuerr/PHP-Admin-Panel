<?php
	if(isConnect())
	{
		header("Location: index.php?p=compte&n=2");
		die();
	}
	if(file_exists("functions/register.php"))
		include("functions/register.php");
?>

<center>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form class="well" action="index.php" method="get">
				<h3>Inscription</h3>
			  	<input name="p" type=hidden value="inscription" required>
			  	<div class="form-group">
					<label for="inputIdentifiant">Pseudonyme</label>
			    	<input name="Identifiant" type="text" class="form-control" id="inputIdentifiant" placeholder="Ex: DarkAngel64" required>
				 </div>
				 <div class="form-group">
				    <label for="inputMotDePasse">Mot de passe</label>
				    <input name="Mot_De_Passe" type="password" class="form-control" id="inputMotDePasse" placeholder="Ex: G4SF4s43" required>
				</div>
				<div class="form-group">
				    <label for="inputEmail">Email</label>
				    <input name="Email" type="email" class="form-control" id="inputEmail" placeholder="Ex: darkAngel@gmail.com" required>
				</div>
				<div class="form-group">
				    <label for="inputSteam">Steam</label>
				    <input name="Steam" type="text" class="form-control" id="inputSteam" placeholder="Ex: Darky64 " required>
				</div>
				<div class="form-group">
				    <label for="inputTelephone">Numero de Telephone</label>
				    <input name="Telephone" type="tel" class="form-control" id="inputTelephone" placeholder="Ex: 0666001337" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Inscription"></input>
				<p class="help-block">Vous avez déja un compte ? <a href="index.php?p=connexion">Connectez-vous.</a></p>
			</form>	
		</div>
	</div>
</center>