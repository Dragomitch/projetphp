<?php
class ImportCSVController{
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

    $notification= '';

    if(!empty($_FILES['CSVfile'])){
        if( $_FILES['CSVfile']['tmp_name'] !=  ''){
            $file= file($_FILES['CSVfile']['tmp_name']);

            if(preg_match('/"Matric Info";"Nom Etudiant";"Prénom Etudiant"/',$file[0])){#importing the students
                foreach($file as $index => $studentData){

                    if($index> 0){
                        $valuesTable= explode(';', $studentData);
                        Db::getInstance()->insertStudent($valuesTable);
                    }

                }

                $notification= "L'importation des étudiants s'est bien déroulée";

            }elseif(preg_match('/login;nom;prenom/',$file[0])){ #importing the teachers
                foreach($file as $index => $teacherData){

                        if($index> 0){
                            $valuesTable= explode(';', $teacherData);
                            try {
                                Db::getInstance()->insertTeacher($valuesTable);
                            }catch(PDOException $pdo){
                                $notification= 'une erreur est générée, importation non réussie: '.$pdo->getMessage();
                            }
                        }
                }

                $notification= "L'importation des professeurs s'est bien déroulée";

            }elseif (preg_match('/num;theme;enonce;query;nb/', $file[0])) {#importing the queries

                if(empty($_POST['level_label']) | empty($_POST['level_num'])){#if at least one of the fields are no completed, no importation

                    $notification= "Veuillez entrer un numero de niveau valide afin d'importer des exercices";

                }else{

                    $level_label= htmlentities($_POST['level_label']);
                    $level_num= htmlentities($_POST['level_num']);

                    if($this->isAValidLevel($level_label, $level_num)){# if the level doesn't exist already.

                        try{
                            Db::getInstance()->insertLevel($level_label, $level_num);
                        }catch(PDOException $pdo){
                            $notification= 'une erreur est générée, importation non réussie: '.$pdo->getMessage();
                        }

                        foreach ($file as $index => $queryData) {

                            if ($index > 0) {

                                $queryValues = explode(';', $queryData);

                                foreach($queryValues as $index => $queryValue){
                                    $queryValues[$index]= $this->convertVoidToNull($queryValue);
                                }

                                $exercise= array($queryValues[0], $queryValues[1], $queryValues[2], $queryValues[3], $queryValues[4], $level_label, $level_num);

                                try {

                                    Db::getInstance()->insertQuery($exercise);
                                    $notification= 'Les queries ont été correctement importées dans le niveau '.$level_label.'.';

                                }catch(PDOException $pdo){
                                    Db::getInstance()->deleteLevel($level_label);
                                    $notification= "La base de donnée n'a pas pu executer votre requête.".'<br>'.
                                    "Veuillez vérifier la validité de votre fichier CSV.".'<br>'.
                                    "A titre informatif, voici l'erreur renvoyée par la DB:".'<br>'.$pdo->getMessage();
                                }
                            }
                        }

                    }else{
                        $notification= "Veuillez entrer un nom de niveau valide (non existant)";
                    }
                }
            }else{
                $notification= "The file must be a valid CSV file";
            }

        }else{
            $notification= "The file cannot be opened";
        }
    }

	require_once(PATH_VIEWS . "importCSV.php");

    }


    /**
     * @param $level the level input of the user
     * @return bool  true if the the level doesn't exist already, false if it already exist.
     */
    public function isAValidLevel($level_name, $num_level){

        $levels = Db::getInstance()->select_levels();
        foreach($levels as $index => $dbLevel){

            if($dbLevel->label()== $level_name)
                return false;

            if($dbLevel->num_level()== $num_level)
                return false;
        }
        return true;
    }


    /**
     * @param $queryValue A query field
     * @return string NULL if $queryValue is empty, his value else.
     */
    public function convertVoidToNull($queryValue){
        if(strcmp($queryValue, '') == 0)
            return 'NULL';
        else
            return trim($queryValue);
    }
}

?>
