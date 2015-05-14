<?php
class ShowStudentExController{
    public function __contruct(){

    }
    public function run(){
        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'teacher') {
            header ( "Location: index.php?action=homeStudent" ); // redirection HTTP vers l'action login
            die ();
        }

        if(isset($_GET)){
            $matricule=$_GET['matricule'];
            $tabstudent=Db::getInstance()->select_name_student($matricule);
            $tablevel=Db::getInstance()->select_level();



        }


        require_once(PATH_VIEWS .'showstudentex.php');

    }
}