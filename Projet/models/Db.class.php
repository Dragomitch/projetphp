<?php
class Db
{
    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=sitephp', 'root', '');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        } 
		catch (PDOException $e) {
		    die('Erreur de connexion à la base de données : '.$e->getMessage());
        }
    }

	# Pattern Singleton
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

	public function valid_teacher($login,$password){
		$query = 'SELECT * from teachers WHERE login='.$this->_db->quote($login).' AND password='.$this->_db->quote(sha1($password));
		var_dump($query);
        $result = $this->_db->query($query);
		$authenticated = false;
		if ($result->rowcount()!=0) {
			$authenticated = true;
		}
		return $authenticated;
	}
	
	public function valid_student($matricule,$password){
		$query = 'SELECT * from students WHERE matricule='.$this->_db->quote($matricule).' AND password='.$this->_db->quote(sha1($password));
		$result = $this->_db->query($query);
		$authenticated = false;
		if ($result->rowcount()!=0) {
			$authenticated = true;
		}
		return $authenticated;
	}
    
	public function update_mdp_Student($matricule,$password) {
		$query = 'UPDATE students SET password= '.$this->_db->quote(sha1($password)).' WHERE matricule=' .$this->_db->quote($matricule).'';
		$this->_db->prepare($query)->execute();
	
	}
	
				
		public function update_mdp_Teacher($login,$password) {	
		$query = 'UPDATE `sitephp`.`teachers` SET `password`= SHA1('.$this->_db->quote($password).') WHERE `teachers`.`login`=' .$this->_db->quote($login).'';
		$this->_db->prepare($query)->execute();
	}
	
	
	public function select_students(){
		$query = 'SELECT * FROM students';
		$tableau = array();
		$result =$this->_db->query($query);
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {
				$tableau[] = new Utilisateur($row->matricule,$row->first_name,$row->last_name,$row->password,$row->last_connection);
						}
		}
		
		return $tableau;
	}
	
	
}