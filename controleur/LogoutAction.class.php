<?php
require_once('./controleur/Action.interface.php');
class LogoutAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		UNSET($_SESSION["connecte"]);
		UNSET($_SESSION["idConnecte"]);
		session_destroy();
		return "default";
	}
}
?>