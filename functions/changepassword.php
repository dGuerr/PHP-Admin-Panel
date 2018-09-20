<?php
	if(isset($_GET['Old_Mot_de_passe']) && isset($_GET['Mot_De_Passe']) && isset($_GET['Confirm_Mot_De_Passe']))
	{
		$old = $_GET['Old_Mot_de_passe'];
		$mdp = $_GET['Mot_De_Passe'];
		$confirm = $_GET['Confirm_Mot_De_Passe'];
		if(isConnect())
		{
			if(canConnectSQL())
			{
				if(getMDP() == md5($old))
				{
					if(md5($mdp) == md5($confirm))
					{
						setMotDePasse($mdp);
						header("Location: index.php?p=compte&n=16"); //success
						die();
					}
					else
					{
						header("Location: index.php?p=compte&a=changepass&n=12"); //MDP confirm
						die();
					}
				}
				else
				{
					header("Location: index.php?p=compte&a=changepass&n=12"); //MDP incorect
					die();
				}
			}
			else
			{
				header("Location: index.php?p=compte&a=changepass&n=1"); //SQL
				die();
			}
		}
		else
		{				
			header("Location: index.php?p=connexion&n=8"); //No connecting
			die();
		}
	}

?>