<?php

class Reseau_projet {
	private $reseauId;
	private $projetId;
	private $userId;


	public function __construct($res = "",$proj = "",$usr = "")	//Constructeur
	{
		$this->reseauId = $res;
		$this->projetId = $proj;
		$this->userId = $usr;
	}	
	
	public function getReseauId()
	{
			return $this->reseauId;
	}
	
	public function setReseauId($value)
	{
			$this->reseauId = $value;
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

	public function loadFromArray($tab)
	{
		$this->reseauId = $tab["RESEAUID"];
		$this->projetId = $tab["PROJETID"];
		$this->userId = $tab["USERID"];
	}	
}
?>