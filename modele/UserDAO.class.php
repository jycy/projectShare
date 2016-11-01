<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/User.class.php'); 

class UserDAO
{	
	public function create($x) {
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO USER (USER , PASSWORD, ADRESSE, AVATAR, EXTENSION) VALUES (?, ?, ?, ?, ?)");
			$usrname = $x->getUserName();
			$usrpass = $x->getPassword();
			$usraddress = $x->getAdresseCourriel();
			$usravatar = $x->getAvatar();
			$usrformatavatar = $x->getExtension();
			$pstmt->bindParam(1, $usrname);
        	$pstmt->bindParam(2, $usrpass);
        	$pstmt->bindParam(3, $usraddress);
        	$pstmt->bindParam(4, $usravatar, PDO::PARAM_LOB);
        	$pstmt->bindParam(5, $usrformatavatar);
			return $pstmt->execute();
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

	public static function find($usr)
	{
		$db = Database::getInstance();

		#$pstmt = $db->prepare("SELECT USER FROM user WHERE USER = :x and PASSWORD = :y");//requête paramétrée par un paramètre x.
		#$pstmt->execute(array(':x' => $usr,':y' => $psw));

		$pstmt = $db->prepare("SELECT * FROM USER WHERE USER = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $usr));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$u = new User();
			$u->setId($result->ID);
			$u->setUserName($result->USER);
			$u->setPassword($result->PASSWORD);
			$u->setAdresseCourriel($result->ADRESSE);
			$u->setAvatar($result->AVATAR);
			$u->setExtension($result->EXTENSION);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}
	public static function findById($usr)
	{
		$db = Database::getInstance();

		#$pstmt = $db->prepare("SELECT USER FROM user WHERE USER = :x and PASSWORD = :y");//requête paramétrée par un paramètre x.
		#$pstmt->execute(array(':x' => $usr,':y' => $psw));

		$pstmt = $db->prepare("SELECT * FROM USER WHERE ID = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $usr));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$u = new User();
			$u->setId($result->ID);
			$u->setUserName($result->USER);
			$u->setPassword($result->PASSWORD);
			$u->setAdresseCourriel($result->ADRESSE);
			$u->setAvatar($result->AVATAR);
			$u->setExtension($result->EXTENSION);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}

	
	public static function findByEmail($email)
	{
		$db = Database::getInstance();

		#$pstmt = $db->prepare("SELECT USER FROM user WHERE USER = :x and PASSWORD = :y");//requête paramétrée par un paramètre x.
		#$pstmt->execute(array(':x' => $usr,':y' => $psw));

		$pstmt = $db->prepare("SELECT * FROM USER WHERE ADRESSE = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $email));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$u = new User();
			$u->setId($result->ID);
			$u->setUserName($result->USER);
			$u->setPassword($result->PASSWORD);
			$u->setAdresseCourriel($result->ADRESSE);
			$u->setAvatar($result->AVATAR);
			$u->setExtension($result->EXTENSION);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}
}
?>