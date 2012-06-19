<?php
class Config
{
	public static function get($env, $ini)
	{
		$ini_array = parse_ini_file($ini, true);
		//return $ini_array[$env];
		return $ini_array;
	}
	
	public static function setPhpIni(array $php_flags){
		foreach ($php_flags AS $varname => $newvalue) {
			ini_set($varname, $newvalue);
		}	
	}
}