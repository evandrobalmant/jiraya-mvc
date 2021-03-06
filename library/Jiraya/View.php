<?php
/**
 * Jiraya MVC Framework
 *
 * LICENSE
 * Este arquivo fonte está sujeito a nova licença BSD que é fornecido
 * com este pacote no arquivo LICENSE.txt.
 *
 * @category   Jiraya
 * @package    View
 * @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
 */

class View
{
	private $_variables = array();
	
	private $_renderer = true;
	
	public static $tpl_extension = "phtml";
	
	private $_helper;
	
	public function __construct()
	{
		$this->_helper = new Helper();
	}
	
	public function assign($param, $value)
	{
		$this->_variables[$param] = $value;
	}
	
	public function display($template_name)
	{
		echo $this->render($template_name);
	}
	
	public function render($template_name)
	{
		$template = APPLICATION_PATH . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $template_name . "." . self::$tpl_extension;
		foreach($this->_variables as $key => $value) {
			$this->{$key} = $value;
		}
		ob_start();
		include $template;
		return ob_get_clean();
	}
	
	public function disableRenderer()
	{
		$this->_renderer = false;
	}
	
	public function __destruct()
	{
		if($this->_renderer) {
			$this->display(Application::$request['controller'] . DIRECTORY_SEPARATOR . Application::$request['action']);
		}
	}
}