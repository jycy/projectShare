<?php

class User {
	private $id;
	private $userName;
	private $password;
	private $adresseCourriel;
	private $avatar;
	private $extension;


	public function __construct($iD = "", $usr = "",$psw = "",$adr = "",$av = "")	//Constructeur
	{
		$this->id = $iD;
		$this->userName = $usr;
		$this->password = $psw;
		$this->adresseCourriel = $adr;
		$this->avatar = $av;
	}	
	public function getId()
	{
			return $this->id;
	}
	
	public function setId($value)
	{
			$this->id = $value;
	}
	public function getExtension()
	{
			return $this->extension;
	}
	
	public function setExtension($value)
	{
			$this->extension = $value;
	}
	public function getAvatar()
	{
			return $this->avatar;
	}
	
	public function setAvatar($value)
	{
			$this->avatar = $value;
	}

	public function getUserName()
	{
			return $this->userName;
	}
	
	public function setUserName($value)
	{
			$this->userName = $value;
	}
        
	public function getPassword()
	{
			return $this->password;
	}
	
	public function setPassword($value)
	{
			$this->password = $value;
	}

	public function getAdresseCourriel()
	{
			return $this->adresseCourriel;
	}

	public function setAdresseCourriel($value)
	{
			$this->adresseCourriel = $value;
	}

	public function loadFromArray($tab)
	{
		$this->id = $tab["ID"];
		$this->userName = $tab["USER"];
		$this->password = $tab["PASSWORD"];
		$this->adresseCourriel = $tab["ADRESSE"];
		$this->avatar = $tab["AVATAR"];
		$this->extension = $ligne["EXTENSION"];
	}	
}
?>