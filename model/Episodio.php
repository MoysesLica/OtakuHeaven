<?php  

namespace Model\Episodio;

class Episodio{

	public $id;
	public $anime; 
	public $nome; 
	public $descricao; 
	public $caminhoEpisodio; 
	public $dataLancamento;
	
	public function __construct($id, $anime, $nome, $descricao, $caminhoEpisodio, $dataLancamento){
		$this->id = $id;
		$this->anime = $anime;
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->caminhoEpisodio = $caminhoEpisodio;
		$this->dataLancamento = $dataLancamento;
	}

}

?>