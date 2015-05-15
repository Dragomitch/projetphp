<?php
class Levels{

    private $_label;
	private $_level;
	private $_num_level;
	
	
	public function __construct($label,$level,$num_level){

		$this->_label=$label;
		$this->_level=$level;
		$this->_num_level=$num_level;

	}
	
	public function label(){

		return $this->_label;

	}
	
	public function level(){

		return $this->_level;

	}
	public function num_level(){

		return $this->_num_level;

	}
}
?>