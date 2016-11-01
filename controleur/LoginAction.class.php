<?php
require_once('./controleur/Action.interface.php');
class LoginAction implements Action {
	public function execute(){
		if (!ISSET($_REQUEST["User"]))
			return "login";
			

		

		require_once('./modele/UserDAO.class.php');
		$udao = new UserDAO();
		$user = $udao->find($_REQUEST["User"]);
		if ($user == null)
			{
				$_REQUEST["field_messages"]["username"] = true;	
				return "login";
				

			}
		else if ($user->getPassword() != $_REQUEST["Pass"])
			{
				$_REQUEST["field_messages"]["password"] = true;	
				return "login";
				

			}
		if (!ISSET($_SESSION)) session_start();
		$_SESSION["connecte"] = $_REQUEST["User"];
		$_SESSION["idConnecte"] = $user->getId();
		header('location: ./?action=afficher&pageCommentaire=0&pageProjet=0');
	}
}
?>