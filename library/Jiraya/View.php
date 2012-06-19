<?php
class View
{
	private $_variables = array();
	
	private $_renderer = true;
	
	public static $view_extension = "phtml";
	
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
		$template = APPLICATION_PATH . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $template_name . "." . self::$view_extension;
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