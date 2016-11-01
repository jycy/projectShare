<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Projet.class.php'); 
include_once('./modele/classes/Liste.class.php'); 
include_once('./modele/classes/User.class.php'); 


class ProjetDAO
{	
	public function create($x) {
		$request = "INSERT INTO PROJET (USERID , NAME, DESCRIPTION, INTRODUCTION) VALUES ('".$x->getUserId()."','".$x->getName()."','".$x->getDescription()."','".$x->getIntroduction()."')";
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

		#$pstmt = $db->prepare("SELECT USER FROM user WHERE USER = :x and PASSWORD = :y");//requête paramétrée par un paramètre x.
		#$pstmt->execute(array(':x' => $usr,':y' => $psw));

		$pstmt = $db->prepare("SELECT * FROM PROJET WHERE ID = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $id));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$u = new Projet();
			$u->setId($result->ID);
			$u->setUserId($result->USERID);
			$u->setName($result->NAME);
			$u->setDescription($result->DESCRIPTION);
			$u->setIntroduction($result->INTRODUCTION);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}
	public static function findByName($name)
	{
		$db = Database::getInstance();

		#$pstmt = $db->prepare("SELECT USER FROM user WHERE USER = :x and PASSWORD = :y");//requête paramétrée par un paramètre x.
		#$pstmt->execute(array(':x' => $usr,':y' => $psw));

		$pstmt = $db->prepare("SELECT * FROM PROJET WHERE NAME = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $name));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$u = new Projet();
			$u->setId($result->ID);
			$u->setUserId($result->USERID);
			$u->setName($result->NAME);
			$u->setDescription($result->DESCRIPTION);
			$u->setIntroduction($result->INTRODUCTION);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}
	public static function Pcount()
	{
		try {
			$cnx = Database::getInstance();
			$query = $cnx->query('SELECT count(*) AS TOTAL FROM PROJET');
			
			$res = $query->fetch(PDO::FETCH_ASSOC);
			$total =$res['TOTAL'];
		    $cnx = null;
			return $total;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    $cnx = null;
		}	
	}

	public static function findLimit($page)
	{
		try {
			$liste = new liste();
			$start = $page*16;
			$requete = 'SELECT * FROM PROJET Order by 1 LIMIT '.$start.' ,16';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new Projet();
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
	public static function findByUser($page,$user)
	{
		try {
			$liste = new liste();
			$start = $page*16;
			$requete = "SELECT * FROM PROJET WHERE USERID = '".$user->getId()."' Order by 1  LIMIT ".$start." ,16";
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new Projet();
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
	public function update($x) {
		$request = "UPDATE PROJET SET DESCRIPTION = '".$x->getDescription()."', INTRODUCTION = '".$x->getIntroduction()."' WHERE ID = '".$x->getId()."'";
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
		$request = "DELETE FROM PROJET WHERE ID = ".$id."";
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