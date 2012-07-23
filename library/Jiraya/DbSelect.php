<?php
/**
* Jiraya MVC Framework
*
* LICENSE
* Este arquivo fonte está sujeito a nova licença BSD que é fornecido
* com este pacote no arquivo LICENSE.txt.
*
* @category   Jiraya
* @package    DbSelect
* @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
*/

class DbSelect
{
	public $query;
	
	public function __construct()
	{
		$this->query = "SELECT ";
		
		return $this;
	}
	
	public function from($table, $params = null)
	{
		if(is_null($params)){
			$this->query .= "* ";
		}else{
			if(is_array($params)){
				$this->query .= implode(",", $params) . " ";
			}else{
				$this->query .= $params . " ";
			}
		}
		$this->query .= "FROM " . $table . " ";
		return $this;
	}
	
	public function join($table, $relation)
	{
		$this->query .= "INNER JOIN " . $table . " ON " . $relation . " ";
		return $this;
	}
	
	public function joinLeft($table, $relation)
	{
		$this->query .= "LEFT JOIN " . $table . " ON " . $relation . " ";
		return $this;
	}
	
	public function joinRight($table, $relation)
	{
		$this->query .= "RIGHT JOIN " . $table . " ON " . $relation . " ";
		return $this;
	}
	
	public function joinNatural($table)
	{
		$this->query .= "NATURAL JOIN " . $table . " ";
		return $this;
	}
	
	public function where($key, $value)
	{
		$this->query .= "WHERE " . str_replace("?", "'{$value}'", $key) . " ";
		return $this;
	}
	
	public function andWhere($key, $value)
	{
		$this->query .= "AND " . str_replace("?", "'{$value}'", $key) . " ";
		return $this;
	}
	
	public function orWhere($key, $value)
	{
		$this->query .= "OR " . str_replace("?", "'{$value}'", $key) . " ";
		return $this;
	}
	
	public function group($group)
	{
		$this->query .= "GROUP BY " . $group . " ";
		return $this;
	}
	
	public function having($having)
	{
		$this->query .= "HAVING " . $having . " ";
		return $this;
	}
	
	public function order($param, $mode = "ASC")
	{
		$this->query .= "ORDER BY " . $param . " " . $mode . " ";
		return $this;
	}
	
	public function limit($count, $offset = 0)
	{
		$this->query .= "LIMIT " . $count . " OFFSET " . $offset . " ";
		return $this;
	}
}