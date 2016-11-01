<?php

class Reseau {
	private $id;
	private $type;
	private $url;


	public function __construct($iden = "",$tp = "",$link = "")	//Constructeur
	{
		$this->id = $iden;
		$this->type = $tp;
		$this->url = $link;
	}	
	
	public function getId()
	{
			return $this->id;
	}
	
	public function setId($value)
	{
			$this->id = $value;
	}
        
	public function getType()
	{
			return $this->type;
	}
	
	public function setType($value)
	{
			$this->type = $value;
	}

	public function getUrl()
	{
			return $this->url;
	}

	public function setUrl($value)
	{
			$this->url = $value;
	}

	public function loadFromArray($tab)
	{
		$this->id = $tab["ID"];
		$this->type = $tab["TYPE"];
		$this->url = $tab["URL"];
	}	
}
?>