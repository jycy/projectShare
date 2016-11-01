<?php
include_once('./modele/classes/Database.class.php'); 
include_once('./modele/classes/Donation.class.php'); 
include_once('./modele/classes/Liste.class.php'); 

class DonationDAO
{	
	public function create($x) {
/*		$request = "INSERT INTO `magasin`.`produit` (`NUM` ,`DESIGN` ,`PRIXUNIT`)".
				" VALUES ('".$x->getNum()."','".$x->getDesignation()."','".$x->getPrixUnit()."')";
*/		$request = "INSERT INTO DONATION (PROJETID , USERID, MONTANT, DATE)".
				" VALUES ('".$x->getProjetId()."','".$x->getUserId()."','".$x->getMontant()."','".$x->getDate().")";
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

		$pstmt = $db->prepare("SELECT * FROM DONATION WHERE ID = :x");//requête paramétrée par un paramètre x.
		$pstmt->execute(array(':x' => $id));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$u = new Donation();
			$u->setId($result->ID)
			$u->setUserId($result->USERID);
			$u->setMontant($result->MONTANT);
			$u->setDate($result->DATE);
			$pstmt->closeCursor();
			$db = null;
			return $u;
		}
		$pstmt->closeCursor();
		$db = null;
		return null;
	}
	
	public static function findLimit($page)
	{
		try {
			$liste = new liste();
		
			$requete = 'SELECT * FROM DONATION Order by 1 LIMIT '.$page*10.' ,10';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$p = new Donation();
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
		$request = "DELETE FROM DONATION WHERE ID = '".$id."'";
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