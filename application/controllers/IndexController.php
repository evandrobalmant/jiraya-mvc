<?php
class IndexController extends Controller
{
	public function indexAction()
	{
		$this->view->assign("title", "Welcome to the Jiraya MVC Framework!");
		$this->view->assign("message", "This is your project's main page");
	} 
}