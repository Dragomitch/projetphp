<?php
class ImporterCSVController{
	public function __construct(){
		
	}

    /**
     *
     */
    public function run(){

         $rep = 'CSV/';
		 $teachers = 'professeurs.csv';
		 $students ='etudiants.csv';
		 
 
	$this->_db = new PDO('mysql:host=localhost;dbname=sitephp', 'root', '');
	
    if(isset($_FILES['CSVfile'])){
        var_dump($_FILES['CSVfile']);
    }else{
        echo 'coucou';
    }
	//Access path
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
		
	}

	require_once(PATH_VIEWS . "importerCSV.php");
	
}
}
?>
