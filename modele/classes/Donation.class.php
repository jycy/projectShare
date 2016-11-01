<?php

class Commentaire {
	private $ID;
	private $projetId;
	private $userId;
	private $montant;
	private $date;


	public function __construct($id = "", $proj = "",$usr = "",$amount = "")	//Constructeur
	{
		$this->ID = $id;
		$this->projetId = $proj;
		$this->userId = $usr;
		$this->montant = $amount;
		$date = new DATETIME();
		$this->date = $date->getTimestamp();
	}	
	public function getId()
	{
			return $this->ID;
	}
	
	public function setId($value)
	{
			$this->ID = $value;
	}

	public function getProjetId()
	{
			return $this->projetId;
	}
	
	public function setProjetId($value)
	{
			$this->projetId = $value;
	}
	
	public function getUserId()
	{
			return $this->userId;
	}
	
	public function setUserId($value)
	{
			$this->userId = $value;
	}
        
	public function getMontant()
	{
			return $this->montant;
	}
	
	public function setMontant($value)
	{
			$this->montant = $value;
	}

	public function getDate()
	{
			return $this->date;
	}

	public function loadFromRecord($ligne)
	{
		$this->ID = $ligne["ID"];
		$this->projetId = $ligne["PROJETID"];
		$this->userId = $ligne["USERID"];
		$this->message = $ligne["MONTANT"];
		$this->date = $ligne["DATE"];

	}	
}
?>