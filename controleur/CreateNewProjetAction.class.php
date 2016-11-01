<?php
require_once('./controleur/Action.interface.php');
class CreateNewProjetAction implements Action {
	public function execute(){
		if (!ISSET($_SESSION)) session_start();
		if (!ISSET($_SESSION["connecte"]))
			return "login";
		if ((!ISSET($_REQUEST["newProjet"])) || (!ISSET($_REQUEST["Introduction"])) || (!ISSET($_REQUEST["Description"])) || (!ISSET($_REQUEST["video"])))
			return "createNewProjet";
		if ($_REQUEST["newProjet"] == ""){
			$_REQUEST["CreateError"]["newProjet"] = true;
			return "createNewProjet";
		}
		if ($_REQUEST["Introduction"] == ""){
			$_REQUEST["CreateError"]["Introduction"] = true;
			return "createNewProjet";
		}
		if ($_REQUEST["Description"] == ""){
			$_REQUEST["CreateError"]["Description"] = true;
			return "createNewProjet";
		}
		if ($_REQUEST["video"] == ""){
			$_REQUEST["CreateError"]["video"] = true;
			return "createNewProjet";
		}
		if ($_FILES['miniature']['tmp_name'] != null) {
			$allowed = array('jpg','jpeg','png','gif');
			$ext = strtolower(pathinfo($_FILES['miniature']['name'], PATHINFO_EXTENSION));
            if ((!in_array($ext, $allowed)) || ($_FILES['miniature']['size'] > 2097152)) {
				$_REQUEST["CreateError"]["miniature"] = true;
				return "createNewProjet";
			}
		}
		require_once('./modele/ProjetDAO.class.php');
		require_once('./modele/PhotoDAO.class.php');
		require_once('./modele/VideoDAO.class.php');
		require_once('./modele/reseauDAO.class.php');

		$pdao = new ProjetDAO();
		$proj = $pdao->findByName($_REQUEST["newProjet"]);
		if ($proj == null)
			{
				require_once('./modele/classes/Projet.class.php');
				require_once('./modele/classes/Video.class.php');
				require_once('./modele/classes/Photo.class.php');
				$projet = new Projet();
				$projet->setName($_REQUEST["newProjet"]);
				$projet->setIntroduction($_REQUEST["Introduction"]);
				$projet->setUserId($_SESSION["idConnecte"]);
				$projet->setDescription($_REQUEST["Description"]);
				if ($_FILES['miniature']['tmp_name'] != null) {
					$titre = addslashes(pathinfo($_FILES['miniature']['name'], PATHINFO_FILENAME));
					$size = getimagesize($_FILES['miniature']['tmp_name']);
					$format = $size['mime'];
    				//$image = $_FILES['miniature']['tmp_name'];
    				$image = fopen($_FILES['miniature']['tmp_name'], 'rb');
				}
				$pdao->create($projet);
				$p = $pdao->findByName($_REQUEST["newProjet"]);
				$viddao = new VideoDAO();
				$video = new Video();
				$video->setProjetId($p->getId());
				$video->setUrl($_REQUEST["video"]);
				$viddao->create($video);
				$pdao = new PhotoDAO();
				$miniature = new Photo();
				$miniature->setProjetId($p->getId());
				$miniature->setTitre($titre);
				$miniature->setPhoto($image);
				$miniature->setType("miniature");
        		$miniature->setExtension($format);
            	$pdao->upload($miniature);
				
				if ($_REQUEST["reseauInput"] != "")
					{
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
						$rp->setProjetId($p->getId());
						$rp->setUserId($_SESSION["idConnecte"]);
						$resdao->createReseauProjet($rp);
					}		
				header("location:./?action=visiter&pageCommentaire=0&projetid=".$p->getId()."");
			}
		return "createNewProjet";
	}
}
?>