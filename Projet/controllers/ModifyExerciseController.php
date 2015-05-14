<?php
class ModifyExerciseController{
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

        $show_answer=false;
        $message="";

//         $query = htmlentities($_POST['query']);
//         $author =$_SESSION['type'];

//         $num_exercise= $tabexercises[$i]->num_exercise();

//         $nb_lines=hmtlentities($_POST['nb_lines']);
//         $statement=hmtlentities($_POST['statement']);
//         $theme=hmtlentities($_POST['theme']);
        $afficher=false;
        $i= 0;
        $tabexercises=null;
        if (!empty($_POST['num_exercise']) AND !empty($_POST['num_level'])){
            $num_exercise= htmlentities($_POST['num_exercise']);
            $i=$num_exercise-1;
            $num_level=$_POST['num_level'];
            #afficher le query a modifié
            $tabexercises=db::getInstance()->select_exercise($num_level);
            $afficher= true;
        }
        if (!empty($_POST['query'])and !empty($_POST['statement'])){
            $num_exercise= htmlentities($_POST['num_exercise']);
            $query_update = htmlentities($_POST['query']);
            $author =$_SESSION['login'];
            $num_level=$_POST['num_level'];

            $nb_lines=$_POST['nb_lines'];
            $statement=$_POST['statement'];
            $theme=$_POST['theme'];
            db::getInstance()->update_query($query_update, $author, $num_exercise, $nb_lines, $num_level, $statement, $theme);
            $afficher =false;
        }


//         db::getInstance()->update_query($query, $author, $label, $num_exercise, $nb_lines, $num_level, $statement, $theme);



        require_once (PATH_VIEWS . 'modifyexercise.php');
    }
}