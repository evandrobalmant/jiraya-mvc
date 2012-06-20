<?php
class HelloWorldController extends Controller
{
	public function init()
	{
		$this->view->disableRenderer();
	}
	
	public function indexAction()
	{
		echo $this->view->render("hello-world/index");
	}
}