<?php
require_once 'Auth.php';
require_once 'models/ExemploModel.php';

class GridController extends Controller
{
	public function init()
	{
		if(!Auth::getInstance()->hasIdentity()){
			$this->_redirect('autenticacao');
		}else{
			$storage = Auth::getInstance()->getStorage();
			$this->view->assign("nome_usuario", $storage['nome']);
		}
	}
	
	public function indexAction()
	{}
	
	public function listaAction()
	{
		$this->view->disableRenderer();
	
		$model = new ExemploModel();
		$dados = $model->lista($_REQUEST);

		echo json_encode($dados);
	}
	
	public function crudAction()
	{
		$this->view->disableRenderer();
	
		$model = new ExemploModel();
	
		switch ($_REQUEST['oper']){
			case "add":
				$model->add($_REQUEST);
				break;
			case "edit":
				$model->edit($_REQUEST);
				break;
			case "del":
				$model->del($_REQUEST);
				break;
		}
		
		echo json_encode(array("status" => true));
	}
}