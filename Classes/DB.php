<?php

/**
 * PDO Wrapper
 * Class DB
 *
 **/


class DB
{
	private static $db_instance = null;
	private $connection;
	private $query;
	private $results;
	private $count = 0;
	private $error = false;


	public function __construct(){
		// connection to DD
		try {
			// creating connection using Config class to obtain needed data.
			$this->connection = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),
				Config::get('mysql/username'),
				Config::get('mysql/password'));

		} catch(PDOException $e) {

			die($e->getMessage());

		}
	}
	// using singleton pattern with this PDO db wrapper.
	// if there no instance of DB creates new DB  instance. Else create new.
	public static function getInstance(){
		if(!isset(self::$db_instance)){
			return self::$db_instance = new DB();
		}
		return self::$db_instance;
	}



	public function QueryExecute($sql, $parameters = array()){
		// setting error flag to false
		$this->error = false;
		// praparing a query..
		$this->query = $this->connection->prepare($sql);
		// now checking if any parameters for binding were supplied
		$counter = 1;
		if(count($parameters)){
			foreach ($parameters as $parameter){
				// bindValue - Binds a value to a corresponding named or question mark placeholder in the SQL
				// statement that was used to prepare the statement.
				// example SELECT * FROM users WHERE username = ? AND email = ?
				// $parameters = array('alex','admin@admin.com');
				// this function will replace question marks to provided values.
				$this->query->bindValue($counter,$parameter);
				$counter++;
			}
		}
		// after binding executing a query
		if($this->query->execute()){
			// if executing successful storing results as object
			$this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
			// also updating count property
			$this->count = $this->query->rowCount();
		}
		else{
			$this->error = true;
		}
		return $this;

	}


	 private function action($action,$table,$where = array()){
		// here we checking if where clause has 3 items field - operator - value like that WHERE('username','=','user')
		if(count($where) === 3){
			// list of allowed oparators
			$operators = array('=','<>','<','>','<=','>=');
			// position in array for each of field, oparator and value is static.
			$field = $where[0] ;
			$operator =$where[1] ;
			$value = $where[2];
			// checking if operator is allowed to be used
			if(in_array($operator,$operators)){
				// building an SQL statement
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				// for binding and executing we can use our QueryBuilder method
				$this->QueryExecute($sql,array($value));
				if(!$this->error()){
					return $this;
				}
			}

		}
		return false;
	 }


	 public function get($table,$where){
		return $this->action('SELECT *',$table,$where);
	 }

	 public function insert($table,$fields = array()){
	 	// check if fields not empty
	 	if(count($fields)){
		    $keys = array_keys($fields);
		    $values = '';
		    $counter = 1;
			// generating needed amount of question marks for binding
		    foreach ($fields as $field){
		    	$values .= '?';
		    	if($counter < count($fields)){
		    		$values .= ', ';
			    }
			    $counter++;
		    }
			// constructing a query...
		    $sql = "INSERT INTO {$table} (`". implode('`, `',$keys) ."`) VALUES ({$values})";
			// after this we have valid sql query and we can execute it using QueryBuilder method
		    $this->QueryExecute($sql,$fields);
		    if(!$this->error()){
		    	return true;
		    }
	    }
	    return false;
	 }

	// getter for Errors
	public function error(){
		return $this->error;
	}

	// getter for count
	public function count(){
		return $this->count;
	}

	// getter for results
	public function results(){
		return $this->results;
	}
}