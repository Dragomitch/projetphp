<?php
# Activer le mécanisme des sessions
session_start();
# Prise du temps actuel au début du script
$time_start = microtime(true);
# Variables globales du site
$timestamp= mktime(9,17,0,5,12,2015);
// constante(s)
define ('PATH_VIEWS', 'views/' );
define('MAIL','grimmonpre.romain@gmail.com');
$date = date("j/m/Y");
# Require des classes automatisé pour la partie modèle de l'architecture
function chargerClasse($classe) {
    if(is_readable('models/'.$classe.'.class.php'))require 'models/' . $classe . '.class.php';
    else   var_dump($classe);
}
spl_autoload_register('chargerClasse');
# Ecrire ici le header de toutes pages HTML
require_once (PATH_VIEWS . 'header.php');

# Ecrire ici le menu du site de toutes pages HTML
// 	if ( empty ( $_SESSION ['authentifie'] ) ){
// 		header("Location: index.php?action=login");
// 		die();
// 	}elseif($_SESSION['type'] != 'teacher') {
// 		require_once(PATH_VIEWS.'headerteachers.php');
// 	}

/*import the students if a csv file 'etudiants.csv' is in the directory CSV
 *This is used for the creation of the site. Dont use it for anything else. */
if(file_exists('CSV/etudiants.csv')){
    $file= file('CSV/etudiants.csv');
    foreach($file as $index => $studentData){
        if($index> 0){
            $valuesTable= explode(';', $studentData);
            Db::getInstance()->insertStudent($valuesTable);
        }
    }
    unlink('CSV/etudiants.csv');
}
/*import the teachers if a csv file 'professeurs.csv' is in the directory CSV
 *This is used for the creation of the site. Dont use it for anything else. */
if(file_exists('CSV/professeurs.csv')){
    $file= file('CSV/professeurs.csv');
    foreach($file as $index => $teacherData){
        if($index> 0){
            $valuesTable= explode(';', $teacherData);
            Db::getInstance()->insertTeacher($valuesTable);
        }
    }
    unlink('CSV/professeurs.csv');
}


# Tester si une variable GET 'action' est précisée dans l'URL index.php?action=...

/*import the students if a csv file 'etudiants.csv' is in the directory CSV
 *This is used for the creation of the site. Dont use it for anything else. */
if(file_exists('CSV/etudiants.csv')){
    $file= file('CSV/etudiants.csv');
    foreach($file as $index => $studentData){
        if($index> 0){
            $valuesTable= explode(';', $studentData);
            Db::getInstance()->insertStudent($valuesTable);
        }
    }
    unlink('CSV/etudiants.csv');
}
/*import the teachers if a csv file 'professeurs.csv' is in the directory CSV
 *This is used for the creation of the site. Dont use it for anything else. */
if(file_exists('CSV/professeurs.csv')){
    $file= file('CSV/professeurs.csv');
    foreach($file as $index => $teacherData){
        if($index> 0){
            $valuesTable= explode(';', $teacherData);
            Db::getInstance()->insertTeacher($valuesTable);
        }
    }
    unlink('CSV/professeurs.csv');
}

$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';
# Quelle action est demandée ?
switch($action) {
    case 'homeStudent':
        require_once('controllers/AcceuilEleveController.php');
        $controller = new AcceuilEleveController();
        break;
    case 'homeTeacher':
        require_once('controllers/HomeTeacherController.php');
        $controller = new HomeTeacherController();
        break;
    case 'logout':
        require_once('controllers/DeconnexionController.php');
        $controller = new DeconnexionController();
        break;
    case 'ExportCSV':
        require_once('controllers/ExporterCSVController.php');
        $controller = new ExporterCSVController();
        break;
    case 'login':
        require_once('controllers/LoginController.php');
        $controller = new LoginController();
        break;
    case 'level':
        require_once('controllers/LevelController.php');
        $controller = new LevelController();
        break;
    case 'exercices':
        require_once ('controllers/ExercisesController.php');
        $controller = new ExercisesController();
        break;
    case 'first':
        require_once('controllers/FirstLoginController.php');
        $controller = new FirstLoginController();
        break;
    case 'importCSV':
        require_once('controllers/ImportCSVController.php');
        $controller = new ImportCSVController();
        break;
    case 'uploadCSV':
        require_once('controllers/UploadCVSController.php');
        $controller= new UploadCSVController();
        break;
    case 'studentList':
        require_once('controllers/ListeEtudiantController.php');
        $controller = new ListeEtudiantController();
        break;
    case 'modifExercice':
        require_once('controllers/modifExerciceController.php');
        $controller = new modifExerciceController();
        break;
    case 'studentStat':
        require_once('controllers/StatEtudiantController.php');
        $controller = new StatEtudiantController();
        break;
    case 'studentEx':
    	require_once ('controllers/ShowStudentExController.php');
    	$controller = new ShowStudentExController();
    	break;    

    default: # Par défaut, le contrôleur de l'accueil est sélectionné
        require_once('controllers/LoginController.php');
        $controller = new LoginController();
        break;
}
# Exécution du contrôleur correspondant à l'action demandée
$controller->run();

# Ecrire ici le footer du site de toutes pages HTML
require_once(PATH_VIEWS . 'footer.php');

?>