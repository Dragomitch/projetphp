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


        $this->_db = new PDO('mysql:host=localhost;dbname=sitephp', 'root', '210993');
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
        if( $_FILES['CSVfile']['tmp_name'] !=  ''){
            $tableau= array();
            $file= file($_FILES['CSVfile']['tmp_name']);
            if(preg_match('/"Matric Info";"Nom Etudiant";"Prénom Etudiant"/',$file[0])){
                foreach($file as $index => $studentData){
                    if($index> 0){
                        $valuesTable= explode(';', $studentData);
                        Db::getInstance()->insertStudent($valuesTable);
                    }
                }

            }elseif(preg_match('/login;nom;prenom/',$file[0])){
                foreach($file as $index => $teacherData){
                    if($index> 0){
                        $valuesTable= explode(';', $teacherData);
                        Db::getInstance()->insertTeacher($valuesTable);
                    }
                }
            }else{
                $notification= "The file must be a valid CSV file";
            }



        }else{
            $notification= "The file cannot be opened";
        }
    }

    /*//Access path
	$file_teacher   = fopen($rep.$teachers, "r");
 	
	//tant qu'on est pas a la fin du fichier :
	while (!feof($file_teacher))
	{
	// On recupere toute la ligne
	$uneLigne = addslashes(fgets($file_teacher));
	
	//On met dans un tableau les differentes valeurs trouvés (ici séparées par un ';')
	$tableauValeurs = explode(';', $uneLigne);
	// On crée la requete pour inserer les donnees
	//$sql="INSERT IGNORE INTO 'teachers' ('login', 'first_name', 'last_name', 'password') VALUES ('".$tableauValeurs[0]."', '".$tableauValeurs[1]."', '".$tableauValeurs[2]."','.NULL')";
 	$sql="INSERT IGNORE INTO 'teachers' ('login', 'first_name', 'last_name') VALUES (':login', ':first_name', ':last_name')";
	$this->_db->prepare($sql)->execute();
	}
	
	$file_student =fopen($rep.$students ,"r" );
	while (!feof($file_student))
	{
		// On recupere toute la ligne
		$uneLigne = addslashes(fgets($file_student));
	
		//On met dans un tableau les differentes valeurs trouvés (ici séparées par un ';')
		$tableauValeurs = explode(';', $uneLigne);
		// On crée la requete pour inserer les donnees
		try{ 
			//$sql="INSERT IGNORE INTO 'students' ('login', 'first_name', 'last_name', 'password','last_connection') VALUES ('".$tableauValeurs[0]."', '".$tableauValeurs[1]."', '".$tableauValeurs[2]."','.NULL.','.NULL')";
			$sql="INSERT IGNORE INTO 'students' ('login', 'first_name', 'last_name') VALUES (':login', ':first_name', ':last_name')";
			
			//$this->_db->prepare($sql)->execute();
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':login', $tableauValeurs[0]);
			$stmt->bindParam(':first_name', $tableauValeurs[1]);
			$stmt->bindParam(':last_name', $tableauValeurs[2]);
			$stmt->execute();
		}catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}
		
	}*/

	require_once(PATH_VIEWS . "importerCSV.php");

    }

    public function testCSValide($fileName){
        //TODO verify mime-type of file and if file is correct
    }
}
?>
