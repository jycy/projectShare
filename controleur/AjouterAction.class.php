<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/PhotoDAO.class.php');
require_once('./modele/classes/Photo.class.php');
class AjouterAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connecte"]))
			return "login";
		if (!ISSET($_REQUEST["projetid"]))
			header("Location: ./?action=visiter&pageCommentaire=0&erreur=1&projetid=".$_REQUEST["projetid"]);
		if ($_FILES['photoprojet']['tmp_name'] != null) {
			$allowed = array('jpg','jpeg','png','gif');
			$ext = strtolower(pathinfo($_FILES['photoprojet']['name'], PATHINFO_EXTENSION));
            if ((!in_array($ext, $allowed)) || ($_FILES['photoprojet']['size'] > 2097152)) {
				$_REQUEST["CreateError"]["photoprojet"] = true;
				header("Location: ./?action=visiter&pageCommentaire=0&erreur=1&projetid=".$_REQUEST["projetid"]);
			}
		}
		if ($_FILES['photoprojet']['tmp_name'] != null) {
				$titre = addslashes(pathinfo($_FILES['photoprojet']['name'], PATHINFO_FILENAME));
				$size = getimagesize($_FILES['photoprojet']['tmp_name']);
				$format = $size['mime'];
    			//$image = $_FILES['miniature']['tmp_name'];
    			$image = fopen($_FILES['photoprojet']['tmp_name'], 'rb');
		}
		$pdao = new PhotoDAO();
		$photopro = new Photo();
		$photopro->setProjetId($_REQUEST["projetid"]);
		$photopro->setTitre($titre);
		$photopro->setPhoto($image);
		$photopro->setType("PROJETPHOTO");
        $photopro->setExtension($format);
        $pdao->upload($photopro);
		header("Location: ./?action=visiter&pageCommentaire=0&projetid=".$_REQUEST["projetid"]);
	}
}
?>