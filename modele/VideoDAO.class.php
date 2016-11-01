<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Video.class.php'); 
include_once('./modele/classes/Liste.class.php'); 

class VideoDAO
{	
	public function create($x) {
			$request = "INSERT INTO VIDEO (URL, PROJETID)".
			" VALUES ('".$x->getUrl()."','".$x->getProjetId()."')";
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

	public static function find($proj)
	{
		$db = Database::getInstance();


		$pstmt = $db->prepare("SELECT * FROM VIDEO WHERE PROJETID = :x ");
		$pstmt->execute(array(':x' => $proj));
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		if ($result)
		{
			$u = new Video();
			$u->setId($result->ID);
			$u->setProjetId($result->PROJETID);
			$u->setUrl($result->URL);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}

	
	public function update($x) {
		$request = "UPDATE VIDEO SET URL ='".$x->getUrl()."' WHERE PROJETID = '".$x->getProjetId()."'";
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

	

	public function delete($x) {
		$request = "DELETE FROM VIDEO WHERE PROJETID = '".$x->getId()."'";
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