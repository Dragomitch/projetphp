<?php
class ExercicesController{
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
		#call the view
		require_once (PATH_VIEWS .'exercices.php');
	}
}