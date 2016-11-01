<?php

class Projet {
	private $ID;
	private $userId;
	private $name;
	private $description;
	private $introduction;


	public function __construct($id = "",$usr = "",$nm = "",$des = "",$intro = "")	//Constructeur
	{
		$this->ID = $id;
		$this->userId = $usr;
		$this->name = $nm;
		$this->description = $des;
		$this->introduction = $intro;
	}	
	public function getIntroduction()
	{
		return $this->introduction;
	}
	public function setIntroduction($value)
	{
			$this->introduction = $value;
	}
	public function getId()
	{
			return $this->ID;
	}

	public function setId($value)
	{
			$this->ID = $value;
	}

	public function getUserId()
	{
			return $this->userId;
	}
	
	public function setUserId($value)
	{
			$this->userId = $value;
	}
        
	public function getName()
	{
			return $this->name;
	}
	
	public function setName($value)
	{
			$this->name = $value;
	}

	public function getDescription()
	{
			return $this->description;
	}

	public function setDescription($value)
	{
			$this->description = $value;
	}

	public function __toString()
	{
		return "Projet[".$this->userId.",".$this->name.",".$this->description."]";
	}

	public function affiche()
	{
		echo $this->__toString();
	}	

	public function loadFromRecord($ligne)
	{
		$this->ID = $ligne["ID"];
		$this->userId = $ligne["USERID"];
		$this->name = $ligne["NAME"];
		$this->description = $ligne["DESCRIPTION"];
		$this->introduction = $ligne["INTRODUCTION"];
	}	
}
?>