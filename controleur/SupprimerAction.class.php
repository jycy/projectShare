<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/classes/Projet.class.php');
require_once('./modele/classes/Photo.class.php');
require_once('./modele/classes/Commentaire.class.php');

require_once('./modele/classes/Video.class.php');

require_once('./modele/ProjetDAO.class.php');
require_once('./modele/reseauDAO.class.php');
require_once('./modele/classes/reseau.class.php');
require_once('./modele/CommentaireDAO.class.php');
require_once('./modele/VideoDAO.class.php');
require_once('./modele/PhotoDAO.class.php');

//peut etre à supprimer
require_once('./modele/classes/Liste.class.php');
require_once('./modele/classes/User.class.php');
require_once('./modele/UserDAO.class.php');

class SupprimerAction implements Action {
	public function execute()
	{
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connecte"]))
			return "login";

		//if (!ISSET($_REQUEST["projetid"]) || !ISSET($_REQUEST["photoid"]))
		//	header('Location: ./?action=afficher&pageCommentaire=0&pageProjet=0&erreur=1');
		if (ISSET($_REQUEST["projetid"]))
		{
			$pdao = new ProjetDAO();
			$proj = $pdao->find($_REQUEST["projetid"]);
			if ($proj == null) 
				header('Location: ./?action=afficher&pageCommentaire=0&pageProjet=0&erreur=2');
			elseif ($proj->getUserId() != $_SESSION["idConnecte"]) 
				header('Location: ./?action=afficher&pageCommentaire=0&pageProjet=0&erreur=3');
			else
			{
				$vdao = new VideoDAO();
				$phdao = new PhotoDAO();
				$rdao = new ReseauDAO();
				$cdao = new CommentaireDAO();
				$rdao->delete($proj->getId());
				$phdao->deleteAllByProj($proj);
				$vdao->delete($proj);
				$cdao->deleteAllByProj($proj);
				$pdao->delete($_REQUEST["projetid"]);
				header("Location: ./?action=visiterProfil&userVisitId=".$_SESSION["idConnecte"]."");
			}
		}
		elseif (ISSET($_REQUEST["photoid"]) && ISSET($_REQUEST["projid"])) 
		{
			$pdao = new ProjetDAO();
			$proj = $pdao->find($_REQUEST["projid"]);
			if ($proj == null) 
				header('Location: ./?action=visiter&pageCommentaire=0&erreur=4&projetid='.$_REQUEST["projid"]);
			elseif ($proj->getUserId() != $_SESSION["idConnecte"]) 
				header('Location: ./?action=visiter&pageCommentaire=0&erreur=5&projetid='.$_REQUEST["projid"]);
			else
			{
				$phdao = new PhotoDAO();
				$phdao->delete($_REQUEST["photoid"]);
				header('Location: ./?action=visiter&pageCommentaire=0&projetid='.$_REQUEST["projid"]);
			}
		}
		else header('Location: ./?action=afficher&pageCommentaire=0&pageProjet=0&erreur=1');

	}
}
?>