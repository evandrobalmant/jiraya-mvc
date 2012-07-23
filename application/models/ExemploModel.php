<?php
require_once 'DbTable.php';
require_once 'DbSelect.php';

class ExemploModel extends DbTable
{
	protected $_name = "nome_tabela";
	
	public function lista(array $request)
	{
		$dados = array();
	
		$select = $this->select()
			->from($this->_name, "COUNT(*) AS qtd");
		$result = $this->fetchRow($select->query);
	
		if($result['qtd'] > 0){
			$total_pages = ceil($result['qtd'] / $request['rows']);
		}else{
			$total_pages = 0;
		}
	
		if($request['page'] == 1){
			$start = 0;
		}else{
			$start = ($request['rows'] * $request['page']) - $request['rows'];
		}
	
		$dados['total']	= $total_pages;
		$dados['page']	= $request['page'];
		$dados['records'] = $result['qtd'];
	
		$select = $this->select()
			->from($this->_name);
		if($request['sidx']){
			$select->order($request['sidx'], $request['sord']);
		}
		$select->limit($request['rows'], $start);
	
		$result = $this->fetchAll($select->query);
	
		for($cont = 0; $cont < count($result); $cont++) {
			$dados['rows'][$cont]['id'] = $result[$cont]['id'];
			$dados['rows'][$cont]['cell'] = array(
				$result[$cont]['nome'],
				$result[$cont]['email']
			);
		}
	
		return $dados;
	}
	
	public function add(array $request)
	{
		$dados = array(
			'nome'	=> $request['nome'],
			'email'	=> $request['email']
		);
		return $this->insert($dados);
	}
	
	public function edit(array $request)
	{
		$dados = array(
			'nome'	=> $request['nome'],
			'email'	=> $request['email']
		);
		$where = $this->quoteInto("id = ?", $request['id']);
		$this->update($dados, $where);
	}
	
	public function del(array $request)
	{
		$where = $this->quoteInto("id = ?", $request['id']);
		$this->delete($where);
	}
}