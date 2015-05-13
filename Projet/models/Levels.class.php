<?php
class Levels{
	private $_label;
	private $_level;
    private $_num_level;
	
	
	public function __construct($label,$level, $_num_level){
		$this->_label=$label;
		$this->_level=$level;
        $this->_level_num=$_num_level;
	}
	
	public function label(){
		return $this->_label;
	}
	
	public function level(){
		return $this->_level;
	}

    public function level_num(){
        return $this->_num_level;
    }
}
?>