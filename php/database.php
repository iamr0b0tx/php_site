<?php
require_once("constants.php");

class Database{
	private $values = array();

	public function __construct(){
		$this->connect();
	}
	
	function connect(){
		try{
		    $this->conn = new PDO("mysql:host=".DB_PARAMETERS['host'].";dbname=".DB_PARAMETERS['name'], DB_PARAMETERS['username'], DB_PARAMETERS['password']);

		    // set the PDO error mode to exception
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		}catch(PDOException $e){
		    echo "Connection failed: " . $e->getMessage();
		}
	}

	private function fetchAssoc($stmt): array{
		$data = array();
		foreach($stmt->fetchAll() as $k=>$v) { 
	        $data[$k] = $v;
	    }
		return $data;
	}

	private function prepareVariables($stmt, $values){
		foreach ($values as $column => $value) {
		    $stmt->bindParam(':'.$column, $this->values[$column]);
		    $this->values[$column] = $values[$column];
		}		
		return $stmt;
	}

	private function prepareValues($values): Array{
		$column_values = $columns = '';

		foreach ($values as $column => $value) {
			$columns .= $column.", ";		
			$column_values .= ":".$column." , ";

		}		
		
		$columns = substr($columns, 0, strlen($columns)-2);
		$column_values = substr($column_values, 0, strlen($column_values)-2);
		return array(trim($columns), trim($column_values));
	}

	public function insert($table, $values){
	    //prepare the variables
	    $prepared = $this->prepareValues($values);
		$columns = $prepared[0];
		$column_values = $prepared[1];

		try {
		    // prepare sql and bind parameters
		    $stmt = $this->conn->prepare("INSERT INTO $table ($columns) VALUES ($column_values)");
		    $stmt = $this->prepareVariables($stmt, $values);

		    // insert another row by execution
		    $stmt->execute();
		    return True;

		}catch(PDOException $e){
		    echo "Error: " . $e->getMessage();
		    return False;
		}
	}
	
	public function selectBy($table, $columns, $key, $selector_column){
		return $this->select($table, $columns, "id", "DESC", $key, $selector_column, "=", "", "");
	}

	public function selectById($table, $columns, $key){
		return $this->select($table, $columns, "id", "DESC", $key, "id", "=", "", "");
	}

	public function select($table, $columns, $order_column="id", $order="DESC", $key="", $selector_column="id", $condition="=", $start="", $num=""){

	    //prepare the variables
	    $LIMIT = '';
	    if(!empty($start) && !empty($num)){
	    	$LIMIT = "LIMIT $start, $num";
	    }

	    $WHERE = '';
	    if(!empty($key)){
	    	$WHERE = "WHERE $selector_column $condition $key";
	    }

	    try {
		    $stmt = $this->conn->prepare("SELECT $columns FROM $table $WHERE $LIMIT ORDER BY $order_column $order"); 
		    $stmt->execute();

		    // set the resulting array to associative
		    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		    $result = $this->fetchAssoc($stmt);
		    return $result;
		}
		catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
	}
}
$db = new Database();
?>