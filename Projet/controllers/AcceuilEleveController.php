<?php

class AcceuilEleveController{

	public function __construct() {

	}
		
	public function run(){
		if ( empty ( $_SESSION ['authentifie'] ) ){
			header("Location: index.php?action=login");
			die();
		}elseif($_SESSION['type'] != 'student') {
			header ( "Location: index.php?action=homeTeacher" ); // redirection HTTP vers l'action login
			die ();
		}
		# Un contrôleur se termine en écrivant une vue
		require_once(PATH_VIEWS . 'acceuileleve.php');
	}

}
?>