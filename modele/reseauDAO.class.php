<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Reseau.class.php'); 
include_once('./modele/classes/Reseau_projet.class.php'); 
include_once('./modele/classes/Liste.class.php'); 

class ReseauDAO
{	
	public function create($x) {
/*		$request = "INSERT INTO `magasin`.`produit` (`NUM` ,`DESIGN` ,`PRIXUNIT`)".
				" VALUES ('".$x->getNum()."','".$x->getDesignation()."','".$x->getPrixUnit()."')";
*/		$request = "INSERT INTO RESEAU (TYPE, URL)".
				" VALUES ('".$x->getType()."','".$x->getUrl()."')";
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
	public function createReseauProjet($r) {
	$request = "INSERT INTO RESEAU_PROJET (RESEAUID, PROJETID,USERID)".
				" VALUES ('".$r->getReseauId()."','".$r->getProjetId()."','".$r->getUserId()."')";
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

	public static function findByUrl($url){
		$db = Database::getInstance();

		#$pstmt = $db->prepare("SELECT USER FROM user WHERE USER = :x and PASSWORD = :y");//requête paramétrée par un paramètre x.
		#$pstmt->execute(array(':x' => $usr,':y' => $psw));

		$pstmt = $db->prepare("SELECT * FROM RESEAU WHERE URL = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $url));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$u = new Reseau();
			$u->setId($result->ID);
			$u->setType($result->TYPE);
			$u->setUrl($result->URL);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}

	public static function findByProjet($id){
		try {
			$cnx = Database::getInstance();
			$pstmt = $cnx->prepare('SELECT * FROM RESEAU WHERE ID in (SELECT RESEAUID FROM RESEAU_PROJET WHERE PROJETID = :x )');
			$pstmt->execute(array(':x' => $id));
			$result = $pstmt->fetch(PDO::FETCH_OBJ);
		    if ($result)
			{
				$u = new Reseau();
				$u->setId($result->ID);
				$u->setType($result->TYPE);
				$u->setUrl($result->URL);
				$pstmt->closeCursor();
				$cnx = null;
				return $u;
			}
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    $db = null;
		    return $liste;
		}	
	}
	public static function findAllByUser($id){
		try {
			$liste = new liste();
			$requete = 'SELECT * FROM RESEAU WHERE ID in (SELECT RESEAUID FROM RESEAU_PROJET WHERE USERID ='.$id.')';
			$cnx = Database::getInstance();
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$r = new Reseau();
				$r->loadFromRecord($row);
				$liste->add($r);
		    }
			$res->closeCursor();
		    $cnx = null;
			return $liste;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    $db = null;
		    return $liste;
		}	
	}
	
	public function update($x) {
		$request = "UPDATE RESEAU_PROJET SET RESEAUID = '".$x->getReseauId()."' WHERE PROJETID = '".$x->getProjetId()."'";
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
	public function delete($id) {
		try
		{
			$db = Database::getInstance();
			$del = $db->prepare("DELETE FROM RESEAU_PROJET WHERE PROJETID = :x ");
			return $del->execute(array(':x' => $id));
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}	
}
?>