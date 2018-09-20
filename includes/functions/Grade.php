<?php
	class Grade{
		public $_id;
		public $_name;
		public $_permissions;
		
		public function __construct($id){
			$this->_id = $id;
		}

		public function addDefault($_name, $_permissions){
			$this->_name = $_name;
			$this->_permissions = $_permissions;
		}
	
		public function create(){
			$_name = htmlentities(addslashes($this->_name));
			$_permissions = htmlentities(addslashes($this->_permissions));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "INSERT INTO ".getNomBaseSQL().".grades VALUES (
					'0', 
					'".$_name."', 
					'".$_permissions."'
					)");
				closeSQL($con);
			}
		}

		public function update(){
			$_name = htmlentities(addslashes($this->_name));
			$_permissions = htmlentities(addslashes($this->_permissions));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "UPDATE ".getNomBaseSQL().".grades SET
					name='".$_name."', 
					permissions='".$_permissions."'
					WHERE id='".$this->getID()."'");
				closeSQL($con);
			}
		}

		public function get(){
			if($con = connectSQL()){
				$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".grades WHERE id=".$this->getID());
				if($verif == true){
				  	while($donnees = mysqli_fetch_array($verif))
					{
						$this->_name = $donnees['name'];
						$this->_permissions = $donnees['permissions'];
					}
			 	}
				closeSQL($con);
			}
		}
	
		public function getID(){
			return $this->_id;
		}
		
		public function getName(){
			return $this->_name;
		}
				
		public function getPermissions(){
			return $this->_permissions;
		}

		public function hasPermission($id){
			return stristr($this->getPermissions(), "-".$id."-") || stristr($this->getPermissions(), "*");
		}
		
	}

	function getAllGrades(){
		$array = array();
		if($con = connectSQL()){
			$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".grades");
			if($verif == true){
			  	while($donnees = mysqli_fetch_array($verif))
				{	
					$com = new Grade($donnees['id']);
					$com->get();
					$array[] = $com;
				}
		 	}
			closeSQL($con);
		}
		return $array;
	}

	

?> 