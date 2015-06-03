<?php
class Students_answers{

    private $_number;
    private $_answer_query;
    private $_exercise;
    private $_student;

    public function __construct($number,$answer_query,$exercise,$student){

        $this->_number=$number;
        $this->_answer_query=$answer_query;
        $this->_exercise=$exercise;
        $this->_student=$student;

    }


    public function number(){
        return $this->_number;
    }


    public function answer_query(){
        return $this->_answer_query;
    }


    public function exercise(){
        return $this->_exercise;
    }


    public function student(){
        return $this->_student;
    }
}