<?php

class ExportCSVController{

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

        $notification= "";

        $levels= Db::getInstance()->select_level();
        if(count($levels)== 0){
            $notification= "Il n'y a pas de niveaux à exporter, veuillez d'abord en importer avant d'essayer de les importer.";
        }else{
            if(isset($_POST['levelsToImport'])){
                $notification= "L'exportation a bien réussie!";
                $exportationTable= array();
                $csvFile= 'exercices_'.date("j.m.Y").'.csv';

                foreach($_POST['levelsToImport'] as $index => $selectedLevel){
                    $exportationTable[$index]= Db::getInstance()->select_exercise($selectedLevel);
                }

                $this->putInFile($exportationTable, $csvFile);

                if(file_exists($csvFile))//Forced download
                    header('Location:'.$csvFile);
            }
        }

        require_once(PATH_VIEWS.'export.php');

    }

    public function putInFile($levels, $fileName){
        try{
                $csvFile = fopen($fileName, 'w');
                fwrite($csvFile, "num;theme;enonce;query;nb\n");
                foreach ($levels as $index => $level) {
                foreach ($level as $index => $exercise) {
                    $line = $exercise->num_exercise() . ';' . $exercise->theme() . ';' . $exercise->statement() . ';' .
                        $exercise->query() . ';' . $exercise->nb_lines() . "\n";
                    fwrite($csvFile, $line);
                }
            }
        }catch(E_WARNING $exeption){
            echo "Une erreur s'est produite durant l'écrite du fichier, voici l'erreur renvoiée:".$exeption.error_get_last();
        }
    }
}

?>