<?php 

namespace Model\Cartao;


class Cartao{

	public $id;
	public $banco;
	public $agencia;
	public $digitoAgencia;
	public $conta;	
	public $digitoConta;	

    public function __construct($id, $banco, $agencia, $digitoAgencia, $conta, $digitoConta){
        
    	$this->id = $id;
    	$this->banco = $banco;
    	$this->agencia = $agencia;
    	$this->digitoAgencia = $digitoAgencia;
    	$this->conta = $conta;
    	$this->digitoConta = $digitoConta;

    }

}

?>