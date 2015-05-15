<?php
class ShowStudentExController{
    public function __contruct(){

    }

    public function run(){

        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'teacher') {
            header ( "Location: index.php?action=homeStudent" );
            die ();
        }

        if(isset($_GET)){

            $matricule=$_GET['matricule'];
            $tabstudent=Db::getInstance()->select_name_student($matricule);#get the last name and first name of the student
            $tablevel=Db::getInstance()->select_levels();#get all levels

        }


        require_once(PATH_VIEWS .'showstudentex.php');

    }
}