<?php

class Photo {
	private $ID;
	private $projetId;
	private $titre;
	private $photo;
	private $type;
	private $extension;


	public function __construct($id = "", $proj = "",$tit = "",$pic = "",$typ = "",$ext = "")	//Constructeur
	{
		$this->ID = $id;
		$this->projetId = $proj;
		$this->titre = $tit;
		$this->photo = $pic;
		$this->type = $typ;
		$this->extension = $ext;
	}	
	public function getId()
	{
			return $this->ID;
	}
	
	public function setId($value)
	{
			$this->ID = $value;
	}

	public function getExtension()
	{
			return $this->extension;
	}
	
	public function setExtension($value)
	{
			$this->extension = $value;
	}

	public function getProjetId()
	{
			return $this->projetId;
	}
	
	public function setProjetId($value)
	{
			$this->projetId = $value;
	}
	
	public function getTitre()
	{
			return $this->titre;
	}
	
	public function setTitre($value)
	{
			$this->titre = $value;
	}
        
	public function getPhoto()
	{
			return $this->photo;
	}
	
	public function setPhoto($value)
	{
			$this->photo = $value;
	}

	public function getType()
	{
			return $this->type;
	}

	public function setType($value)
	{
			$this->type = $value;
	}

	public function loadFromRecord($ligne)
	{
		$this->ID = $ligne["ID"];
		$this->projetId = $ligne["PROJETID"];
		$this->titre = $ligne["TITRE"];
		$this->photo = $ligne["PHOTO"];
		$this->type = $ligne["TYPE"];
		$this->extension = $ligne["EXTENSION"];

	}	
}
?>