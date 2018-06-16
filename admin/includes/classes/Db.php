<?php

/**
* Database Class
*/

class Database {


	public $connection;


	public function __construct(){
		$this->con();
	}



	public function con(){

		// Database connection
		$this->connection = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);

		if ($this->connection->connect_errno){
			die("Failed to connect to MySQL Database: " . $this->connection->connect_error);
		}

		return $this->connection;
	}



	public function query($sql){

		$result = $this->connection->query($sql);
		$this->confirm_query($result);

		return $result;
	}



	private function confirm_query($result){

		if (!$result) { die('Query is wrong. ' . $this->connection->error); }
	}



	public function escape_string($string){

		$string = $this->connection->real_escape_string($string);
		$string = trim($string);
	    $string = htmlspecialchars($string);

	    if (empty($string)) {
	        return false;
	    }

		return $string;
	}



	public function escape_special($string){

		return  preg_replace('/[^a-zA-Z0-9]/', '', $string);
	}



	public function inserted_id(){

		return $this->connection->insert_id;
	}



	protected function properties(){

		$properties = [];

		foreach (static::$columns as $column) {

			if (property_exists($this,$column)) {

				$properties[$column] = $this->$column;
			}
		}

		return $properties;
	}



	protected function cleanProperties(){

		$clean = [];

		foreach ($this->properties() as $key => $value) {
			$clean[$key] = $this->escape_string($value);
		}

		return $clean;
	}



	public function save(){

		return isset($this->id) ? $this->update() : $this->create();
	}



	public function create(){

		$properties = $this->cleanProperties();

		$sql = "INSERT INTO " . static::$db_table . " (" . implode(',',array_keys($properties)) . ") VALUES (
		'" . implode("','",array_values($properties)) . "')";

	    if ($this->query($sql)) {

	    	$this->id = $this->inserted_id();
	    	return true;

	    } else { return false; }

	    $this->connection->close();
	}



	public function update(){

		$properties = $this->cleanProperties();
		$property_pairs = [];

		foreach ($properties as $key => $value) {

			$property_pairs[] = "{$key}='{$value}'";
		}

		$sql = "UPDATE " . static::$db_table . " SET " . implode(', ',$property_pairs) . " WHERE id= " . $this->escape_string($this->id);

		$this->query($sql);

	    return ($this->connection->affected_rows) == 1 ? true : false;
	    $this->connection->close();
	}



	public function delete(){

		$sql = "DELETE FROM " . static::$db_table . " WHERE id= " . $this->escape_string($this->id);
		$this->query($sql);

	    return ($this->connection->affected_rows) == 1 ? true : false;
	    $this->connection->close();
	}



	public static function fetchAll(){

		return static::findQuery('SELECT * FROM ' . static::$db_table);
		$this->connection->close();
	}



	public static function fetchById($id = 0){

		$result = static::findQuery('SELECT * FROM ' . static::$db_table . ' WHERE id='.$id);
		
		return !empty($result) ? array_shift($result) : false;

		$this->connection->close();
	}


	
	public static function findQuery($sql){

		global $database;
		$result = $database->query($sql);
		$object_array = [];

		while ($row = mysqli_fetch_array($result)) {

			$object_array[] = static::instantiation($row);
		}

		return $object_array; 
	}



	public static function countRecords() {

		global $database;
		$sql = 'SELECT * FROM ' . static::$db_table;
		$result = $database->query($sql);

		return $result->num_rows;
	}



	public static function instantiation($record){

		$called_class = get_called_class();
		$object = new $called_class;

		foreach ($record as $property => $value) {

			if ($object->has_attribute($property)) {
				$object->$property = $value;
			}
		}

		return $object;
	}




	private function has_attribute($attribute){

		$object_properties = get_object_vars($this);
		return array_key_exists($attribute, $object_properties);
	}




	public static function uploadErrors($file,$errors_array = []) {

		switch ($file) {

            case UPLOAD_ERR_INI_SIZE:
                $errors_array[] = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $errors_array[] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $errors_array[] = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $errors_array[] = "No file chosen";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $errors_array[] = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $errors_array[] = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $errors_array[] = "File upload stopped by extension";
                break;
            default:
                $errors_array[] = "Unknown upload error";
                break;
        }

        return $errors_array;
	}
}


$database = new Database;