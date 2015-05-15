<?php
class StudentListController{
    public function __construct(){

    }
    public function run(){
        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'teacher') {
            header ( "Location: index.php?action=homeStudent" ); // redirection HTTP vers l'action login
            die ();
        }

        $tabstudents=Db::getInstance()->select_students();#get all the students

        $tablevel=Db::getInstance()->select_levels();# Select all the levels

        require_once(PATH_VIEWS . 'studentlist.php');
    }
}