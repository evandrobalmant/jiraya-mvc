<?php
class ExemploModel
{
	public function insert(array $request)
	{
		$dao = new Tabela();
		$data = array(
			'nome'	=> $request['nome'],
			'email'	=> $request['email']
		);
		return $dao->insert($data);
	}
}