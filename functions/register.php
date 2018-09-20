<?php
	if(isset($_GET['Identifiant']) && isset($_GET['Mot_De_Passe']) && isset($_GET['Email'])  && isset($_GET['Steam'])  && isset($_GET['Telephone']))
	{
		
		if(canConnectSQL())
		{
			$state = registerUser($_GET['Identifiant'], $_GET['Email'] ,$_GET['Mot_De_Passe'], $_GET['Telephone'], $_GET['Steam']);
			if($state == 1)
			{
				connectUser($_GET['Identifiant'], $_GET['Mot_De_Passe']);
				header("Location: index.php?p=compte&n=15");
				die();
			}
			else
			{
				header("Location: index.php?p=inscription&n=9");
				die();
			}
		}
		else
		{
			header("Location: index.php?p=inscription&n=1");
			die();
		}
		
	}

?>