<?php
/**
 * Jiraya MVC Framework
 * 
 * LICENSE
 * Este arquivo fonte está sujeito a nova licença BSD que é fornecido
 * com este pacote no arquivo LICENSE.txt.
 * 
 * @category   Jiraya
 * @package    Helper
 * @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
 */

class Helper
{
	/**
	 * Retorna o caminho para a raiz do projeto
	 *
	 * @return string
	 */
	public function baseUrl()
	{
		return dirname($_SERVER["PHP_SELF"]);
	}
	
	/**
	 * Retorna uma URL no padrão do framework
	 * 
	 * @param mixed $url_path
	 * @return string
	 */
	public function url(array $url_path)
	{
		$url = $this->baseUrl();
		foreach ($url_path AS $key => $value)
			$url .= "/" . $value;
		return $url;
	}
}