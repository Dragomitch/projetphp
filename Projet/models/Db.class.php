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

        $query="INSERT INTO teachers (login, first_name, last_name) VALUES (:login, :first_name, :last_name)";
        $statement = $this->_db->prepare($query);
        $statement->bindParam(':login', $array[0]);
        $statement->bindParam(':first_name', $array[1]);
        $statement->bindParam(':last_name', $array[2]);
        $statement->execute();

    }

    public function insertStudent($array){

        $query="INSERT INTO students (matricule, first_name, last_name) VALUES (:matricule, :first_name, :last_name)";
        $statement= $this->_db->prepare($query);
        $statement->bindParam(':matricule', $array[0]);
        $statement->bindParam(':first_name', $array[1]);
        $statement->bindParam(':last_name', $array[2]);
        $statement->execute();

    }

	public function insertQuery($exercise){
        $query= 'SELECT level FROM levels WHERE label='.$this->_db->quote($exercise[5]);
        $resultat= $this->_db->query($query);
        $row= $resultat->fetch();
        $level= $row->level;

        $query= 'INSERT INTO exercises (number, theme, statement, query, nb_lines, num_exercise, num_level)
                  VALUES (DEFAULT, :theme, :statement, :query, :nb_lines, :num_exercise, :level)';

        $statement= $this->_db->prepare($query);

        $defaultLabel= $level.'_'.$exercise[0];

        $statement->bindParam(':num_exercise', $exercise[0]);
        $statement->bindParam(':theme', $exercise[1]);
        $statement->bindParam(':statement', $exercise[2]);
        $statement->bindParam(':query', $exercise[3]);
        $statement->bindParam(':nb_lines', $exercise[4]);
        $statement->bindParam(':level', $level);
    

        $statement->execute();
    }

    public function deleteLevel($level_label){
        //$query= 'DELETE ' //todo delete le level et les exercices
    }

    
    	public function insertLevel($level_label, $level_num){
    		        $query= 'INSERT INTO levels (level, num_level, label) VALUES (DEFAULT,'.$level_num.','.$this->_db->quote($level_label).')';
    		        $this->_db->prepare($query)->execute();
    		
    		        /*$lastInsert= $this->_db->lastInsertId();
    		        $query= "UPDATE levels SET num_level=".$lastInsert." WHERE level=".$lastInsert;
    		     $this->_db->prepare($query)->execute();*/
    	
    	

    }

	public function valid_teacher($login,$password){
		$query = 'SELECT * from teachers WHERE login='.$this->_db->quote($login).' AND password='.$this->_db->quote(sha1($password));
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
		$query = 'UPDATE students SET password= '.$this->_db->quote(sha1($password)).' WHERE matricule=' .$this->_db->quote($matricule).'AND password is NULL';
		$this->_db->prepare($query)->execute();
	#toDo secure password modification !
	}
	
				
		public function update_mdp_Teacher($login,$password) {	
		$query = 'UPDATE `sitephp`.`teachers` SET `password`= SHA1('.$this->_db->quote($password).') WHERE `teachers`.`login`=' .$this->_db->quote($login).'AND password is NULL';
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
	public function select_name_student($matricule){
		$query = 'SELECT * FROM `sitephp`.`students` WHERE `sitephp`.`students`.`matricule`='.$this->_db->quote($matricule);
		$tableau=array();
		$result = $this->_db->query($query);
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
				$tableau[] = new Exercises($row->author,$row->last_modification,$row->nb_lines,$row->number,$row->num_exercise,$row->num_level,$row->query,$row->statement,$row->theme);
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
				$tableau[] = new Levels($row->label,$row->level,$row->num_level);
			}
		}
	
		return $tableau;
	}
	public function select_num_level($level){
		$query = 'SELECT * FROM levels where level='.$this->_db->quote($level);
		$tableau = array();
		$result =$this->_db->query($query);
		if ($result->rowcount()!=0) {
			while ($row = $result->fetch()) {
				$tableau[] = new Levels($row->label,$row->level,$row->num_level);
			}
		}
	
		return $tableau;
	}
	
    public function save_answer($matricule,$question_num,$answer){
	$select_answer='SELECT * FROM `sitephp`.`students_answers` WHERE student='.$this->_db->quote($matricule).' AND exercise='.$this->_db->quote($question_num).'';
	$result = $this->_db->query($select_answer);
    	if ($result->rowcount()!=0){
    		$query_update='UPDATE `sitephp`.`students_answers` SET answer_query ='.$this->_db->quote($answer).' WHERE student='.$this->_db->quote($matricule).' AND exercise='.$this->_db->quote($question_num).'';
    		$this->_db->prepare($query_update)->execute();
    	}else{
    		$query_insert='INSERT INTO `sitephp`.`students_answers` (`number`, `answer_query`, `exercise`, `student`) VALUES (NULL,'.$this->_db->quote($answer).','.$this->_db->quote($question_num).','.$this->_db->quote($matricule).')';
    		$this->_db->prepare($query_insert)->execute();
    	}
  
    }
    
  
    

    public function select_answer($matricule,$question_num){
        $query ='SELECT * FROM `students_answers` WHERE `exercise`='.$this->_db->quote($question_num).'AND `student`='.$this->_db->quote($matricule).'';
        $result =$this->_db->query($query);
		$tableau=array();
        if ($result->rowcount()!=0) {
            while ($row = $result->fetch()) {
                $tableau[] = new students_answers($row->number, $row->answer_query, $row->exercise, $row->student);
            }
        }

        return $tableau;
    }
    
    public function select_all_answer_student($matricule){
    	$query ='SELECT * FROM `students_answers` WHERE `student`='.$this->_db->quote($matricule).'';
    	$result =$this->_db->query($query);
    	$tableau=array();
    	if ($result->rowcount()!=0) {
    		while ($row = $result->fetch()) {
    			$tableau[] = new students_answers($row->number, $row->answer_query, $row->exercise, $row->student);
    		}
    	}
    	
    	return $tableau;
    	
    }
    
    public function show_answer_DB($answer){
    	/*$query=$answer;
    	$result =$this->_db->query($query);
    	if ($result->rowcount()!=0) {
    		return $result;
    	}*/
    	
    	$query = $answer;
    	$fetch_type = PDO::FETCH_ASSOC;
    	$result = $this->_db->query($query);
    	var_dump($query);
    	$rows = $result->fetchAll($fetch_type);
    	$columns = empty($rows) ? array() : array_keys($rows[0]);
		
    	return $rows;
    	
   	
    }
    public function getColumnsNames($query_send){
    	$query = $query_send;
    	$fetch_type = PDO::FETCH_ASSOC;
    	$result = $this->_db->query($query);
    	$rows = $result->fetchAll($fetch_type);
    	$columns = empty($rows) ? array() : array_keys($rows[0]);
    	return $columns;
    }
    
    public function update_query($query_update,$author,$num_exercise,$nb_lines,$num_level,$statement,$theme) {
    	$query = 'UPDATE `sitephp`.`exercises` SET `query`= '.$this->_db->quote($query_update).',`statement`= '.$this->_db->quote($statement) .',`author`= '.$this->_db->quote($author) .',`theme`= '.$this->_db->quote($theme) .',`nb_lines`= '.$this->_db->quote($nb_lines) .' WHERE  `exercises`.`num_exercise`='.$this->_db->quote($num_exercise).'';
    	$this->_db->prepare($query)->execute();
    }
}