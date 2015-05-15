<?php
class LevelController{
    public function __construct(){
    }

    public function run(){

        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'student') {
            header ( "Location: index.php?action=homeTeacher" );
            die ();
        }

        $tablevel=Db::getInstance()->select_levels();#select all the levels
        require_once (PATH_VIEWS .'level.php');
    }

}