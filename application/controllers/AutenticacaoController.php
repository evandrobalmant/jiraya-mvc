<?php
require_once 'Auth_DbTable.php';
require_once 'Auth.php';

class AutenticacaoController extends Controller
{
	public function indexAction()
	{}

	public function loginAction()
	{
		//Desabilita renderização da view
		$this->view->disableRenderer();

		//Obter o objeto do adaptador para autenticar usando banco de dados
		$authAdapter = new Auth_DbTable();

		//Seta qual tabela e colunas procurar o usuário
		$authAdapter->setTableName('usuario');
		$authAdapter->setIdentityColumn('login');
		$authAdapter->setCredentialColumn('senha');

		//Seta as credenciais com dados vindos do formulário de login
		$authAdapter->setIdentity($this->_getParam('login'));
		$authAdapter->setCredential($this->_getParam('senha'));
		$authAdapter->setCredentialTreatment('MD5(?)');

		//Realiza autenticação
		$authAdapter->authenticate();

		//Verifica se a autenticação foi válida
		if($authAdapter->isValid()){
			//Obtém dados do usuário
			$usuario = $authAdapter->getResultRow();
			
			//Armazena seus dados na sessão
			Auth::getInstance()->write($usuario);

			//Redireciona para o Index
			$this->_redirect('./');
		}else{
			$this->_redirect('autenticacao/falha');
		}
	}

	public function falhaAction()
	{}

	public function logoutAction()
	{
		//Limpa dados da Sessão
		Auth::getInstance()->clearIdentity();
		//Redireciona a requisição para a tela de Autenticacao novamente
		$this->_redirect('autenticacao');
	}
}