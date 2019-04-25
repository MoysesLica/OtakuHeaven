<?php  

namespace Model\Assinatura;

class Assinatura{

	public $usuario;
	public $anime; 
	public $valorAssinado; 
	public $dataAssinada; 
	
	public function __construct($usuario, $anime, $valorAssinado, $dataAssinada){
		$this->usuario = $usuario;
		$this->anime = $anime;
		$this->valorAssinado = $valorAssinado;
		$this->dataAssinada = $dataAssinada;
	}

}

?>