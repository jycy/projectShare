<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Commentaire.class.php'); 
include_once('./modele/classes/Liste.class.php'); 


class CommentaireDAO
{	
	public function create($x) {
/*		$request = "INSERT INTO `magasin`.`produit` (`NUM` ,`DESIGN` ,`PRIXUNIT`)".
				" VALUES ('".$x->getNum()."','".$x->getDesignation()."','".$x->getPrixUnit()."')";
*/		$request = "INSERT INTO COMMENTAIRE (PROJETID , USER, MESSAGE, DATE)".
				" VALUES ('".$x->getProjetId()."','".$x->getUser()."','".$x->getMessage()."',CURRENT_TIMESTAMP)";
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

	public static function find($id)
	{
		$db = Database::getInstance();
		$pstmt = $db->prepare("SELECT * FROM COMMENTAIRE WHERE ID = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $id));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$u = new Commentaire();
			$u->setId($result->ID);
			$u->setMessage($result->MESSAGE);
			$u->setUser($result->USER);
			$u->setDate($result->DATE);
			$u->setAvatar($result->AVATAR);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}
	public static function Ccount($id)
	{
		try {
			$cnx = Database::getInstance();
			$query = $cnx->query("SELECT count(*) AS TOTAL FROM COMMENTAIRE WHERE PROJETID =".$id."");
			
			$res = $query->fetch(PDO::FETCH_ASSOC);
			$total =$res['TOTAL'];
		    $cnx = null;
			return $total;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    $cnx = null;
		}	
	}
	
	public static function findLimit($proj,$page)
	{
		try {
			$liste = new liste();
			$start = $page*16;
			$requete = "SELECT USER.AVATAR, COMMENTAIRE.* FROM USER, COMMENTAIRE where USER.USER = COMMENTAIRE.USER and PROJETID ='".$proj."' Order by DATE DESC LIMIT ".$start." ,16";
			//SELECT user.AVATAR, commentaire.* FROM user,commentaire WHERE user.USER = commentaire.USER
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$c = new Commentaire();
				$c->loadFromRecord($row);
				$liste->add($c);
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
	public function update($x) {
		$request = "UPDATE COMMENTAIRE SET MESSAGE = '".$x->getMessage()."' WHERE ID = '".$x->getId()."'";
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
		$request = "DELETE FROM COMMENTAIRE WHERE PROJETID = '".$x->getId()."'";
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