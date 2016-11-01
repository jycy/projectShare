<?php
require_once('./controleur/Action.interface.php');
class UpdaterAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connecte"]))
			return "login";
		
		

		if(ISSET($_REQUEST["update"]) && $_REQUEST["update"] == 'valide'){


			if ($_FILES['miniatureup']['tmp_name'] != null) {
				$allowed = array('jpg','jpeg','png','gif');
				$ext = strtolower(pathinfo($_FILES['miniatureup']['name'], PATHINFO_EXTENSION));
	            if ((!in_array($ext, $allowed)) || ($_FILES['miniatureup']['size'] > 2097152)) {
					$_REQUEST["CreateError"]["miniatureup"] = true;
					return "createNewProjet";
				}
					$titre = addslashes(pathinfo($_FILES['miniatureup']['name'], PATHINFO_FILENAME));			//FONCTIONNE PAS DU TOUT NI LE IF NI LE ELSE
					$size = getimagesize($_FILES['miniatureup']['tmp_name']);
					$format = $size['mime'];
	    			//$image = $_FILES['miniature']['tmp_name'];
	    			$image = fopen($_FILES['miniatureup']['tmp_name'], 'rb');
	    			$phdao = new PhotoDAO();
	    			$phdao->deleteMiniature($_REQUEST["projetid"]);
					$miniature = new Photo();
					$miniature->setProjetId($_REQUEST["projetid"]);
					$miniature->setTitre($titre);
					$miniature->setPhoto($image);
					$miniature->setType("miniature");
	        		$miniature->setExtension($format);
	            	$phdao->upload($miniature);
			}
			else header("location:./?action=visiter&pageCommentaire=0&erreur=pasdimage&projetid=".$_REQUEST["projetid"]."");


			if (($_REQUEST["Introduction"] != "") || ($_REQUEST["Description"] != "")) {
				require_once('./modele/classes/Projet.class.php');
				require_once('./modele/ProjetDAO.class.php');
				$projet = new Projet();
				$projet->setIntroduction($_REQUEST["Introduction"]);
				$projet->setDescription($_REQUEST["Description"]);
				$projet->setId($_REQUEST["projetid"]);
				$pdao = new ProjetDAO();
				$pdao->update($projet);
			}
			if ($_REQUEST["video"] != ""){
				require_once('./modele/VideoDAO.class.php');
				require_once('./modele/classes/Video.class.php');
				$video = new Video();
				$video->setUrl($_REQUEST["video"]);
				$video->setProjetId($_REQUEST["projetid"]);
				$vdao = new VideoDAO();
				$vdao->update($video);
			}
				
			if ($_REQUEST["reseauInput"] != ""){
				require_once('./modele/classes/reseau.class.php');
				require_once('./modele/classes/reseau_projet.class.php');
				$resdao = new reseauDAO();
				$r = $resdao->findByUrl($_REQUEST["reseauInput"]);
				if ($r == null)
				{
					$res = new Reseau();
					$res->setType($_REQUEST["reseau"]);
					$res->setUrl($_REQUEST["reseauInput"]);
					$resdao->create($res);
					$r = $resdao->findByUrl($_REQUEST["reseauInput"]);
				}
				$rp = new Reseau_projet();
				$rp->setReseauId($r->getId());
				$rp->setProjetId($_REQUEST["projetid"]);
				$resdao->update($rp);
			}		
			header("location:./?action=visiter&pageCommentaire=0&updatesuccess=true&projetid=".$_REQUEST["projetid"]."");
		}
		else {
			$_REQUEST["projid"]=$_REQUEST["projetid"];
			return "UpdateProjet";
			header("location:./?action=visiter&pageCommentaire=0&projetid=".$_REQUEST["projetid"]."");
		}
		
	}
}
?>