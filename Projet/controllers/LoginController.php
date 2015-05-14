<?php
class LoginController {
    public function __construct() {
    }
    public function run() {

        if (! empty ( $_SESSION ['authentifie'] )) {
            if($_SESSION ['type'] == 'student'){
                header("Location: index.php?action=homeStudent");
            }elseif ($_SESSION ['type'] == 'teacher'){
                header("Location: index.php?action=homeTeacher");

            }else {
                header ( "Location: index.php?action=login" );
                die ();
            }
        }


        $notification = '';

        if (empty ( $_POST )) {

            $notification = 'Authentifiez-vous';
        } elseif (Db::getInstance ()->valid_student ( (htmlentities ( $_POST ['login'] )), (htmlentities ( $_POST ['password'] )) )) {

            $_SESSION ['authentifie'] = 'autorise';
            $_SESSION ['login'] = $_POST ['login'];
            $_SESSION ['type']= 'student';

            header ( "Location: index.php?action=homeStudent" );
            die ();
        }
        elseif ( Db::getInstance ()->valid_teacher ( (htmlentities ( $_POST ['login'] )), (htmlentities ( $_POST ['password'] )) )) {

            $_SESSION ['authentifie'] = 'autorise';
            $_SESSION ['login'] = $_POST ['login'];
            $_SESSION ['type'] ='teacher';

            header ( "Location: index.php?action=homeTeacher" );
            die ();
        }


        require_once (PATH_VIEWS . 'login.php');
    }
}
?>