<?php
	if(isset($_GET['Identifiant']) && isset($_GET['Mot_De_Passe'])){

		if(canConnectSQL())
		{
			if(connectUser($_GET['Identifiant'], $_GET['Mot_De_Passe']))
			{
				if(!isBanni())
				{
					header("Location: index.php?p=compte&n=15");
					die();
				}
				else
				{
					session_destroy();
					header("Location: index.php?p=connexion&n=7");
					die();
				}

			}
			else
			{
				header("Location: index.php?p=connexion&n=2");
				die();
			}
		}
		else
		{
			header("Location: index.php?p=connexion&n=1");
			die();
		}
		
	}

?>