<?php
class LoginController {
	public function __construct() {
	}
	public function run() {
		// Si un distrait écrit ?action=login en étant déjà authentifié
		if (! empty ( $_SESSION ['authentifie'] )) {
			header ( "Location: index.php?action=login" ); // redirection HTTP vers l'action login
			die ();
		}
		
		// Variables HTML dans la vue
		$notification = '';
		// L'utilisateur s'est-il bien authentifié ?
		if (empty ( $_POST )) {
			// L'utilisateur doit remplir le formulaire
			$notification = 'Authentifiez-vous';
		} elseif (Db::getInstance ()->valid_student ( (htmlentities ( $_POST ['login'] )), (htmlentities ( $_POST ['password'] )) )) {
			// $notification='Vos données d\'authentification ne sont pas correctes.';
			// L'authentification n'est pas correcte
			// L'utilisateur est bien authentifié
			// Une variable de session $_SESSION['authenticated'] est créée
			$_SESSION ['authentifie'] = 'autorise';
			$_SESSION ['login'] = $_POST ['login'];
			// Redirection HTTP pour demander la page admin
			header ( "Location: index.php?action=homeStudent" );
			die ();
		} 
		elseif ( Db::getInstance ()->valid_teacher ( (htmlentities ( $_POST ['login'] )), (htmlentities ( $_POST ['password'] )) )) {
		//	$notification = 'Vos données d\'authentification ne sont pas correctes.';
			// L'utilisateur est bien authentifié
			// Une variable de session $_SESSION['authenticated'] est créée
			$_SESSION ['authentifie'] = 'autorise';
			$_SESSION ['login'] = $_POST ['login'];
			// Redirection HTTP pour demander la page admin
			header ( "Location: index.php?action=homeTeacher" );
			die ();
		}
		
		// Ecrire ici la vue
		require_once (PATH_VIEWS . 'login.php');
	}
}
?>