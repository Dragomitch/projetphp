<?php
class Student{
	private $_login;
	private $_first_name;
	private $_last_name;
	private $_password;


	public function __construct($login,$first_name,$last_name,$password){
		$this->_login = $login;
		$this->_first_name = $first_name;
		$this->_last_name =$last_name;
		$this->_password = $password;
	}

	public function login(){
		return $this->_login;
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