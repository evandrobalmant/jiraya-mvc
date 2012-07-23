<?php
/**
* Jiraya MVC Framework
*
* LICENSE
* Este arquivo fonte está sujeito a nova licença BSD que é fornecido
* com este pacote no arquivo LICENSE.txt.
*
* @category   Jiraya
* @package    Auth_DbTable
* @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
*/

require_once 'DbTable.php';
require_once 'DbSelect.php';

class Auth_DbTable extends DbTable
{
	private $_table_name;
	
	private $_identity_column;
	
	private $_credential_column;
	
	private $_identity;
	
	private $_credential;
	
	private $_credential_treatment;
	
	private $_result_row;
	
	public function setTableName($table_name)
	{
		$this->_table_name = $table_name;
	}
	
	public function setIdentityColumn($identity_column)
	{
		$this->_identity_column = $identity_column;
	}
	
	public function setCredentialColumn($credential_column)
	{
		$this->_credential_column = $credential_column;
	}
	
	public function setIdentity($identity)
	{
		$this->_identity = $identity;
	}
	
	public function setCredential($credential)
	{
		$this->_credential = $credential;
	}
	
	public function setCredentialTreatment($credential_treatment)
	{
		$this->_credential_treatment = $credential_treatment;
	}
	
	public function authenticate()
	{
		$select = $this->select()
			->from($this->_table_name)
			->where($this->_identity_column . " = ?", $this->_identity)
			->andWhere($this->_credential_column . " = " . $this->_credential_treatment, $this->_credential);
		$this->_result_row = $this->fetchRow($select->query);
	}
	
	public function isValid()
	{
		if($this->_result_row)
			return true;
		else
			return false;
	}
	
	public function getResultRow()
	{
		return $this->_result_row;
	}
}