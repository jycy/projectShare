<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Photo.class.php'); 
include_once('./modele/classes/Liste.class.php'); 

class PhotoDAO
{	
	public function upload($x) {
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO PHOTO (PROJETID, TITRE, PHOTO, TYPE, EXTENSION) VALUES (?, ?, ?, ?, ?)");
			$projetid = $x->getProjetID();
			$titre = $x->getTitre();
			$photo = $x->getPhoto();
			$type = $x->getType();
			$format = $x->getExtension();
			$pstmt->bindParam(1, $projetid);
        	$pstmt->bindParam(2, $titre);
        	$pstmt->bindParam(3, $photo, PDO::PARAM_LOB);
        	$pstmt->bindParam(4, $type);
        	$pstmt->bindParam(5, $format);
			$pstmt->execute();
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

	public static function findMiniature($id)
	{
		$db = Database::getInstance();
		$pstmt = $db->prepare("SELECT * FROM photo WHERE PROJETID = :x and TYPE = 'miniature'");
		$pstmt->execute(array(':x' => $id));
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		if ($result)
		{
			$u = new Photo();
			$u->setId($result->ID);
			$u->setProjetId($result->PROJETID);
			$u->setTitre($result->TITRE);
			$u->setPhoto($result->PHOTO);
			$u->setType($result->TYPE);
			$u->setExtension($result->EXTENSION);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}

	public static function findAllByProject($proj,$page)
	{
		try {
			$liste = new liste();
			$start = $page*16;
			$requete = "SELECT * FROM PHOTO where PROJETID ='".$proj."' AND TYPE = 'PROJETPHOTO' Order by 1 LIMIT ".$start." ,16";
			$cnx = Database::getInstance();
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new Photo();
				$p->loadFromRecord($row);
				$liste->add($p);
		    }
			$res->closeCursor();
		    $cnx = null;
			return $liste;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    $cnx = null;
		    return $liste;
		}	
	}

	public function delete($id) {
		$request = "DELETE FROM PHOTO WHERE ID = '".$id."'";
		try
		{
			$db = Database::getInstance();
			return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}
	public function deleteMiniature($id) {
		$request = "DELETE FROM PHOTO WHERE TYPE ='miniature' AND PROJETID = '".$id."'";
		try
		{
			$db = Database::getInstance();
			return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}
	public function deleteAllByProj($x) {
		$request = "DELETE FROM PHOTO WHERE PROJETID = '".$x->getId()."'";
		try
		{
			$db = Database::getInstance();
			return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}		
}
?>