	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

	    <div class="container-fluid">

	    	<div class="navbar-header">

	    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

	                <span class="sr-only">Barre de navigation</span>

	                <span class="icon-bar"></span>

	                <span class="icon-bar"></span>

	                <span class="icon-bar"></span>

	            </button>

	            <a class="navbar-brand" href="index.php">Amarallis</a>

	        </div>

	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

	        	<ul class="nav navbar-nav">

	        		<?php

	        		echo '<li class="active"> <a href="index.php">'.(isConnect() ? "Mon compte" : "Connexion").'</a> </li>';

        			

        			if(hasPermission(11, false)){

        			if(hasPermission(4, false)){echo '<li> <a href="index.php?p=joueurs">Liste Joueurs</a></li>';}

					if(hasPermission(1, false)){echo '<li> <a href="index.php?p=membres">Liste Staff</a> </li>';}

			        if(hasPermission(8, false)){echo '<li> <a href="index.php?p=mort">Log des morts</a></li>';}

		        		echo '<li class="dropdown"> 

	            			<a data-toggle="dropdown" href="#">Bureaux<b class="caret"></b></a>

							<ul class="dropdown-menu">';

							if(hasPermission(10, false)){	echo '<li><a href="index.php?p=badmin">Bureau des Administrateurs</a></li>	';	}	

							echo '</ul>

							</li>';

					}

					?>

	        	</ul>

	          	    	<ul class="nav navbar-nav navbar-right">

	          	    		<?php

	          	    			if(hasPermission(9, false)){	echo '<li><a href="index.php?p=addplayer">Ajouter un Joueur</a></li>';}

		          	    		if(!isConnect())	{	echo '<li><a href="index.php?p=connexion">Connexion</a></li>	 ';}    

	                    					else 	{	echo '<li><a href="index.php?p=deconnexion">Deconnexion</a></li> '; }

                    		?>

	          	    	</ul>

     	 		</form>

	    </div>

	</nav>