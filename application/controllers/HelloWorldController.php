<?php
class HelloWorldController extends Controller
{
	public function init()
	{
		/* Initialize action controller here */
		$this->view->disableRenderer();
	}
	
	public function indexAction()
	{
		// action body
		echo $this->view->render("hello-world/index");
	}
}