<?php
require_once('./modele/classes/Navigable.interface.php');

class ListeProjet implements Navigable {
	private $projets;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->projets = array();
	}	
	
	public function add($projet)
	{
			array_push($this->projets,$projet);
	}
	
	public function previous()
	{
		if ($this->current>0)
		{
			$this->current--;
			return true;
		}
		return false;
	}
	public function next()
	{
		if ($this->current<count($this->projets)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->projets[$this->current]))
				echo $this->projets[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->projets[$this->current]))
			return $this->projets[$this->current];
		return null;	
	}	
}
?>