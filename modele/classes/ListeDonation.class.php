<?php
require_once('./modele/classes/Navigable.interface.php');

class ListeDonation implements Navigable {
	private $donations;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->donations = array();
	}	
	
	public function add($donation)
	{
			array_push($this->donations,$donation);
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
		if ($this->current<count($this->donations)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->donations[$this->current]))
				echo $this->donations[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->donations[$this->current]))
			return $this->donations[$this->current];
		return null;	
	}	
}
?>