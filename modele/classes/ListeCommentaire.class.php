<?php
require_once('./modele/classes/Navigable.interface.php');

class ListeCommentaire implements Navigable {
	private $commentaires;
	private $current = -1;

	public function __construct()	//Constructeur
	{
		$this->commentaires = array();
	}	
	
	public function add($commentaire)
	{
			array_push($this->commentaires,$commentaire);
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
		if ($this->current<count($this->commentaires)) 
		{
			$this->current++;
			return true;
		}
		return false;
	}
        
	public function printCurrent()
	{
			if (isset($this->commentaires[$this->current]))
				echo $this->commentaires[$this->current];
	}
	public function getCurrent()
	{
		if (isset($this->commentaires[$this->current]))
			return $this->commentaires[$this->current];
		return null;	
	}	
}
?>