<?php
class Db
{
    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=sitephp', 'root', '');#210993
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

        public function insertTeacher($array) {

        $sql="INSERT INTO teachers (login, first_name, last_name) VALUES (:login, :first_name, :last_name)";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':login', $array[0]);
        $stmt->bindParam(':first_name', $array[1]);
        $stmt->bindParam(':last_name', $array[2]);
        $stmt->execute();

    }

    public function insertStudent($array){

        $sql="INSERT INTO students (matricule, first_name, last_name) VALUES (:matricule, :first_name, :last_name)";
        $stmt= $this->_db->prepare($sql);
        $stmt->bindParam(':matricule', $array[0]);
        $stmt->bindParam(':first_name', $array[1]);
        $stmt->bindParam(':last_name', $array[2]);
        $stmt->execute();

    }

	public function insertQuery($exercise, $num_level){
    	new Exercises($row->author,$row->label,$row->last_modification,$row->nb_lines,$row->number,$row->num_exercise,$row->num_level,$row->query,$row->statement,$row->theme);

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
	#toDo secure password modification !
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
				$tableau[] = new Student($row->matricule,$row->first_name,$row->last_name,$row->password);
						}
		}
		
		return $tableau;
	}
	
	public function select_exercise($level){
		$query = 'SELECT * FROM exercises where num_level='.$this->_db->quote($level).'';
		$tableau = array();
		$result =$this->_db->query($query);
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {
				$tableau[] = new Exercises($row->author,$row->label,$row->last_modification,$row->nb_lines,$row->number,$row->num_exercise,$row->num_level,$row->query,$row->statement,$row->theme);
			}
		}
	
		return $tableau;
	}

	public function select_level(){
		$query = 'SELECT * FROM levels';
		$tableau = array();
		$result =$this->_db->query($query);
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {
				$tableau[] = new Levels($row->label,$row->level);
			}
		}
	
		return $tableau;
	}
}