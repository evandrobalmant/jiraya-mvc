<?php
class IndexController extends Controller
{
	public function indexAction()
	{
		$this->view->assign("title", "Jiraya MVC Framework!");
		$this->view->assign("message", "Esta é a página principal");
	}
	
	public function DbAction()
	{
		$this->view->disableRenderer();
		
		$_POST['nome']	= "Jiraya";
		$_POST['email']	= "jiraya@jiraya";
		
		$model = new ExemploModel();
		echo $model->insert($_POST);
	}
}