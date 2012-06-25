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
	private $_connection;
	
	protected $_name;
	
	public function __construct()
	{
		try {
			//new PDO('mysql:host=localhost;dbname=nome_do_banco', 'username', 'password');
			$this->_connection = new PDO(
				Application::$config['db']['adapter'].":host=".Application::$config['db']['host'].";dbname=".Application::$config['db']['dbname'],
				Application::$config['db']['username'],
				Application::$config['db']['password']
			);
			$this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
		}
	}
		
	public function getConnection()
	{
		return $this->_connection;
	}
	
	public function select()
	{}
	
	public function fetchAll()
	{}
	
	public function fetchRow()
	{}
	
	public function insert(array $data)
	{
		$statement = "INSERT INTO " . $this->_name . "(" .implode(",", array_map("mysql_escape_string", array_keys($data))) . ") VALUES ('" . implode("', '", array_map("mysql_escape_string", array_values($data))) . "');";
		$this->_connection->exec($statement);
		return $this->_connection->lastInsertId();
	}
	
	public function update(array $data)
	{}
	
	public function delete(array $data)
	{}
	
}