<?php
/**
 * Jiraya MVC Framework
 *
 * LICENSE
 * Este arquivo fonte está sujeito a nova licença BSD que é fornecido
 * com este pacote no arquivo LICENSE.txt.
 *
 * @category   Jiraya
 * @package    DbTable
 * @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
 */

class DbTable
{
	private static $PDOInstance;
	
	protected $_name;
	
	public function __construct()
	{
		if(!self::$PDOInstance)
		{
			try {
				//new PDO('mysql:host=localhost;dbname=nome_do_banco', 'username', 'password');
				self::$PDOInstance = new PDO(
					Application::$config['db']['adapter'].":host=".Application::$config['db']['host'].";dbname=".Application::$config['db']['dbname'],
					Application::$config['db']['username'],
					Application::$config['db']['password']
					);
					self::$PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
			}
		}
		return self::$PDOInstance;
	}
	
	public static function getInstance()
	{
		if(!isset(DbTable::$PDOInstance)) {
			DbTable::$PDOInstance = new self();
		}
		return DbTable::$PDOInstance;
	}

	/**
	 * Inicia transação
	 *
	 * @return bool
	 */
	public function beginTransaction()
	{
		return self::$PDOInstance->beginTransaction();
	}

	/**
	 * Comita a transação
	 *
	 * @return bool
	 */
	public function commit()
	{
		return self::$PDOInstance->commit();
	}

	/**
	 * Fetch the SQLSTATE associated with the last operation on the database handle
	 *
	 * @return string
	 */
	public function errorCode()
	{
		return self::$PDOInstance->errorCode();
	}

	/**
	 * Fetch extended error information associated with the last operation on the database handle
	 *
	 * @return array
	 */
	public function errorInfo()
	{
		return self::$PDOInstance->errorInfo();
	}

	/**
	 * Execute an SQL statement and return the number of affected rows
	 *
	 * @param string $statement
	 */
	public function exec($statement)
	{
		return self::$PDOInstance->exec($statement);
	}

	/**
	 * Returns the ID of the last inserted row or sequence value
	 *
	 * @param string $name Name of the sequence object from which the ID should be returned.
	 * @return string
	 */
	public function lastInsertId($name)
	{
		return self::$PDOInstance->lastInsertId($name);
	}

	/**
	 * Prepares a statement for execution and returns a statement object
	 *
	 * @param string $statement A valid SQL statement for the target database server
	 * @param array $driver_options Array of one or more key=>value pairs to set attribute values for the PDOStatement obj
	 returned
	 * @return PDOStatement
	 */
	public function prepare($statement, $driver_options=false)
	{
		if(!$driver_options) $driver_options=array();
		return self::$PDOInstance->prepare($statement, $driver_options);
	}

	/**
	 * Executes an SQL statement, returning a result set as a PDOStatement object
	 *
	 * @param string $statement
	 * @return PDOStatement
	 */
	public function query($statement)
	{
		return self::$PDOInstance->query($statement);
	}

	/**
	 * Rolls back a transaction
	 *
	 * @return bool
	 */
	public function rollBack()
	{
		return self::$PDOInstance->rollBack();
    }
	
    public function fetchAll($statement)
    {
    	return self::$PDOInstance->query($statement)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function fetchRow($statement)
    {
    	return self::$PDOInstance->query($statement)->fetch(PDO::FETCH_ASSOC);
    }
    
	public function select()
	{
		return new DbSelect();
	}
	
	public function getAll($where = null, $order = null, $limit = null)
	{
		$select = $this->select()
			->from($this->_name);
		if(!is_null($where)){
			foreach ($where AS $key => $value){
				$select->where($key . " = ?", $value);
			}
		}
		if(!is_null($order)){
			foreach ($order AS $key => $value){
				$select->order($key, $value);
			}
		}
		if(!is_null($limit)){
			$select->limit($limit);
		}
		return $this->fetchAll($select->query);
	}
	
	public function getById($id)
	{
		$select = $this->select()
			->from($this->_name)
			->where("id = ?", $id);
		return $this->fetchRow($select->query);
	}
	
	public function insert(array $data)
	{
		$statement = "INSERT INTO " . $this->_name . "(" .implode(",", array_map("mysql_escape_string", array_keys($data))) . ") VALUES ('" . implode("', '", array_map("mysql_escape_string", array_values($data))) . "');";
		self::$PDOInstance->exec($statement);
		return self::$PDOInstance->lastInsertId();
	}
	
	public function update(array $data, $where)
	{
		$statement = "UPDATE " . $this->_name . " SET ";
		$quote = "";
		foreach($data AS $key => $value){
			$statement .= $quote . $key . "='" . $value . "'";
			$quote = ",";
		}
		$statement .= " WHERE " . $where;
		
		self::$PDOInstance->exec($statement);
	}
	
	public function delete($where)
	{
		$statement = "DELETE FROM " . $this->_name . " WHERE " . $where;
		self::$PDOInstance->exec($statement);
	}

	public function quoteInto($key, $value)
	{
		return str_replace("?", "'{$value}'", $key) . " ";
	}
}