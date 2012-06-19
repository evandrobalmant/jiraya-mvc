<?php
class View
{
	private $_variables = array();
	
	public $_renderer = true;
	
	public function assign($param, $value)
	{
		$this->_variables[$param] = $value;
	}
	
	public function display($template_name)
	{
		
	}
	
	public function render($template_name)
	{
		
	}
	
	public function __destruct()
	{
		if($this->_renderer){
			Application::$request['controller'];
		}
	}
}