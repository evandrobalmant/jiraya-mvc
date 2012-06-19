<?php
class Controller
{
	public $view;
	
	public function __construct()
	{
		echo "__construct";
		$this->view = new View();
	}
}