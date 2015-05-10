<?php
class ImportCSVController{
	public function __construct(){
		
	}

    /**
     *
     */
    public function run(){

        if ( empty ( $_SESSION ['authentifie'] ) ){
            header("Location: index.php?action=login");
            die();
        }elseif($_SESSION['type'] != 'teacher') {
            header ( "Location: index.php?action=homeStudent" ); // redirection HTTP vers l'action login
            die ();
        }

         $rep = 'CSV/';
		 $teachers = 'professeurs.csv';
		 $students ='etudiants.csv';
         $notification= '';


        $this->_db = new PDO('mysql:host=localhost;dbname=sitephp', 'root', '210993');#
        /*try{
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if(!isset($_FILES['CSVfile']['error'])|| is_array($_FILES['CSVfile']['error'])){
                throw new RuntimeException('Invalid parameters');
            }

            switch ($_FILES['CSVfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            if ($_FILES['CSVfile']['size'] > 1000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }
            
            // DO NOT TRUST $_FILES['CSVfile']['mime'] VALUE !! //TODO demander ce que ca fait ( ce que  contient ['mime']
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);//TODO demander ce que ca fait
            if (false === $ext = array_search(
                    $finfo->file($_FILES['CSVfile']['tmp_name']),
                    array(
                        'gif' => 'image/gif',
                        ''
                    ),
                    true
                )) {
                throw new RuntimeException('Invalid file format.');
            }
            

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            if (!move_uploaded_file(
                $_FILES['CSVfile']['tmp_name'],
                sprintf('./uploads/%s.%s',
                    sha1_file($_FILES['CSVfile']['tmp_name']),
                    $ext
                )
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            echo 'File is uploaded successfully.';

        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }*/
    if(!empty($_FILES['CSVfile'])){
        if( $_FILES['CSVfile']['tmp_name'] !=  ''){//TODO rajouter notifications
            $tableau= array();
            $file= file($_FILES['CSVfile']['tmp_name']);
            if(preg_match('/"Matric Info";"Nom Etudiant";"Prénom Etudiant"/',$file[0])){
                foreach($file as $index => $studentData){
                    if($index> 0){
                        $valuesTable= explode(';', $studentData);
                        Db::getInstance()->insertStudent($valuesTable);
                    }
                }

            }elseif(preg_match('/login;nom;prenom/',$file[0])){ //TODO rajouter notifications
                foreach($file as $index => $teacherData){
                    if($index> 0){
                        $valuesTable= explode(';', $teacherData);
                        Db::getInstance()->insertTeacher($valuesTable);
                    }
                }
            }elseif (preg_match('/num;theme;enonce;query;nb/', $file[0])) {
                if(empty($_POST['level_label'])){
                    $notification= "Veuillez entrer un numero de niveau valide afin d'importer des exercices";
                }else{
                    $level_label= htmlentities($_POST['level_label']);
                    if($this->isAValidLevelName($level_label)){
                        Db::getInstance()->insertLevel($level_label);
                        foreach ($file as $index => $queryData) {
                            if ($index > 0) {

                                $queryValues = explode(';', $queryData);
                                foreach($queryValues as $index => $queryValue){
                                    $queryValues[$index]= $this->convertVoidToNull($queryValue);
                                }

                                $exercise= array($queryValues[0], $queryValues[1], $queryValues[2], $queryValues[3], $queryValues[4], $level_label);

                                try {

                                    Db::getInstance()->insertQuery($exercise);
                                    $notification= 'Les queries ont été correctement importées dans le niveau '.$level_label.'.';

                                }catch(PDOException $pdo){
                                    Db::getInstance()->deleteLevel($level_label);
                                    $notification= "La base de donnée n'a pas pu executer votre requête.
                                    Elle renvoie l'erreur suivante:".'<br>'.$pdo.error_get_last();
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

	require_once(PATH_VIEWS . "importerCSV.php");

    }

    public function testCSValide($fileName){
        //TODO verify mime-type of file and if file is correct
    }

    /**
     * @param $level the level input of the user
     * @return bool  true if the the level doesn't exist already, false if it already exist.
     */
    public function isAValidLevelName($level){

        $levels = Db::getInstance()->select_level();
        foreach($levels as $index => $dbLevel){

            if($dbLevel->label()== $level){
                return false;
            }

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
