<?php
/**
 * Jiraya MVC Framework
 * 
 * LICENSE
 * Este arquivo fonte está sujeito a nova licença BSD que é fornecido
 * com este pacote no arquivo LICENSE.txt.
 * 
 * @category   Jiraya
 * @package    Config
 * @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
 */

class Config
{
	/**
	 * Retorna um array associativo para um arquivo de configuração .ini
	 * 
	 * @param string $env
	 * @param string $ini
	 * @return mixed
	 */
	public static function get($env, $ini)
	{
		$ini_array = parse_ini_file($ini, true);
		//return $ini_array[$env];
		return $ini_array;
	}
	
	/**
	 * Retorna um array associativo para um arquivo de configuração .ini
	 * 
	 * @param mixed $php_flags
	 * @return void
	 */
	public static function setPhpIni(array $php_flags){
		foreach ($php_flags AS $varname => $newvalue) {
			ini_set($varname, $newvalue);
		}	
	}
}