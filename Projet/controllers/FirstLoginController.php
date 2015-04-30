<?php
class FirstLoginController{

	public function __construct() {

	}

	public function run(){
		# Si un distrait écrit ?action=login en étant déjà authentifié
		if (!empty($_SESSION['authentifie'])) {
			header("Location: index.php?action=login"); # redirection HTTP vers l'action login
			die();
		}

		# Variables HTML dans la vue
		$notification='';

		# L'utilisateur s'est-il bien authentifié ?
		if (empty($_POST)) {
			# L'utilisateur doit remplir le formulaire
			$notification='Authentifiez-vous';
		} elseif (htmlentities($_POST['password'])== htmlentities($_POST['motdepasseconfirme'])){
			Db::getInstance()->update_mdp_Student((htmlentities($_POST['login'])), htmlentities($_POST['password']));
			Db::getInstance()->update_mdp_Teacher((htmlentities($_POST['login'])), htmlentities($_POST['password']));
			header("Location: index.php?action=login");
			die();	
			
		}else{
			# L'utilisateur doit remplir le formulaire
			$notification='Authentifiez-vous';
		}

			
			# Ecrire ici la vue
			require_once(PATH_VIEWS . 'firstlogin.php');
				
	}
}