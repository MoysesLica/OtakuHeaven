<?php  

namespace Model\Usuario;

class Usuario{

	public $id;
	public $nome; 
	public $CPF; 
	public $dataCadastro; 
	public $cartao; 
	public $email;
	public $senha;
	public $tipoUsuario;

	public function __construct($id, $nome, $CPF, $dataCadastro, $cartao, $email, $senha, $tipoUsuario){
		$this->id = $id;
		$this->nome = $nome;
		$this->CPF = $CPF;
		$this->dataCadastro = $dataCadastro;
		$this->cartao = $cartao;
		$this->email = $email;
		$this->senha = $senha;
		$this->tipoUsuario = $tipoUsuario;
	}

}

?>