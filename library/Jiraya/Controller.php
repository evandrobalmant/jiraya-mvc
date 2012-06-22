<?php
/**
 * Jiraya MVC Framework
 * 
 * LICENSE
 * Este arquivo fonte está sujeito a nova licença BSD que é fornecido
 * com este pacote no arquivo LICENSE.txt.
 * 
 * @category   Jiraya
 * @package    Controller
 * @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
 */

class Controller
{
	/**
	 * View instance
	 * @var View
	 */
	protected $view;
	
	
	/**
	 * Construtor da Classe
	 * 
	 * @return void
	 */
	public function __construct()
	{
		$this->view = new View();
		$this->init();
	}
	
	/**
	 * Inicializador do objeto
	 * Chamado pelo {@link __construct()} ao instanciar o objeto.
	 * 
	 * @return void
	 */
	public function init()
	{
	}
	
	/**
	 * Retorna um parâmetro de requisição
	 * 
	 * @param string $paramName
	 * @return mixed
	 */
	protected function _getParam($paramName)
	{
		return $_REQUEST[$paramName];
	}
	
	/**
	 * Retorna todos os parâmetros da requisição em um array associativo
	 * 
	 * @return array
	 */
	protected function _getAllParams()
	{
		return $_REQUEST;
	}
}