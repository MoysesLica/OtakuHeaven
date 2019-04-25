<?php  

namespace Model\Anime;

class Anime{

	public $id;
	public $nome; 
	public $descricao; 
	public $dataLancamento; 
	public $valorAssinatura; 
	public $caminhoCapa;
	public $dublado; 
	
	public function __construct($id, $nome, $descricao, $dataLancamento, $valorAssinatura, $caminhoCapa, $dublado){
		$this->id = $id;
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->dataLancamento = $dataLancamento;
		$this->valorAssinatura = $valorAssinatura;
		$this->caminhoCapa = $caminhoCapa;
		$this->dublado = $dublado;
	}

}

?>