<?php
	class Notification{
		private $_style;
		private $_title;
		private $_text;
		
		public function __construct($style, $title, $text){
			$this->_style = $style;
			$this->_title = $title;
			$this->_text = $text;
		}

		public function getStyle(){
			return $this->_style;
		}
		
		public function getTitle(){
			return $this->_title;
		}
		
		public function getText(){
			return $this->_text;
		}	
	}

	function getNotification($id){
		switch($id){
			case 1:
				return new Notification("
					warning", 
					"Impossible de ce connecter a la base de donnée.", 
					"La connexion a la base de donnée a été refusé.. Veuillez contacter l'administrateur du site web.");
			case 2:
				return new Notification(
				"error",
				 "Identifiant ou mot de passe incorect.",
				 "Vous avez perdu le mot de passe ? Contacter un administrateur pour le changer.");
			case 3:
				return new Notification(
				"info",
				 "Vous avez été déconnecté",
				 "Vous avez été deconnecté du serveur."
				 );
			case 4:
				return new Notification(
				"success",
				 "Vous avez bien été déconnecté",
				 "Vous avez été deconnecté"
				 );
			case 5:
				return new Notification(
				"info",
				 "Vous avez été déconnecté",
				 "Vous avez été deconnecté pour inactivité."
				 );
			case 6:
				return new Notification(
				"info",
				 "Vous avez été déconnecté",
				 "Vous avez été deconnecté car vous avez été banni."
				 );
			case 7:
				return new Notification(
				"error",
				 "Vous êtes banni",
				 "Vous ne pouvez pas vous connecter car vous êtes banni du site."
				 );
			case 8:
				return new Notification(
				"info",
				 "Problème de permission",
				 "Vous n'avez pas la permission d'accéder à cette page."
				 );
			case 9:
				return new Notification(
				"error",
				 "Utilisateur déjà existant.",
				 "Cet utilisateur possede déjà un compte."
				 );
			case 10:
				return new Notification(
				"success",
				 "Modification effectuée.",
				 "La modification s'est déroulée avec succés."
				 );
			case 11:
				return new Notification(
				"success",
				 "Supression effectuée.",
				 "La suppression s'est déroulée avec succés."
				 );
			case 12:
				return new Notification(
				"error",
				 "Mot de Passe incorrect",
				 "Le mot de passe est incorrecte."
				 );
			case 13:
				return new Notification(
				"error",
				 "Email incorect",
				 "Vous devez tapez un email valide."
				 );
			case 14:
				return new Notification(
				"success",
				 "Vous avez changeé votre email",
				 "Votre email a bien été changé."
				 );
			case 15:
				return new Notification(
				"success",
				 "Vous êtes connecté",
				 "Vous êtes bien connecté."
				 );
			case 16:
				return new Notification(
				"success",
				 "Vous avez changé votre mot de passe",
				 "Votre mot de passe a bien été changé."
				 );
			case 17:
				return new Notification(
				"error",
				 "Joueur introuvable",
				 "Le joueur que vous avez demandé est introuvable."
				 );
			case 18:
				return new Notification(
				"error",
				 "Membre introuvable",
				 "Le membre que vous avez demandé est introuvable."
				 );
			case 19:
				return new Notification(
				"success",
				 "Intégration réussie",
				 "L'intégration s'est déroulée avec succés."
				 );
			case 20:
				return new Notification(
				"error",
				 "Erreur lors de la creation du joueur",
				 "Impossible de créer le joueur"
				 );
			case 21:
				return new Notification(
				"error",
				 "Prenom & Nom déjà utilisé",
				 "Un joueur existe déjà avec ce prénom et ce nom."
				 );
			case 22:
				return new Notification(
				"error",
				 "GUID déjà utilisé",
				 "Un joueur existe déjà avec ce GUID."
				 );
			case 23:
				return new Notification(
				"success",
				 "Commentaire ajouté",
				 "Vous avez ajouté un commentaire sur ce joueur."
				 );
			case 24:
				return new Notification(
				"info",
				 "Permissions modifiées",
				 "Les permissions de ce grade ont bien été modifiées."
				 );
			case 25:
				return new Notification(
				"error",
				 "Les deux numérro ne correspondent pas",
				 "Vous devez mettres deux fois le même numéro."
				 );
			case 26:
				return new Notification(
				"success",
				 "Vous avez changeé votre numéro de telephone",
				 "Votre numéro de telephone a bien été changé."
				 );
		}
	}
?>