<?php
	class Permission{
		public $_id;
		public $_name;
		
		public function __construct($id){
			$this->_id = $id;
		}

		public function addDefault($_name){
			$this->_name = $_name;
		}
	
		public function create(){
			$_name = htmlentities(addslashes($this->_name));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "INSERT INTO ".getNomBaseSQL().".permissions VALUES (
					'0', 
					'".$_name."'
					)");
				closeSQL($con);
			}
		}

		public function update(){
			$_name = htmlentities(addslashes($this->_name));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "UPDATE ".getNomBaseSQL().".permissions SET
					name='".$_name."'
					WHERE id='".$this->getID()."'");
				closeSQL($con);
			}
		}

		public function get(){
			if($con = connectSQL()){
				$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".permissions WHERE id=".$this->getID());
				if($verif == true){
				  	while($donnees = mysqli_fetch_array($verif))
					{
						$this->_name = $donnees['name'];
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
		
	}

	function getAllPermissions(){
		$array = array();
		if($con = connectSQL()){
			$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".permissions");
			if($verif == true){
			  	while($donnees = mysqli_fetch_array($verif))
				{	
					$com = new Permission($donnees['id']);
					$com->get();
					$array[] = $com;
				}
		 	}
			closeSQL($con);
		}
		return $array;
	}

?> 