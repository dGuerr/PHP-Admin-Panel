<?php
	class Commentaire{
		public $_id;
		public $_userID;
		public $_ownerID;
		public $_content;
		public $_date;
		
		public function __construct($id){
			$this->_id = $id;
		}

		public function addDefault($userID, $ownerID, $content){
			$this->_userID = $userID;
			$this->_ownerID = $ownerID;
			$this->_content= $content;
		}
	
		public function create(){
			$_userID = htmlentities(addslashes($this->_userID));
			$_ownerID = htmlentities(addslashes($this->_ownerID));
			$_content = htmlentities(addslashes($this->_content));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "INSERT INTO ".getNomBaseSQL().".commentaires VALUES (
					'0', 
					'".$_userID."', 
					'".$_ownerID."',
					'".date("Y-m-d H:i:s")."',
					'".$_content."'
					)");
				closeSQL($con);
			}
		}

		public function update(){
			$_userID = htmlentities(addslashes($this->_userID));
			$_ownerID = htmlentities(addslashes($this->_ownerID));
			$_date = htmlentities(addslashes($this->_date));
			$_content = htmlentities(addslashes($this->_content));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "UPDATE ".getNomBaseSQL().".commentaires SET
					UserID='".$_userID."', 
					OwnerID='".$_ownerID."',
					Date='".$_date."',
					Content='".$_content."'
					WHERE id='".$this->getID()."'");
				closeSQL($con);
			}
		}

		public function get(){
			if($con = connectSQL()){
				$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".commentaires WHERE id=".$this->getID());
				if($verif == true){
				  	while($donnees = mysqli_fetch_array($verif))
					{
						$this->_userID = $donnees['UserID'];
						$this->_ownerID = $donnees['OwnerID'];
						$this->_date = $donnees['Date'];
						$this->_content = $donnees['Content'];
					}
			 	}
				closeSQL($con);
			}
		}
	
		public function getID(){
			return $this->_id;
		}
		
		public function getUserID(){
			return $this->_userID;
		}
				
		public function getOwnerID(){
			return $this->_ownerID;
		}

		public function getContents(){
			return $this->_content;
		}
		
		public function getDate(){
			return $this->_date;
		}
		
	}

	function getAllCommentaire($userID){
		$array = array();
		if($con = connectSQL()){
			$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".commentaires WHERE UserID=".$userID);
			if($verif == true){
			  	while($donnees = mysqli_fetch_array($verif))
				{	
					$com = new Commentaire($donnees['id']);
					$com->get();
					$array[] = $com;
				}
		 	}
			closeSQL($con);
		}
		return $array;
	}

?> 