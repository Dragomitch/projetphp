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
            #get the last name and first name of the student
            $tabstudent=Db::getInstance()->select_name_student($matricule);
            #get all level
            $tablevel=Db::getInstance()->select_level();



        }


        require_once(PATH_VIEWS .'showstudentex.php');

    }
}