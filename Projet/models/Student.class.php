<?php
class Student{
	private $_matricule;
	private $_first_name;
	private $_last_name;
	private $_password;
	private $_last_connexion;
	
	
	public function __construct($matricule,$first_name,$last_name,$password){
		$this->_matricule = $matricule;
		$this->_first_name = $first_name;
		$this->_last_name =$last_name;
		$this->_password = $password;
	}
	
	public function matricule(){
		return $this->_matricule;		
	}	
		
	public function first_name(){
		return $this->_first_name;
	}
	public function last_name(){
		return $this->_last_name;
	}
	
	public function password(){
		return $this->_password;
	}
 	
}
?>