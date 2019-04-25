<?php 

namespace DAO\Usuario;

require_once 'Connection.php';

use DAO\Connection as Connection;

class Usuario{

	public static function deletarConta($id){
		
		$BD = (new Connection\Connection())->Connection;

		$DELETE = "DELETE FROM ASSINATURA WHERE USUARIO = :ID";

		$SQL = $BD->prepare($DELETE);

		$SQL->bindParam(":ID", $id);

		$response = $SQL->execute();

		$SELECT = "SELECT ID FROM CARTAO WHERE ID = (SELECT CARTAO FROM USUARIO WHERE ID = :ID)";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":ID", $id);

		$response = $SQL->execute();

		$idCartao = $SQL->fetch(\PDO::FETCH_ASSOC);

		$DELETE = "DELETE FROM USUARIO WHERE ID = :ID";

		$SQL = $BD->prepare($DELETE);

		$SQL->bindParam(":ID", $id);

		$response = $SQL->execute();

		$DELETE = "DELETE FROM CARTAO WHERE ID = :ID";

		$SQL = $BD->prepare($DELETE);

		$SQL->bindParam(":ID", $idCartao['ID']);

		$response = $SQL->execute();

	}

	public static function changePassword($id, $senha){
		
		$BD = (new Connection\Connection())->Connection;

		$UPDATE = "UPDATE USUARIO SET SENHA = :SENHA WHERE ID = :ID";

		$SQL = $BD->prepare($UPDATE);

		$SQL->bindParam(":ID", $id);
		$SQL->bindParam(":SENHA", $senha);

		$response = $SQL->execute();

		return $response;
		
	}

	public static function changeEmail($id, $email){
		
		$BD = (new Connection\Connection())->Connection;

		$UPDATE = "UPDATE USUARIO SET EMAIL = :EMAIL WHERE ID = :ID";

		$SQL = $BD->prepare($UPDATE);

		$SQL->bindParam(":ID", $id);
		$SQL->bindParam(":EMAIL", $email);

		$response = $SQL->execute();

		if(!$response){

			return 0;
		
		}else{

			return 1;

		}

	}

	public static function getDados($id){
		
		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM USUARIO WHERE ID = :ID";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":ID", $id);

		$response = $SQL->execute();

		if(!$response){

			return 0;
		
		}else{

			return $SQL->fetch(\PDO::FETCH_ASSOC);
		
		}

	}

	public static function login($email, $senha){

		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM USUARIO WHERE EMAIL = :EMAIL AND SENHA = :SENHA";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":EMAIL", $email);
		$SQL->bindParam(":SENHA", $senha);

		$response = $SQL->execute();

		if(!$response){

			return 0;
		
		}else{

			return $SQL->fetch(\PDO::FETCH_ASSOC);
		
		}
		
	}

	public static function createUsuario($usuario){

		$BD = (new Connection\Connection())->Connection;

		$INSERT = "INSERT INTO USUARIO (ID, CPF, NOME, DATA_CADASTRO, CARTAO, EMAIL, SENHA, TIPO_USUARIO) 
				   VALUES (:ID, :CPF, :NOME, :DATA_CADASTRO, :CARTAO, :EMAIL, :SENHA, :TIPO_USUARIO)";

		$SQL = $BD->prepare($INSERT);

		$SQL->bindParam(":ID", $usuario->id);
		$SQL->bindParam(":CPF", $usuario->CPF);
		$SQL->bindParam(":NOME", $usuario->nome);
		$SQL->bindParam(":DATA_CADASTRO", $usuario->dataCadastro);
		$SQL->bindParam(":CARTAO", $usuario->cartao);
		$SQL->bindParam(":EMAIL", $usuario->email);
		$SQL->bindParam(":SENHA", $usuario->senha);
		$SQL->bindParam(":TIPO_USUARIO", $usuario->tipoUsuario);

		$response = $SQL->execute();

		if(!$response){

			$error = $SQL->errorInfo()[2];

			$DELETE = "DELETE FROM CARTAO WHERE ID = :ID";

			$SQL = $BD->prepare($DELETE);

			$SQL->bindParam(":ID", $usuario->cartao);

			$response = $SQL->execute();

			if(strpos($error, 'CPF_UNIQUE') > 0){
				
				return -1;

			}else{
				
				return -2;
			
			}
		
		}else{

			return null;
		
		}

	}

}

?>