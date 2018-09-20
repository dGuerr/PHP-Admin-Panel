<?php	

	class User{
		public $_id;
		public $_identifiant;
		public $_email;
		public $_motdepasse;
		public $_rang;
		public $_telephone;
		public $_steam;
		public $_banni;
		
		public function __construct($id){
			$this->_id = $id;
		}

		public function addDefault($identifiant, $email, $motdepasse){
			$this->_identifiant = $identifiant;
			$this->_email = $email;
			$this->_motdepasse = md5($motdepasse);
		}
	
		public function create(){
			$verif;
			$_identifiant = htmlentities(addslashes($this->_identifiant));
			$_email = htmlentities(addslashes($this->_email));
			$_motdepasse = htmlentities(addslashes($this->_motdepasse));
			$_rang = htmlentities(addslashes($this->_rang));
			$_telephone = htmlentities(addslashes($this->_telephone));
			$_steam = htmlentities(addslashes($this->_steam));
			$_banni = htmlentities(addslashes($this->_banni));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "INSERT INTO ".getNomBaseSQL().".utilisateurs VALUES (
					'0', 
					'".$_identifiant."',  
					'".$_email."', 
					'".$_motdepasse."', 
					'".$_rang."', 
					'".$_telephone."', 
					'".$_steam."', 
					'".$_banni."'
					)");
				closeSQL($con);
			}
			return $verif;
		}

		public function update(){
			$verif;
			$_identifiant = htmlentities(addslashes($this->_identifiant));
			$_email = htmlentities(addslashes($this->_email));
			$_motdepasse = htmlentities(addslashes($this->_motdepasse));
			$_rang = htmlentities(addslashes($this->_rang));
			$_telephone = htmlentities(addslashes($this->_telephone));
			$_steam = htmlentities(addslashes($this->_steam));
			$_banni = htmlentities(addslashes($this->_banni));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET
					identifiant='".$_identifiant."', 
					email='".$_email."', 
					mot_de_passe='".$_motdepasse."', 
					rang='".$_rang."', 
					telephone='".$_telephone."', 
					steam='".$_steam."', 
					banni='".$_banni."' 
					WHERE id='".$this->getID()."'");
				closeSQL($con);
			}
			return $verif;
		}

		public function get(){
			$verif;
			if($con = connectSQL()){
				$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".utilisateurs WHERE id=".$this->getID());
				if($verif == true){
				  	while($donnees = mysqli_fetch_array($verif))
					{
						$this->_identifiant = $donnees['identifiant'];
						$this->_email = $donnees['email'];
						$this->_motdepasse = $donnees['mot_de_passe'];
						$this->_rang = $donnees['rang'];
						$this->_steam = $donnees['steam'];
						$this->_telephone = $donnees['telephone'];
						$this->_banni = $donnees['banni'];
					}
			 	}
				closeSQL($con);
			}
			return $verif;
		}
	
		public function getID(){
			return $this->_id;
		}
		
	}

	function getAllUsers(){
		return getAllUsersWithQuery("SELECT * FROM ".getNomBaseSQL().".utilisateurs");
	}

	function getAllUsersWithQuery($query){
		$array = array();
		if($con = connectSQL()){
			$retour = mysqli_query($con, $query);
			if($retour == true){
			  	while($donnees = mysqli_fetch_array($retour))
				{	
					$com = new User($donnees['id']);
					$com->get();
					$array[] = $com;
				}
		 	}
			closeSQL($con);
		}
		return $array;
	}

	function userExist($identifiant, $email){
		$exist = false;
		if($con = connectSQL()){
			$retour = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".utilisateurs WHERE identifiant='".$identifiant."' OR email='".$email."'");
			if($retour == true)
			{
			  	while($donnees = mysqli_fetch_array($retour))
				{
					$exist = true;
					break;
				}
			}
			closeSQL($con);
		}
		return $exist;
	}

	function registerUser($identifiant, $email, $mdp, $telephone, $steam)
	{
		if(userExist($identifiant, $email) != 1){
			$user = new User(0);
			$user->addDefault($identifiant, $email, $mdp);
			$user->_telephone=$telephone;
			$user->_steam=$steam;
			$user->_rang=0;
			$user->_banni=0;
			$return = $user->create();
			return $return;
		}
		return false;
	}
	
	function connectUser($identifiant, $mdp)
	{
		$return = false;

		if(userExist($identifiant, $identifiant)){
			$identifiant = htmlentities(addslashes($identifiant));
			$mdp = htmlentities(addslashes($mdp));

			if($con = connectSQL())
			{
				$retour = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".utilisateurs WHERE identifiant='".$identifiant."' OR email='".$identifiant."'");
				if($retour == true)
				{
				  	while($donnees = mysqli_fetch_array($retour))
					{
						if(md5($mdp) == $donnees['mot_de_passe'])
						{
							$return = true;
							$_SESSION['ID'] = $donnees['id'];
							$_SESSION['Identifiant'] = $donnees['identifiant'];
							$_SESSION['Email'] = $donnees['email'];
							$_SESSION['MDP'] = $donnees['mot_de_passe'];
							$_SESSION['Banni'] = $donnees['banni'];
							$_SESSION['Rang'] = $donnees['rang'];
							$h = hash('sha512', '81XkJ40Pnh97tydsm1RFw'.session_id().$_SERVER['REMOTE_ADDR'].'VASDx4r3762Ni2fbjZY');
							$_SESSION['PHPSESSID_control'] = $h;
						}
					}
			 	}
				closeSQL($con);
			}
		}

		return $return;
	}

	function isConnect()
	{
		if(isset($_SESSION['Email']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function updateUser()
	{
		if(isConnect())
		{
			$return = false;
			if($con = connectSQL())
			{

				$retour = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".utilisateurs WHERE id='".$_SESSION['ID']."'");
				if($retour == true)
				{
				  	while($donnees = mysqli_fetch_array($retour))
					{
						$_SESSION['ID'] = $donnees['id'];
						$_SESSION['Identifiant'] = $donnees['identifiant'];
						$_SESSION['Email'] = $donnees['email'];
						$_SESSION['MDP'] = $donnees['mot_de_passe'];
						$_SESSION['Banni'] = $donnees['banni'];
						$_SESSION['steam'] = $donnees['steam'];
						$_SESSION['telephone'] = $donnees['telephone'];
						$_SESSION['Rang'] = $donnees['rang'];
					}
					$return = true;
			 	}
				closeSQL($con);
			}
		}
	}

	function getID()
	{ 
		if(isset($_SESSION['ID']))
		{
			return $_SESSION['ID'];
		}
	}

	function getIdentifiant()
	{
		if(isset($_SESSION['Identifiant']))
			return $_SESSION['Identifiant'];
		else
			return "";
	}

	function getEmail()
	{
			if(isset($_SESSION['Email']))
			return $_SESSION['Email'];
		else
			return "";
	}

	function getTelephone()
	{
			if(isset($_SESSION['telephone']))
			return $_SESSION['telephone'];
		else
			return "";
	}

	function getSteam()
	{
			if(isset($_SESSION['steam']))
			return $_SESSION['steam'];
		else
			return "";
	}

	function getMDP()
	{
			if(isset($_SESSION['MDP']))
			return $_SESSION['MDP'];
		else
			return "";
	}

	function verifSessionController()
	{
		$return = true;
		if(!isset($_SESSION['PHPSESSID_control']))
		{
			session_regenerate_id();
			$h = hash('sha512', '81XkJ40Pnh97tydsm1RFw'.session_id().$_SERVER['REMOTE_ADDR'].'VASDx4r3762Ni2fbjZY');
			$_SESSION['PHPSESSID_control'] = $h;
			$return = false;
		}
			if(hash('sha512', '81XkJ40Pnh97tydsm1RFw'.session_id().$_SERVER['REMOTE_ADDR'].'VASDx4r3762Ni2fbjZY') != $_SESSION['PHPSESSID_control'])		
			{
				session_destroy();
			}
		return $return;
	}

	function isBanni()
	{
		if(isset($_SESSION['Banni']))
		{
			if($_SESSION['Banni'] == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
			return false;
	}

	function isTimeout()
	{
		$return = false;
		if(isset($_SESSION['timeout']))
	    {
	      	$timeout = $_SESSION['timeout'];
	     	if(round(microtime(true) * 1000) > ($timeout + ((60*60)*1000)))
	      	{
	      		$return = true;
	      	}
	    }
	    $_SESSION['timeout'] = round(microtime(true) * 1000);

	    return $return;
	}

	function getRang()
	{
		if(isset($_SESSION['Rang']))
			return $_SESSION['Rang'];
		else
			return 0;
	}

	function getRangNameByID($id){
		$grade = new Grade($id);
		$grade->get();
		return $grade->getName();
	}

	function getRangName(){
		return getRangNameByID(getRang());
	}

	function hasRang($rankid){
		return getRang() == $rankid;
	}

	function hasPermission($perm, $die){
		$rang = new Grade(getRang());
		$rang->get();
		$return = $rang->hasPermission($perm);
		if($die && !$return){
			if(isConnect()){
				header("Location: index.php?p=compte&n=8");
			}else{
				header("Location: index.php?p=connexion&n=8");
			}
			die();	
		}
		return $return;
	}

	function setIdentifiant($identifiant)
	{
		$identifiant = htmlentities(addslashes($identifiant));
		if(isConnect())
		{
			if($con = connectSQL())
			{	
				$update_sql = mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET identifiant='".$identifiant."' WHERE id='".getID()."'");
				$_SESSION['Identifiant'] = $identifiant;
				closeSQL($con);
			}
		}
	}

	function setEmail($email)
	{
		$email = htmlentities(addslashes($email));
		if(isConnect())
		{
			if($con = connectSQL())
			{	
				$update_sql =  mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET email='".$email."' WHERE id='".getID()."'");
				$_SESSION['Email'] = $email;
				closeSQL($con);
			}
		}
	}

	function setTelephone($telephone)
	{
		$telephone = htmlentities(addslashes($telephone));
		if(isConnect())
		{
			if($con = connectSQL())
			{	
				$update_sql =  mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET telephone='".$telephone."' WHERE id='".getID()."'");
				$_SESSION['telephone'] = $telephone;
				closeSQL($con);
			}
		}
	}

	function setSteam($steam)
	{
		$steam = htmlentities(addslashes($steam));
		if(isConnect())
		{
			if($con = connectSQL())
			{	
				$update_sql =  mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET steam='".$steam."' WHERE id='".getID()."'");
				$_SESSION['steam'] = $telephone;
				closeSQL($con);
			}
		}
	}



	function setMotDePasse($mdp)
	{
		$mdp = htmlentities(addslashes($mdp));
		if(isConnect())
		{
			if($con = connectSQL())
			{	
				$update_sql = mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET mot_de_passe='".md5($mdp)."' WHERE id='".getID()."'");
				$_SESSION['MDP'] = md5($mdp);
				closeSQL($con);
			}
		}
	}

	function setBanni($banni)
	{
		$banni = htmlentities(addslashes($banni));
		if(isConnect())
		{
			if($con = connectSQL())
			{	
				$update_sql = mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET banni='".$banni."' WHERE id='".getID()."'");
				$_SESSION['Banni'] = $banni;
				closeSQL($con);
			}
		}
	}

	function setRang($rang)
	{
		$rang = htmlentities(addslashes($rang));
		if(isConnect())
		{
			if($con = connectSQL())
			{	
				$update_sql = mysqli_query($con, "UPDATE ".getNomBaseSQL().".utilisateurs SET rang='".$rang."' WHERE id='".getID()."'");
				$_SESSION['Rang'] = $rang;
				closeSQL($con);
			}
		}
	}

?>