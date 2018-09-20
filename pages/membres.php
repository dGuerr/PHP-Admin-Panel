<?php
	function remplace($txt, $recherche){
		if($recherche == "")
			return $txt;
		$replace = "<span class=surligne>".$recherche."</span>";
		$result ="";
		$result = str_replace($recherche, $replace, $txt);
		return $result;
	}

	if(!isConnect())
	{
		header("Location: index.php?p=connexion&n=8");
		die();
	}
	hasPermission(1, true);
$die = false;

	if(isset($_GET['a']) && isset($_GET['id']))
	{
	    $id = htmlentities(addslashes($_GET['id']));
	    if($_GET['a'] == "supression")
	    {
	    	hasPermission(3, true);
	        if(canConnectSQL())
	        {
	            if($con = connectSQL())
	            {
	                $retour = mysqli_query($con, "DELETE FROM ".getNomBaseSQL().".utilisateurs WHERE id='".$id."'");
	                closeSQL($con);
	            }
	            header("Location: index.php?p=membres&n=11");
	            die();
	        }
	    }
	    else if($_GET['a'] == "modifier")
	    {
	    	hasPermission(2, true);
	        if(canConnectSQL())
	        {
	            if($user = new User($id)){
	            	$user->get();
					$identifiant = $user->_identifiant;
					$email = $user->_email;
					$rang = $user->_rang;
					$telephone = $user->_telephone;
					$steam = $user->_steam;
					$banni = $user->_banni;
	            }

	            if($identifiant==""){
	                header("Location: index.php?p=membres&n=17");
	                die();
	            }else{
	                echo "
	                <center>
	                <div class=\"row\">
	                <div class=\"col-md-3\"></div>
	                <div class=\"col-md-6\">
	                <form class=\"well\" action=\"index.php\" method=\"get\">
	                <input name=\"p\" type=hidden value=\"membres\">
	                <input name=\"a\" type=hidden value=\"update\">
	                <input name=\"id\" type=hidden value=\"".$id."\">
	                <h3>Profil de ".$identifiant."</h3>

	                <div class=\"form-group\">
	                <label>Identifiant</label>
	                <input name=\"Identifiant\" type=\"text\" class=\"form-control\" placeholder=\"Identifiant\" required value=\"".$identifiant."\">
	                </div>
	                <div class=\"form-group\">
	                <label>Mail</label>
	                <input name=\"Mail\" type=\"text\" class=\"form-control\" placeholder=\"Mail\" required value=\"".$email."\">
	                </div>
	                <div class=\"form-group\">
	                <label>Rang</label>

	                <select name=\"Rang\" required class=\"form-control\">";
	                foreach(getAllGrades() as $grade){
					  echo "<option ".(($rang==$grade->getID())?"selected" : "")." value=\"".$grade->getID()."\">".$grade->getName()."</option>";
					}
					echo "</select>
	                </div>
	                <div class=\"form-group\">
	                <label>Telephone</label>
	                <input name=\"Telephone\" type=\"text\" class=\"form-control\" placeholder=\"Telephone\" required value=\"".$telephone."\">
	                </div>
	                <div class=\"form-group\">
	                <label>Steam</label>
	                <input name=\"Steam\" type=\"text\" class=\"form-control\" placeholder=\"Steam\" required value=\"".$steam."\">
	                </div>
	                <div class=\"form-group\">
	                <label>Banni</label>
	                <input name=\"Banni\" type=\"text\" class=\"form-control\" placeholder=\"Banni\" required value=\"".$banni."\">
	                </div>
	                <br>
	                <input type=\"submit\" class=\"btn btn-primary btn-lg btn-block\" value=\"Sauvegarder\"></input>
	                </form>
	                </div>
	                </div>
	                </center>
	                ";

	                $die=true;

	            }
	        }
	    }
	    else if($_GET['a'] == "update")
	    {
	    	hasPermission(2, true);
	        $b = true;

	        $list = array("Identifiant", "Mail", "Rang", "Telephone", "Steam", "Banni");
	        foreach($list as $name)
	        {
	            if(!isset($_GET[$name]))
	            {
	                $b = false;
	                break;
	            }
	        }
	        if($b)
	        {
	            $identifiant = htmlentities(addslashes($_GET['Identifiant']));
	            $mail = htmlentities(addslashes($_GET['Mail']));
	            $rang  = htmlentities(addslashes($_GET['Rang']));
	            $telephone = htmlentities(addslashes($_GET['Telephone']));
	            $steam = htmlentities(addslashes($_GET['Steam']));
	            $banni = htmlentities(addslashes($_GET['Banni']));

	            if($user = new User($id)){
	            	$user->get();
	                $user->_identifiant = $identifiant;
	                $user->_email = $mail;
	                $user->_rang = $rang;
	                $user->_telephone = $telephone;
	                $user->_steam = $steam;
	                $user->_banni = $banni;
	                $user->update();

	                header("Location: index.php?p=membres&n=10");
	                die();    
	            }else{
	                header("Location: index.php?p=membres&n=1");
	                die();
	            }
	        }
	    }
	    
	}

	$query = "SELECT * FROM ".getNomBaseSQL().".utilisateurs";
	$recherche = "";

	if(!$die){
?>

<center>
	<div class="row">
		<div class="col-md-3"></div>
			<div class="col-md-6">
				<form class="well" action="" method="get">
					<h3>Recherche</h3>
				<p class="help-block">Entrez un mot clé pour votre recherche. Attention, la recherche prend en compte la Case du mot.</a></p>
				<input name="p" type=hidden value="membres">
				<input type="text" class="form-control" placeholder="nom/email/steam/telephone" required name="r">
				<br>
				<input type="submit" class="btn btn-primary btn-lg btn-block" value="Rechercher"></input>
				</form>	
			</div>
	</div>
</center>
<?php
		if(isset($_GET['r'])){
			$recherche =  htmlentities(addslashes($_GET['r']));
			$query = "SELECT * FROM ".getNomBaseSQL().".utilisateurs
			WHERE 
			identifiant LIKE '%$recherche%' OR
			email LIKE '%$recherche%' OR
			steam LIKE '%$recherche%' OR
			telephone LIKE '%$recherche%' OR
			rang LIKE '%$recherche%' 
			ORDER BY id DESC";
		}

		echo "<div class=\"span\">
		<center><h4>Liste des membres</h4></center>
		<div>
		<table class=\"table table-striped\" id=\"sortTable\">
		<thead><tr>".((hasPermission(2, false) || hasPermission(3, false)) ? "<th>Admin</th>" : "")."<th>ID<img height=15px src=../images/sort-50.png></th><th>Nom<img height=15px src=../images/sort-50.png></th><th>Grade<img height=15px src=../images/sort-50.png></th><th>Telephone<img height=15px src=../images/sort-50.png></th><th>Email</th><th>Steam<img height=15px src=../images/sort-50.png></th><th>Banni</th></tr></thead>
		<tbody>";
		foreach(getAllUsersWithQuery($query) as $user){
			$id = $user->getID();
			$identifiant = $user->_identifiant;
			$email = $user->_email;
			$rang =getRangNameByID($user->_rang);
			$banni = $user->_banni;
			$telephone = $user->_telephone;
			$steam = $user->_steam;
			echo "<tr>";
			if(hasPermission(2, false)){echo"<td><a href=\"index.php?p=membres&a=modifier&id=".$id."\"><img class=option src=../images/Icon/Document-50.png></img></a>";}
			if(hasPermission(3, false)){echo"<a onclick=\"return confirm('Voulez vous supprimer ce membre ?');\" href=\"index.php?p=membres&a=supression&id=".$id."\"><img class=option src=../images/Icon/Cancel-50.png></img></a></td>";} 
			echo"<td>".$id."</td><td>".$identifiant."</td><td>".$rang."</td><td>".$telephone."</td><td>".$email."</td><td>".$steam."</td><td>".$banni."</td>";
		}												
		echo "</tbody></table></div></div>";
	}
?>

