<?php
class Controller
{
	public $view;
	
	public function init()
	{}
	
	public function __construct()
	{
		$this->view = new View();
		$this->init();
	}
}