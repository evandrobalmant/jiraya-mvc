<?php
class IndexController extends Controller
{
	public function init()
	{
		$this->view->_renderer = false;
	}
	
	public function indexAction()
	{
		$this->view->assign("message", "Hello World!");
	} 
}