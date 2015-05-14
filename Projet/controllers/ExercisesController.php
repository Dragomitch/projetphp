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
        
        $name_student = Db::getInstance()->select_name_student($_SESSION ['login']);
        $level= htmlentities($_GET['level']);
        $tabexercises=Db::getInstance()->select_exercise($level);
        $num_level=Db::getInstance()->select_num_level($level);
        $show_answer=false;
       
        
        #i = num_exercise; $i is the current exercise displayed
      if(isset($_GET['exercise'])){
       $i=$_GET['exercise']-1;
      }
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
                $answer=$_POST['answer'];
                try {
                	
                	$tabshowanswer=Db::getInstance()->show_answer_DB($answer);
                	Db::getInstance()->save_answer($matricule, $_POST['number_ex'], htmlentities($_POST['answer']));
                	$tabanswer =Db::getInstance()->select_answer($matricule, $_POST['number_ex']);
                	$tabNamesColumns=Db::getInstance()->getColumnsNames($answer);
                } catch (PDOException $pdoException) {
                	$notificationStud="Voici l'erreur envoyee par la base de donnee :".$pdoException.error_get_last();
                }
                
                
                
               
                
                try {
                	$tab_show_answer_teacher=Db::getInstance()->show_answer_DB($tabexercises[$i]->query());
                	
                	$tabNamesColumnsTeacher=Db::getInstance()->getColumnsNames($tabexercises[$i]->query());
                } catch (PDOException $pdoException) {
                	$notificationTeacher="Voici l'erreur vient de la base de donnee des profs ".$pdoException.error_get_last();
                }

                

            }

        


        }

        #call the view
        require_once (PATH_VIEWS .'exercices.php');
    }
}