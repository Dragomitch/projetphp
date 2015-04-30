
<?php
	# Activer le mécanisme des sessions
	session_start();

	# Prise du temps actuel au début du script
	$time_start = microtime(true);

	# Variables globales du site
	// constante(s)
	define ('PATH_VIEWS', 'views/' );
	define('MAIL','grimmonpre.romain@gmail.com');	
		$date = date("j/m/Y");
	
	# Require des classes automatisé pour la partie modèle de l'architecture
	function chargerClasse($classe) {
		require 'models/' . $classe . '.class.php';
	}
	spl_autoload_register('chargerClasse'); 

	#importer csv
	#require_once ('controllers/ImporterCSVController.php');
	#$controllerCSV=new ImporterCSVController();
	#$controllerCSV->run();
	
	# Ecrire ici le header de toutes pages HTML
	require_once (PATH_VIEWS . 'header.php');
	
	# Ecrire ici le menu du site de toutes pages HTML
	#require_once(PATH_VIEWS . 'menu.php');

	# Tester si une variable GET 'action' est précisée dans l'URL index.php?action=...
	$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';
	# Quelle action est demandée ?
	switch($action) {
		case 'homeStudent':
			require_once('controllers/AcceuilEleveController.php');	
			$controller = new AcceuilEleveController();
			break;
		case 'homeTeacher':
			require_once('controllers/AcceuilProfController.php');	
			$controller = new AcceuilProfController();
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
		case 'exercices':
			require_once('controllers/ExercicesController.php');	
			$controller = new ExercicesController();
			break;
		case 'first':
			require_once('controllers/FirstLoginController.php');	
			$controller = new FirstLoginController();
			break;	
		case 'importCSV':
			require_once('controllers/ImporterCSVController.php');
			$controller = new ImporterCSVController();
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