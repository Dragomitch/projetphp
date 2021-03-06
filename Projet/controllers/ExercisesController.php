<?php
class ExercisesController{
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

        $name_student = Db::getInstance()->select_name_student($_SESSION ['login']);#find the first and the last name of the connected student

        $level=        htmlentities($_GET['level']);#select all the exercises of the level
        $tabexercises= Db::getInstance()->select_exercise($level); #get the PK of the table "level"
        $num_level=    Db::getInstance()->select_num_level($level);
        $show_answer=  false;
        $matricule =   $_SESSION['login'];

        if(isset($_GET['exercise'])){
            $num_exercise=$_GET['exercise']-1;
        }

        if (isset($_POST)){ #direct search of exercise

            if (!empty($_POST['nr_question'])){
                if($_POST['nr_question'] >= count($tabexercises) or $_POST['nr_question']<=0){
                    $num_exercise=0;
                }else{
                    $num_exercise=htmlentities($_POST['nr_question'])-1;
                }
            }


            elseif (!empty($_POST['nr_question_suivant'])){ #next exercise
                if($_POST['nr_question_suivant']==count($tabexercises)){
                    $num_exercise=0;

                }else{
                    $num_exercise=$_POST['nr_question_suivant'];
                }
            }

            elseif (!empty($_POST['nr_question_precedent'])){#previous exercise
                if ($_POST['nr_question_precedent']==1){
                    $num_exercise=count($tabexercises)-1;

                }else{
                    $num_exercise=$_POST['nr_question_precedent']-2;
                }
            }


            try {
                #get last answer for this question for this student
                $last_answer=Db::getInstance()->select_answer($matricule, $tabexercises[$num_exercise]->number());

                $notification_last_answer="Vous n'avez pas encore répondu à cette exercice !";

            } catch (PDOException $pdoException) {
                $notification_last_answer="Vous n'avez pas encore répondu à cette exercice !";
            }

            $notification_valid="";
            if(!empty($_POST['answer']) ){

                #check the answer of the student, verify if he works on the right table
                if(!Db::getInstance()->is_a_good_query(htmlentities($_POST['answer']))){
                    $notification_valid="Votre query n'est pas correct, veuillez respecter la syntaxe SQL et vous restreindre aux dsd bd1, bd2, bd3.";

                }else{
                    $show_answer = true;

                    $answer=htmlentities($_POST['answer']);

                    try {#execute the query and return the result

                        $tabshowanswer=Db::getInstance()->show_answer_DB($answer); #save the answer if no exception has been detected

                        Db::getInstance()->save_answer($matricule, $_POST['number_ex'], htmlentities($_POST['answer']));

                        $tabanswer =Db::getInstance()->select_answer($matricule, $_POST['number_ex']); #get the answer just given by the student
                        $tabNamesColumns=Db::getInstance()->getColumnsNames($answer);  #get the name of the columns of the result;


                    } catch (PDOException $pdoException) {
                        $notificationStud="Voici l'erreur envoyee par la base de donnee :".$pdoException->getMessage();
                    }

                    try {
                        #execute the query of the teacher and return the result
                        $tab_show_answer_teacher=Db::getInstance()->show_answer_DB($tabexercises[$num_exercise]->query());

                        #get the name of the columns
                        $tabNamesColumnsTeacher=Db::getInstance()->getColumnsNames($tabexercises[$num_exercise]->query());

                    } catch (PDOException $pdoException) {
                        $notificationTeacher="Voici l'erreur vient de la base de donnee des profs ".$pdoException->getMessage();
                    }

                }

            }

        }

        require_once (PATH_VIEWS .'exercise.php');
    }
}