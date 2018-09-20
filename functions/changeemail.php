<?php
	if(isset($_GET['Mot_de_passe']) && isset($_GET['Email']) && isset($_GET['Confirm_Email']))
	{
		$mdp = $_GET['Mot_de_passe'];
		$mail = $_GET['Email'];
		$confirm = $_GET['Confirm_Email'];
		if(isConnect())
		{
			if(canConnectSQL())
			{
				if(getMDP() == md5($mdp))
				{
					if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail))
					{
						if(strcasecmp($mail, $confirm) == 0)
						{
							setEmail($mail);
							header("Location: index.php?p=compte&n=14"); //success
							die();
						}
						else
						{
							header("Location: index.php?p=changemail&n=13"); 
							die();
						}
					}
					else
					{
						header("Location: index.php?p=changemail&n=13"); 
						die();
					}

				}
				else
				{
					header("Location: index.php?p=changemail&n=12"); 
					die();
				}
			}
			else
			{
				header("Location: index.php?p=changemail&n=1"); //SQL
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