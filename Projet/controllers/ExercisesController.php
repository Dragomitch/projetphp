<?php
class ExercisesController{
    public function __construct(){

    }

    public function run(){
        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'student') {
            header ( "Location: index.php?action=homeTeacher" ); // redirection HTTP vers l'action login
            die ();
        }
        #default value = 1
        $num=1;
        if (isset($_GET)){
        	if (!empty($_GET['nr_question'])){
        		$num=htmlentities($_GET['nr_question']);
        	}
        }
        
        $tabexercises=Db::getInstance()->select_exercise($num);
        
        #call the view
        require_once (PATH_VIEWS .'exercices.php');
    }
}