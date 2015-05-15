<?php
class StudentListController{
    public function __construct(){

    }
    public function run(){
        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'teacher') {
            header ( "Location: index.php?action=homeStudent" ); 
            die ();
        }

        #get all the student
        $tabstudents=Db::getInstance()->select_students();

        # Select all the level
        $tablevel=Db::getInstance()->select_level();









        require_once(PATH_VIEWS . 'studentlist.php');
    }
}