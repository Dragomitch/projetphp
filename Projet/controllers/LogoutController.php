<?php
class LogoutController{

    public function __construct() {

    }

    public function run(){
        #emptying the session array
        $_SESSION = array();


        session_destroy();

        #this controller doesn't show any view, it just redirect to the index.
        header("Location: index.php");
        die();
    }

}
