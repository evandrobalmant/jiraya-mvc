<?php
/**
 * Jiraya MVC Framework
 *
 * LICENSE
 * Este arquivo fonte está sujeito a nova licença BSD que é fornecido
 * com este pacote no arquivo LICENSE.txt.
 *
 * @category   Jiraya
 * @package    Application
 * @copyright  Copyright (c) 2012 Evandro Klimpel Balmant
 */

class Application
{
	public static $config;
	
	public static $request = array();
	
	public function __construct($env, $ini)
	{
		function __autoload($class_name)
		{
			require_once $class_name . ".php";
		}

		self::$config = Config::get($env, $ini);
		
		if(!empty(self::$config['php'])){
			Config::setPhpIni(self::$config['php']);
		}
	}
	
	public function run()
	{
		$request_uri = str_replace("/index.php", "", strtolower($_SERVER['REQUEST_URI']));
		$script_name = str_replace("/index.php", "", strtolower($_SERVER['SCRIPT_NAME']));
		$request_uri = str_replace($script_name, "", $request_uri);
		
		$arr_request_uri = explode("/", $request_uri);
		
		if(!empty($arr_request_uri[1])){
			self::$request['controller'] = $arr_request_uri[1];
			$class = $this->className($arr_request_uri[1]);
			$class = "{$class}Controller";
			$control = new $class;
		}else{
			self::$request['controller'] = "index";
			$control = new IndexController();
		}
		
		if(!empty($arr_request_uri[2])){
			self::$request['action'] = $arr_request_uri[2];
			$method = $this->actionName($arr_request_uri[2]);
			$method = "{$method}Action";
			call_user_func(array($control, $method));
		}else{
			self::$request['action'] = "index";
			$control->indexAction();
		}
	}
	
	private function className($request)
	{
		return str_replace(" ", "", ucwords(str_replace("-", " ", $request)));
	}
	
	private function actionName($request)
	{
		return lcfirst(str_replace(" ", "", ucwords(str_replace("-", " ", $request))));
	}
}