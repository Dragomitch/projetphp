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

        $level= htmlentities($_GET['level']);
        $tabexercises=Db::getInstance()->select_exercise($level);
        
        $i=0;
        if (isset($_POST)){
        	if (!empty($_POST['nr_question'])){
        		$i=htmlentities($_POST['nr_question'])-1;
        	}
        	elseif (!empty($_POST['nr_question_suivant'])){
        		if($i==count($tabexercises)-1){
        			$i=0;
        		}
        		$i=$_POST['nr_question_suivant'];
        	}
        	elseif (!empty($_POST['nr_question_precedent'])){
        		if ($_POST['nr_question_precedent']==1){
        			$i=count($tabexercises)-1;
        		}else{
        			$i=$_POST['nr_question_precedent']-2;
        		}
        	}
        }
        
        #call the view
        require_once (PATH_VIEWS .'exercices.php');
    }
}