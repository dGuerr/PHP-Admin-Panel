<?php

	/*
		A FAIRE
		 REGARDE LES MODELS DE USER
	*/
	class Joueur{
		public $_id;
		public $_guid;
		public $_prenomRP;
		public $_nomRP;
		public $_twitch;
		public $_forum;
		public $_moderateur;
		public $_ancien_noms;
		public $_date;
		public $_commentaire;
		public $_groupe;
		public $_gradeFaily;
		public $_slot;
		public $_absent;
		public $_avertissement;
		public $_ban;
		public $_age;
	
		public function __construct($id){
			$this->_id = $id;
		}

		public function addDefault($guid, $prenomRP, $nomRP){
			$this->_guid = $guid;
			$this->_prenomRP = $prenomRP;
			$this->_nomRP= $nomRP;
		}

		public function exist(){
			$exist = "";
			if($con = connectSQL()){
				$retour = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".joueurs WHERE nomRP='".$this->_nomRP."' AND prenomRP='".$this->_prenomRP."'");
				if($retour == true)
				{
				  	while($donnees = mysqli_fetch_array($retour))
					{
						$exist = "nom";
						break;
					}
				}
				$retour = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".joueurs WHERE guid='".$this->_guid."'");
				if($retour == true)
				{
				  	while($donnees = mysqli_fetch_array($retour))
					{
						$exist = "guid";
						break;
					}
				}
				closeSQL($con);
			}
		return $exist;
		}
	
		public function create(){
			$verif;
			$_guid = htmlentities(addslashes($this->_guid));
			$_prenomRP = htmlentities(addslashes($this->_prenomRP));
			$_nomRP = htmlentities(addslashes($this->_nomRP));
			$_twitch = htmlentities(addslashes($this->_twitch));
			$_forum = htmlentities(addslashes($this->_forum));
			$_moderateur = htmlentities(addslashes($this->_moderateur));
			$_ancien_noms = htmlentities(addslashes($this->_ancien_noms));
			$_date = htmlentities(addslashes($this->_date));
			$_commentaire = htmlentities(addslashes($this->_commentaire));
			$_groupe = htmlentities(addslashes($this->_groupe));
			$_gradeFaily = htmlentities(addslashes($this->_gradeFaily));
			$_slot = htmlentities(addslashes($this->_slot));
			$_absent = htmlentities(addslashes($this->_absent));
			$_avertissement = htmlentities(addslashes($this->_avertissement));
			$_ban = htmlentities(addslashes($this->_ban));
			$_age = htmlentities(addslashes($this->_age));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "INSERT INTO ".getNomBaseSQL().".joueurs VALUES (
					'0', 
					'".$_guid."',  
					'".$_prenomRP."', 
					'".$_nomRP."', 
					'".$_twitch."', 
					'".$_forum."', 
					'".$_moderateur."', 
					'".$_ancien_noms."',  
					'".$_date."', 
					'".$_commentaire."', 
					'".$_groupe."', 
					'".$_gradeFaily."', 
					'".$_slot."', 
					'".$_absent."', 
					'".$_avertissement."', 
					'".$_ban."', 
					'".$_age."'
					)");
				closeSQL($con);
			}
			return $verif;
		}

		public function update(){
			$verif;
			$_guid = htmlentities(addslashes($this->_guid));
			$_prenomRP = htmlentities(addslashes($this->_prenomRP));
			$_nomRP = htmlentities(addslashes($this->_nomRP));
			$_twitch = htmlentities(addslashes($this->_twitch));
			$_forum = htmlentities(addslashes($this->_forum));
			$_moderateur = htmlentities(addslashes($this->_moderateur));
			$_ancien_noms = htmlentities(addslashes($this->_ancien_noms));
			$_date = htmlentities(addslashes($this->_date));
			$_commentaire = htmlentities(addslashes($this->_commentaire));
			$_groupe = htmlentities(addslashes($this->_groupe));
			$_gradeFaily = htmlentities(addslashes($this->_gradeFaily));
			$_slot = htmlentities(addslashes($this->_slot));
			$_absent = htmlentities(addslashes($this->_absent));
			$_avertissement = htmlentities(addslashes($this->_avertissement));
			$_ban = htmlentities(addslashes($this->_ban));
			$_age = htmlentities(addslashes($this->_age));
			
			if($con = connectSQL()){
				$verif = mysqli_query($con, "UPDATE ".getNomBaseSQL().".joueurs SET
					guid='".$_guid."', 
					prenomRP='".$_prenomRP."', 
					nomRP='".$_nomRP."', 
					twitch='".$_twitch."', 
					forum='".$_forum."', 
					moderateur='".$_moderateur."', 
					ancien_noms='".$_ancien_noms."', 
					date='".$_date."', 
					commentaire='".$_commentaire."', 
					groupe='".$_groupe."', 
					gradeFaily='".$_gradeFaily."', 
					slot='".$_slot."', 
					absent='".$_absent."', 
					avertissement='".$_avertissement."', 
					ban='".$_ban."', 
					age='".$_age."'
					WHERE id='".$this->getID()."'");
				closeSQL($con);
			}
			return $verif;
		}

		public function get(){
			$verif;
			if($con = connectSQL()){
				$verif = mysqli_query($con, "SELECT * FROM ".getNomBaseSQL().".joueurs WHERE id=".$this->getID());
				if($verif == true){
				  	while($donnees = mysqli_fetch_array($verif))
					{
						$this->_guid = $donnees['guid'];
						$this->_prenomRP = $donnees['prenomRP'];
						$this->_nomRP = $donnees['nomRP'];
						$this->_twitch= $donnees['twitch'];
						$this->_forum = $donnees['forum'];
						$this->_moderateur = $donnees['moderateur'];
						$this->_ancien_noms = $donnees['ancien_noms'];
						$this->_date = $donnees['date'];
						$this->_commentaire = $donnees['commentaire'];
						$this->_groupe = $donnees['groupe'];
						$this->_gradeFaily = $donnees['gradeFaily'];
						$this->_slot = $donnees['slot'];
						$this->_absent = $donnees['absent'];
						$this->_avertissement = $donnees['avertissement'];
						$this->_ban = $donnees['ban'];
						$this->_age = $donnees['age'];
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

	function getAllJoueurs(){
		return getAllUsersWithQuery("SELECT * FROM ".getNomBaseSQL().".joueurs");
	}

	function getAllJoueursWithQuery($query){
		$array = array();
		if($con = connectSQL()){
			$verif = mysqli_query($con, $query);
			if($verif == true){
			  	while($donnees = mysqli_fetch_array($verif))
				{	
					$com = new Joueur($donnees['id']);
					$com->get();
					$array[] = $com;
				}
		 	}
			closeSQL($con);
		}
		return $array;
	}

?> 