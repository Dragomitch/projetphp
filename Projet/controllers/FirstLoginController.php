<?php
class FirstLoginController{

    public function __construct() {

    }

    public function run(){
       
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=login"); 
            die();
        }

        
        $notification='';
        $notification='Authentifiez-vous';
        
        if (empty($_POST)) {
        
            $notification='Authentifiez-vous';
        } elseif (htmlentities($_POST['password'])== htmlentities($_POST['motdepasseconfirme'])){
            
        	Db::getInstance()->update_mdp_Student((htmlentities($_POST['login'])), htmlentities($_POST['password']));
            
        	Db::getInstance()->update_mdp_Teacher((htmlentities($_POST['login'])), htmlentities($_POST['password']));
            header("Location: index.php?action=login");
            die();

        }else{
        	$notification='Authentification non réussi !';
        
        
        }


        
        require_once(PATH_VIEWS . 'firstlogin.php');

    }
}