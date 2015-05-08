<?php
class Exercises{
	private $_author;
	private $_label;
	private $_last_modification;
	private $_nb_lines;
	private $_number;
	private $_num_exercise;
	private $_num_level;
	private $_query;
	private $_statement;
	private $_theme;
	
	public function __construct($author,$label,$lastmodif,$nb_lines,$number,$num_exercise,$num_level,$query,$statement,$theme){
		$this->_author =$author;
		$this->_label=$label;
		$this->_last_modification=$lastmodif;
		$this->_nb_lines=$nb_lines;
		$this->_number=$number;
		$this->_num_exercise=$num_exercise;
		$this->_num_level=$num_level;
		$this->_query=$query;
		$this->_statement=$statement;
		$this->_theme=$theme;	
	}

	#author peut etre null
	#num_exercise est le numero de l'exercice dans le niveau
	#num_level doit etre attribue
	#statement= explication de l'exercise

	#num;theme;enonce;query;nb
	
	#num= numero du query
	#theme= Peut etre null -> indications supplementaires sur l'ex ( group-by, etc)
	#enonce= est la question a resoudre
	#query= reponse du query en sql
	#nb= nbr de lignes resultants de l'execution du query

	public function author(){
		return $this->_author;
	}
	public function label(){
		return $this->_label;
	}
	public function last_modification(){
		return $this->_last_modification;
	}
	public function nb_lines(){
		return $this->_nb_lines;
	}
	public function number(){
		return $this->_number;
	}
	public function num_exercise(){
		return $this->_num_exercise;
	}
	public function num_level(){
		return $this->_num_level;
	}
	public function query(){
		return $this->_query;
	}
	public function statement(){
		return $this->_statement;
	}
	public function theme(){
		return $this->_theme;
	}
}
?>