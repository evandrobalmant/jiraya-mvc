<?php
class IndexController extends Controller
{
	public function indexAction()
	{
		$this->view->assign("title", "Jiraya MVC Framework!");
		$this->view->assign("message", "Esta é a página principal");
	} 
}