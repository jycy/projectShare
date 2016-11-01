<?php

class Commentaire {
	private $ID;
	private $projetId;
	private $user;
	private $message;
	private $date;
	private $avatar;


	public function __construct($id = "", $proj = "",$usr = "",$msg = "",$av = "")	//Constructeur
	{
		$this->ID = $id;
		$this->projetId = $proj;
		$this->user = $usr;
		$this->message = $msg;
		$date = new DateTime(null, new DateTimeZone('UTC'));
		$this->date = $date->getTimestamp();
		$this->avatar = $av;
	}	
	public function getId()
	{
			return $this->ID;
	}
	
	public function setId($value)
	{
			$this->ID = $value;
	}
	public function getAvatar()
	{
			return $this->avatar;
	}
	
	public function setAvatar($value)
	{
			$this->avatar = $value;
	}

	public function getProjetId()
	{
			return $this->projetId;
	}
	
	public function setProjetId($value)
	{
			$this->projetId = $value;
	}
	
	public function getUser()
	{
			return $this->user;
	}
	
	public function setUser($value)
	{
			$this->user = $value;
	}
        
	public function getMessage()
	{
			return $this->message;
	}
	
	public function setMessage($value)
	{
			$this->message = $value;
	}

	public function getDate()
	{
			return $this->date;
	}
	public function setDate($value)
	{
			$this->date = $value;
	}

	public function loadFromRecord($ligne)
	{
		$this->ID = $ligne["ID"];
		$this->projetId = $ligne["PROJETID"];
		$this->user = $ligne["USER"];
		$this->message = $ligne["MESSAGE"];
		$this->date = $ligne["DATE"];
		$this->avatar = $ligne["AVATAR"];

	}	
}
?>