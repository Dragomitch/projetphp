<?php
class Levels{
	private $_label;
	private $_level;
	
	
	public function __construct($label,$level){
		$this->_label=$label;
		$this->_level=$level;
	}
	
	public function label(){
		return $this->_label;
	}
	
	public function level(){
		return $this->_level;
	}
}
?>