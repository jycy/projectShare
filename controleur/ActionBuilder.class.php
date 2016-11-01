<?php
require_once('./controleur/CreateNewAccountAction.class.php');
require_once('./controleur/CreateNewProjetAction.class.php');
require_once('./controleur/DefaultAction.class.php');
require_once('./controleur/AfficherAction.class.php');
require_once('./controleur/AjouterAction.class.php');
require_once('./controleur/SupprimerAction.class.php');
require_once('./controleur/LoginAction.class.php');
require_once('./controleur/LogoutAction.class.php');
require_once('./controleur/VisiterAction.class.php');
require_once('./controleur/VisiterProfilAction.class.php');
require_once('./controleur/CreateCommentaireAction.class.php');
require_once('./controleur/UpdaterAction.class.php');

class ActionBuilder{
	public static function getAction($nom){
		switch ($nom)
		{
			case "createnewcommentaire" :
				return new CreateCommentaireAction();
			break;
			case "createnewprojet" :
				return new CreateNewProjetAction();
			break; 
			case "visiterprofil" :
				return new VisiterProfilAction();
			break; 
			case "visiter" :
				return new VisiterAction();
			break; 
			case "createnewaccount" :
				return new CreateNewAccountAction();
			break; 
			case "connecter" :
				return new LoginAction();
			break; 
			case "deconnecter" :
				return new LogoutAction();
			break; 
			case "afficher" :
				return new AfficherAction();
			break; 
			case "ajouter" :
				return new AjouterAction();
			break; 
			case "supprimer" :
				return new SupprimerAction();
			break; 
			case "updater" :
				return new UpdaterAction();
			break;
			default :
				return new DefaultAction();
		}
	}
}
?>
