<?php
class IndexController extends Controller
{
	public function init()
	{
		echo "init";
		//$this->view->disableRenderer();
	}
	
	public function indexAction()
	{
		$this->view->assign("title", "Welcome to the Jiraya MVC Framework!");
		$this->view->assign("message", "This is your project's main page");
		//echo $this->view->render("index/index");
	} 
}