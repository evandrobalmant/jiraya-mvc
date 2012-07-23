<?php
/**
* Jiraya MVC Framework
*
* LICENSE
* Este arquivo fonte está sujeito a nova licença BSD que é fornecido
* com este pacote no arquivo LICENSE.txt.
*
* @category   Jiraya
* @package    Auth
* @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
*/

class Auth
{
	private static $Instance;
	
	private static $_storage;
	
	public function __construct()
	{
		session_start();
	}
	
	public static function getInstance()
	{
		if(!isset(Auth::$Instance)) {
			Auth::$Instance = new self();
			
			self::$_storage = &$_SESSION['auth'];
		}
		return Auth::$Instance;
	}
	
	public function getStorage()
	{
		return self::$_storage;
	}
	
	public function write(array $data)
	{
		self::$_storage = $data;
	}
	
	public function hasIdentity()
	{
		if (empty(self::$_storage))
			return false;
		else
			return true;
	}
	
	public function clearIdentity()
	{
		unset($_SESSION['auth']);
	}
}