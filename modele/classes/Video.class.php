<?php

class Video {
	private $ID;
	private $projetId;
	private $url;
	


	public function __construct($id = "", $proj = "",$ul = "")	//Constructeur
	{
		$this->ID = $id;
		$this->projetId = $proj;
		$this->url = $ul;
		
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
	
	public function getUrl()
	{
			return $this->url;
	}
	
	public function setUrl($value)
	{
			$this->url = $value;
	}

	public function loadFromRecord($ligne)
	{
		$this->ID = $ligne["ID"];
		$this->projetId = $ligne["PROJETID"];
		$this->titre = $ligne["URL"];
	}	
}
?>