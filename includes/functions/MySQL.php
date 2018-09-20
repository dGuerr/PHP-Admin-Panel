<?php	

function canConnectSQL()
{
	if($con = connectSQL())
	{
		closeSQL($con);
		createTableAllIfNotExist();
		return true;
	}
	else
	{
		return false;
	}
}

function connectSQL()
{
	return mysqli_connect(getHoteSQL(),getUtilisateurSQL(),getMdpSQL());
}

function closeSQL($con)
{
	mysqli_close($con);
}

function existTable($table)
{
	$return = false;
	if($con = connectSQL())
	{
		if ($result=mysqli_query($con,"SHOW TABLES FROM ".getNomBaseSQL()." LIKE '".$table."'"))
  		{
  			$rowcount=mysqli_num_rows($result);
			if($rowcount == 1)
			{
				$return = true;
			}
			closeSQL($con);
		}
	}
	return $return;
}

function createTableAllIfNotExist()
{
	if(!existTable("utilisateurs")){createTable("utilisateurs");}
	if(!existTable("joueurs")){createTable("joueurs");}
	if(!existTable("commentaires")){createTable("commentaires");}
	if(!existTable("grades")){createTable("grades");}
	if(!existTable("permissions")){createTable("permissions");}

}

function createTable($table)
{
	$request = "";
	if($table == "utilisateurs")
	{
		$request = "CREATE TABLE ".getNomBaseSQL().".utilisateurs
		(
   		 id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	     identifiant VARCHAR(100),
    	 email VARCHAR(255),
    	 mot_de_passe VARCHAR(255),
		 rang INT(255),
		 telephone VARCHAR(255),
		 steam VARCHAR(255),
		 banni INT(255)
		)";
	}
	else if($table == "joueurs")
	{
		$request = "CREATE TABLE ".getNomBaseSQL().".joueurs
		(
   		 id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	     guid INT(255),
	     prenomRP VARCHAR(100),
    	 nomRP VARCHAR(255),
    	 twitch VARCHAR(255),
    	 forum VARCHAR(255),
    	 moderateur VARCHAR(255),
    	 ancien_noms VARCHAR(255),
		 date VARCHAR(255),
		 commentaire VARCHAR(255),
		 groupe VARCHAR(255),
		 gradeFaily VARCHAR(255),
		 slot VARCHAR(255),
		 absent INT(255),
		 avertissement INT(255),
		 ban INT(255),
		 age INT(255)
		)";
	}else if($table == "commentaires")
	{
		$request = "CREATE TABLE ".getNomBaseSQL().".commentaires
		(
   		 id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	     UserID INT(255),
		 OwnerID INT(255),
		 Date VARCHAR(255),
		 Content VARCHAR(500)
		)";
	}
	else if($table == "grades")
	{
		$request = "CREATE TABLE ".getNomBaseSQL().".grades
		(
   		 id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	     name VARCHAR(255),
		 permissions VARCHAR(255)
		)";
	}
	else if($table == "permissions")
	{
		$request = "CREATE TABLE ".getNomBaseSQL().".permissions
		(
   		 id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	     name VARCHAR(255)
		)";
	}
	else 
	{
		return false;
		die();
	}

	$con = connectSQL();
	$return = mysqli_query($con, $request);
	closeSQL($con);
	fill($table);
	return $return;
}

function fill($table){
	if($table == "grades"){
		$grade = new Grade(1);
		$grade->addDefault("Administrateur", "*");
		$grade->create();

		$grade = new Grade(2);
		$grade->addDefault("Co-Administrateur", "*");
		$grade->create();

		$grade = new Grade(3);
		$grade->addDefault("Moderateur", "");
		$grade->create();

		$grade = new Grade(4);
		$grade->addDefault("Helpeur", "");
		$grade->create();

		$grade = new Grade(5);
		$grade->addDefault("Graphiste", "");
		$grade->create();

		$grade = new Grade(6);
		$grade->addDefault("Mappeur", "");
		$grade->create();

		$grade = new Grade(7);
		$grade->addDefault("Developpeur", "");
		$grade->create();

		$grade = new Grade(8);
		$grade->addDefault("Maitre du jeu", "");
		$grade->create();

		// FIXER L'ID A ZERO
		$grade = new Grade(9);
		$grade->addDefault("Membres", "");
		$grade->create();
		// FIXER L'ID A ZERO

		$grade = new Grade(10);
		$grade->addDefault("Community Manager", "");
		$grade->create();
		
	}else if($table == "permissions"){

		$perm = new Permission(1);
		$perm->addDefault("Acceder à la liste des membres");
		$perm->create();

		$perm = new Permission(2);
		$perm->addDefault("Editer un membre");
		$perm->create();

		$perm = new Permission(3);
		$perm->addDefault("Supprimer un membre");
		$perm->create();

		$perm = new Permission(4);
		$perm->addDefault("Acceder à la liste des joueurs");
		$perm->create();

		$perm = new Permission(5);
		$perm->addDefault("Voir un joueur");
		$perm->create();

		$perm = new Permission(6);
		$perm->addDefault("Editer un joueur");
		$perm->create();

		$perm = new Permission(7);
		$perm->addDefault("Supprimer un joueur");
		$perm->create();

		$perm = new Permission(8);
		$perm->addDefault("Acceder au log des morts");
		$perm->create();

		$perm = new Permission(9);
		$perm->addDefault("Intégrer un joueur");
		$perm->create();

		$perm = new Permission(10);
		$perm->addDefault("Modifier les droits des groupes");
		$perm->create();

		$perm = new Permission(11);
		$perm->addDefault("Fait parti du staff");
		$perm->create();

	}
}

?>