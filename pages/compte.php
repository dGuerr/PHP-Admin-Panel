<?php
	if(isConnect())
	{
      if(isset($_GET['a']))
      {
        if($_GET['a'] == "changemail")
        {
            if(file_exists("functions/changeemail.php"))
              include("functions/changeemail.php");
        ?>

            <center>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form class="well" action="index.php" method="get">
                    <h3>Changer d'adresse Email</h3>
                      <input name="p" type=hidden value="compte" required>
                      <input name="a" type=hidden value="changemail" required>
                      <div class="form-group">
                      <label for="inputIdentifiant">Mot de passe</label>
                        <input name="Mot_de_passe" type="password" class="form-control" id="inputIdentifiant" placeholder="Mot de passe" required>
                     </div>
                     <div class="form-group">
                        <label for="inputEmail">Nouvel Email</label>
                        <input name="Email" type="mail" class="form-control" id="inputEmail" placeholder="Email" required>
                    </div>
                     <div class="form-group">
                        <label for="inputEmail">Confirmer Email</label>
                        <input name="Confirm_Email" type="mail" class="form-control" id="inputEmail" placeholder="Email" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Modifier"></input>
                    
                  </form> 
                </div>
              </div>
            </center>
        <?php
          die();
        }
        if($_GET['a'] == "changepass")
        {
            if(file_exists("functions/changepassword.php"))
              include("functions/changepassword.php");
        ?>

            <center>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form class="well" action="index.php" method="get">
                    <h3>Changer de Mot de Passe</h3>
                      <input name="p" type=hidden value="compte" required>
                      <input name="a" type=hidden value="changepass" required>
                      <div class="form-group">
                      <label for="inputMotDePasse">Ancien Mot de passe</label>
                        <input name="Old_Mot_de_passe" type="password" class="form-control" id="inputMotDePasse" placeholder="Mot de passe" required>
                     </div>
                     <div class="form-group">
                        <label for="inputMotDePasse">Nouveau Mot de passe</label>
                        <input name="Mot_De_Passe" type="password" class="form-control" id="inputMotDePasse" placeholder="Mot de passe" required>
                    </div>
                     <div class="form-group">
                        <label for="inputMotDePasse">Confirmer Mot de passe</label>
                        <input name="Confirm_Mot_De_Passe" type="password" class="form-control" id="inputMotDePasse" placeholder="Mot de passe" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Modifier"></input>
                    
                  </form> 
                </div>
              </div>
            </center>
        <?php
          die();
        }
         if($_GET['a'] == "changetel")
        {
            if(file_exists("functions/changetel.php"))
              include("functions/changetel.php");
        ?>

            <center>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <form class="well" action="index.php" method="get">
                    <h3>Changer de Numéro de Telephone</h3>
                     <input name="p" type=hidden value="compte" required>
                     <input name="a" type=hidden value="changetel" required>
                     <div class="form-group">
                      <label for="inputTel">Mot de passe</label>
                        <input name="Mot_De_Passe" type="password" class="form-control" id="inputMotDePasse" placeholder="Mot de passe" required>
                     </div>
                     <div class="form-group">
                        <label for="inputTel">Nouveau Numéro</label>
                        <input name="Telephone" type="tel" class="form-control" id="inputMotDePasse" placeholder="Numero de tel" required>
                    </div>
                     <div class="form-group">
                        <label for="inputTel">Confirmer Numéro</label>
                        <input name="Confirm_Telephone" type="tel" class="form-control" id="inputMotDePasse" placeholder="Numero de tel" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Modifier"></input>
                    
                  </form> 
                </div>
              </div>
            </center>
        <?php
          die();
        }
      }

	echo '</center>
          <div class="well">
          <ul class="list-group">
            <li class="list-group-item">
                <h4 class="text-center">'.getIdentifiant().'</h4>
                <p class="text-center">'.getRangName().'</p>
               	<p class="text-center"><img src="../images/Avatar/'.getRang().'.png" class="img-thumbnail"></p>
                <p class="text-center">SteamID: <a href=http://steamcommunity.com/id/'.getSteam().' target="_blank">'.getSteam().'</a></p>
            </li>
            <li class="list-group-item">
                <p class="text-center">Email: '.getEmail().' <a href="index.php?p=compte&a=changemail"> [Changer]</a> </p>
				<p class="text-center">Telephone: '.getTelephone().' <a href="index.php?p=compte&a=changetel"> [Changer]</a> </p>
				<p class="text-center">Mot de passe:  ******* <a href="index.php?p=compte&a=changepass">[Changer]</a> </p>
            </li>
        	</ul>
        	</div>
    ';
		
	}
	else
	{
		header("Location: index.php?p=connexion&n=8");
		die();
	}
?>

