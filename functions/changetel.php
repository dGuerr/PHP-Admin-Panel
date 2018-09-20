<?php
	if(isset($_GET['Mot_De_Passe']) && isset($_GET['Telephone']) && isset($_GET['Confirm_Telephone']))
	{
		$old = $_GET['Mot_De_Passe'];
		$tel = $_GET['Telephone'];
		$confirm = $_GET['Confirm_Telephone'];
		if(isConnect())
		{
			if(canConnectSQL())
			{
				if(getMDP() == md5($old))
				{
					if(strcasecmp($tel, $confirm) == 0)
					{
						setTelephone($tel);
						header("Location: index.php?p=compte&n=16"); //success
						die();
					}
					else
					{
						header("Location: index.php?p=compte&a=changetel&n=25"); //Tel confirm
						die();
					}
				}
				else
				{
					header("Location: index.php?p=compte&a=changetel&n=12"); //MDP incorect
					die();
				}
			}
			else
			{
				header("Location: index.php?p=compte&a=changetel&n=1"); //SQL
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