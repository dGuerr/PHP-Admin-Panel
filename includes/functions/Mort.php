<?php
	class Mort{
		public $_id;
		public $_victime_name;
		public $_victime_uid;
		public $_killer_name;
		public $_killer_uid;
		public $_death_by;
		public $_kill_time;
		
		public function __construct($id){
			$this->_id = $id;
		}

		public function get(){
			if($con = connectSQL()){
				$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".kill_log WHERE id=".$this->getID());
				if($verif == true){
				  	while($donnees = mysqli_fetch_array($verif))
					{
						$this->_victime_name = $donnees['victime_name'];
						$this->_victime_uid = $donnees['victime_uid'];
						$this->_killer_name = $donnees['killer_name'];
						$this->_killer_uid = $donnees['killer_uid'];
						$this->_death_by = $donnees['death_by'];
						$this->_kill_time = $donnees['kill_time'];
					}
			 	}
				closeSQL($con);
			}
		}
	
		public function getID(){
			return $this->_id;
		}
		
		public function getVictimeName(){
			return $this->_victime_name;
		}
		
		public function getVictimeUID(){
			return $this->_victime_uid;
		}

		public function getKillerName(){
			return $this->_killer_name;
		}
		
		public function getKillerUID(){
			return $this->_killer_uid;
		}

		public function getReason(){
			return $this->_death_by;
		}
		
		public function getDate(){
			return $this->_kill_time;
		}
		
	}

	function getAllMorts(){
		return getAllMortsWithQuery("SELECT * FROM ".getNomBaseSQL().".kill_log");
	}

	function getAllMortsWithQuery($query){
		$array = array();
		if($con = connectSQL()){
			$verif = mysqli_query($con, $query);
			if($verif == true){
			  	while($donnees = mysqli_fetch_array($verif))
				{	
					$mort = new Mort($donnees['id']);
					$mort->get();
					$array[] = $mort;
				}
		 	}
			closeSQL($con);
		}
		usort($array, 'comparerMorts');
		return $array;
	}

	function comparerMorts($a, $b){
		//echo $a->getID()." > ".$b->getID()." = ".($a->getID() > $b->getID())."--------";
		return $a->getID() < $b->getID();
	}

	function getCountMorts(){
		$count = 0;
		if($con = connectSQL()){
			$verif = mysqli_query($con, "SELECT COUNT(id) FROM ".getNomBaseSQL().".kill_log");
			if($verif == true){
			  	if($donnees = mysqli_fetch_array($verif)){
			  		$count = $donnees['COUNT(id)'];
			  	}
		 	}
			closeSQL($con);
		}
		return $count;
	}

?> 