<?php
require_once('./modele/classes/Navigable.interface.php');

class Liste implements Navigable {
	private $items;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->items = array();
	}	
	
	public function add($item)
	{
			array_push($this->items,$item);
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
		if ($this->current<count($this->items)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->items[$this->current]))
				echo $this->items[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->items[$this->current]))
			return $this->items[$this->current];
		return null;	
	}	
}
?>