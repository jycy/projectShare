<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/ProjetDAO.class.php');
class AfficherAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connecte"]))
			return "login";
		if (ISSET($_REQUEST["pageProjet"]))
		{
			$pjdao = new ProjetDAO();
			$count = $pjdao->Pcount();
			$_SESSION["nbpages"]= ceil($count/16);
		}
		return "afficher";
	}
}
?>