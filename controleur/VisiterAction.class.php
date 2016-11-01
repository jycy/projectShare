<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/CommentaireDAO.class.php');
class VisiterAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connecte"]))
			return "login";
		return "visiterProjet";
	}
}
?>