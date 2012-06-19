<?php
class Controller
{
	public $view;
	
	public function __construct()
	{
		$this->view = new View();
	}
}