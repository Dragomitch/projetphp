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
        $show_answer=false;
        $i=0;
        if (isset($_POST)){
            if (!empty($_POST['nr_question'])){
                $i=htmlentities($_POST['nr_question'])-1;
            }
            elseif (!empty($_POST['nr_question_suivant'])){
                if($_POST['nr_question_suivant']==count($tabexercises)){

                    $i=0;

                }else{


                    $i=$_POST['nr_question_suivant'];

                }
            }
            elseif (!empty($_POST['nr_question_precedent'])){
                if ($_POST['nr_question_precedent']==1){
                    $i=count($tabexercises)-1;
                }else{
                    $i=$_POST['nr_question_precedent']-2;
                }
            }

            if(!empty($_POST['answer'])){
                $show_answer = true;
                $matricule = $_SESSION ['login'];
                Db::getInstance()->save_answer($matricule, $tabexercises[$i]->num_exercise(), htmlentities($_POST['answer']));
                $tabanswer =Db::getInstance()->select_answer($matricule, $tabexercises[$i]->num_exercise());

            }




        }

        #call the view
        require_once (PATH_VIEWS .'exercices.php');
    }
}