<?php
class ModifyExerciseController{
    public function __construct(){
    }

    public function run(){
        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'teacher') {
            header ( "Location: index.php?action=homeStudent" );
            die ();
        }

        $show_answer=false;
        $message="";


        $afficher=false;

        #$i is the index of the array wich contains all exercises
        $i= 0;

        $tabexercises=null;
        $notification='';


        if (!empty($_POST['num_exercise']) AND !empty($_POST['num_level'])){
            $num_exercise= htmlentities($_POST['num_exercise']);

            $i=$num_exercise-1;
            $num_level=htmlentities($_POST['num_level']);

            $levels=Db::getInstance()->select_levels();

            if($num_level> count($levels) || $num_level<=0) {

                $notification= "Le numéro de niveau entré est invalide";
                $afficher= false;


            }else{

                $tabexercises = db::getInstance()->select_exercise($num_level);
                if($num_exercise<= 0 || $num_exercise> count($tabexercises)){
                    $notification= "Le numéro d'exercice entré est invalide";
                    $afficher=false;
                }else{
                    $afficher = true;
                }
            }
        }

        if (!empty($_POST['query'])and !empty($_POST['statement'])){
            #get all the data you keyed in by the post method
            $num_exercise= htmlentities($_POST['num_exercise']);
            $query_update = htmlentities($_POST['query']);
            $author =$_SESSION['login'];
            $num_level=$_POST['num_level'];

            $nb_lines=$_POST['nb_lines'];
            $statement=$_POST['statement'];
            $theme=$_POST['theme'];
            #save all the change in the data base
            db::getInstance()->update_query($query_update, $author, $num_exercise, $nb_lines, $num_level, $statement, $theme);
            $afficher =false;
        }

        require_once (PATH_VIEWS . 'modifyexercise.php');
    }
}