<?php
class DbTable
{
	private $_connection;
	
	public function __construct()
	{
		try {
			$this->Conexao = new PDO(
				self::DRIVER.":host=".self::HOST."; dbname=".self::BANCO,
				self::USUARIO,
				self::SENHA
			);
			$this->Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo "Erro ao conectar ao banco de dados: ".$e->getMessage();
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
	{}
	
	public function update(array $data)
	{}
	
	public function delete(array $data)
	{}
	
}