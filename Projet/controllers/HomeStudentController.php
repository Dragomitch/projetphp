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
        Db::getInstance()->update_student_last_co('1');
        $student= Db::getInstance()->select_name_student(1);
        var_dump($student);

        require_once(PATH_VIEWS . 'homestudent.php');
    }
}
?>