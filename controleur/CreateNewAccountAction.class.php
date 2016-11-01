<?php
require_once('./controleur/Action.interface.php');
class CreateNewAccountAction implements Action {
	public function execute(){
		if ((!ISSET($_REQUEST["newUser"])) || (!ISSET($_REQUEST["Pass"])) || (!ISSET($_REQUEST["ConfirmPass"])) || (!ISSET($_REQUEST["Email"])))
			return "createNewAccount";
		if ($_REQUEST["newUser"] == ""){
			$_REQUEST["CreateError"]["newUserName"] = true;
			return "createNewAccount";
		}
		if ($_REQUEST["Pass"] == ""){
			$_REQUEST["CreateError"]["Pass"] = true;
			return "createNewAccount";
		}
		if ($_REQUEST["ConfirmPass"] == ""){
			$_REQUEST["CreateError"]["ConfirmPass"] = true;
			return "createNewAccount";
		}
		if ($_REQUEST["Email"] == ""){
			$_REQUEST["CreateError"]["Email"] = true;
			return "createNewAccount";
		}
		if ($_FILES['avatar']['tmp_name'] != null) {
			$allowed = array('jpg','jpeg','png','gif');
			$ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            if ((!in_array($ext, $allowed)) || ($_FILES['avatar']['size'] > 2097152)) {
				$_REQUEST["CreateError"]["avatar"] = true;
				return "createNewAccount";
			}
		}
		require_once('./modele/UserDAO.class.php');
		$udao = new UserDAO();
		$user = $udao->find($_REQUEST["newUser"]);
		if ($user == null)
			{
				$userMail = $udao->findByEmail($_REQUEST["Email"]);
				if ($userMail == null){
					if ($_REQUEST["Pass"] == $_REQUEST["ConfirmPass"]){
						require_once('./modele/classes/User.class.php');
						$usr = new User();
						$usr->setUserName($_REQUEST["newUser"]);
						$usr->setPassword($_REQUEST["Pass"]);
						$usr->setAdresseCourriel($_REQUEST["Email"]);
						if ($_FILES['avatar']['tmp_name'] != null) {
							$size_original = getimagesize($_FILES['avatar']['tmp_name']);
        					$format = $size_original['mime'];
            				$imagecropped = new Imagick($_FILES['avatar']['tmp_name']);
            				$largeur_original = $size_original[0];
            				$hauteur_original = $size_original[1];
            				if ($largeur_original > $hauteur_original) {
				                $xPos = ($largeur_original-$hauteur_original)/2;
				                $yPos = 0;
				                $imagecropped->cropImage($hauteur_original,$hauteur_original, $xPos,$yPos);
				            }
				            else {
				                $yPos = ($hauteur_original-$largeur_original)/2;
				                $xPos = 0;
				                $imagecropped->cropImage($largeur_original,$largeur_original, $xPos,$yPos);
				            }
				            $usr->setAvatar($imagecropped);
				            $usr->setExtension($format);
						}
						$udao->create($usr);
						
						header('location: ./?action=connecter&success=true');
						return "login";
					}
					else {
						$_REQUEST["CreateError"]["Pass"] = true;
						return "createNewAccount";
					}
				}
				else {
					$_REQUEST["CreateError"]["Email"] = true;
					return "createNewAccount";
				}
			}
		else {
			$_REQUEST["CreateError"]["newUserName"] = true;
			return "createNewAccount";
		}
			

		

	}
}
?>