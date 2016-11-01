<?php
require_once('./controleur/Action.interface.php');
class CreateCommentaireAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connecte"]))
			return "login";
		if (!ISSET($_REQUEST["commentaire"]))
			header("Location: ./?action=visiter&pageCommentaire=0&projetid=".$_REQUEST["projetid"]."");
		if ($_REQUEST["commentaire"] == "")
			header("Location: ./?action=visiter&pageCommentaire=0&projetid=".$_REQUEST["projetid"]."");
		require_once('./modele/CommentaireDAO.class.php');
		$cdao = new CommentaireDAO();
		require_once('./modele/classes/Commentaire.class.php');
		$commentaire = new Commentaire();
		$commentaire->setProjetId($_REQUEST["projetid"]);
		$commentaire->setUser($_SESSION["connecte"]);
		$commentaire->setMessage(addslashes($_REQUEST["commentaire"]));
		$cdao->create($commentaire);
		header("Location: ./?action=visiter&pageCommentaire=0&projetid=".$_REQUEST["projetid"]."");
	}
}
?>