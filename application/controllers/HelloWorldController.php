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
	
	public function dbAction()
	{
		$_POST['nome']	= "Jiraya";
		$_POST['email']	= "jiraya@jiraya";
		
		$model = new ExemploModel();
		echo $model->insert($_POST);
	}
}