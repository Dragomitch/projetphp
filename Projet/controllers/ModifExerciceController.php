<?php
class ModifExerciceController{
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

        require_once (PATH_VIEWS . 'modifexercice.php');
    }
}