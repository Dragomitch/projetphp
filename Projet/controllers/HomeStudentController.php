<?php

class HomeStudentController{

    public function __construct() {

    }

    public function run(){

        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'student') {
            header ( "Location: index.php?action=homeTeacher" );
            die ();
        }

        require_once(PATH_VIEWS . 'homestudent.php');
    }
}
?>