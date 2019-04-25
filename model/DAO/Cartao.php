<?php 

namespace DAO\Cartao;

require_once 'Connection.php';

use DAO\Connection as Connection;

class Cartao{

	/*CREATE*/

	public static function createCartao($cartao){
		
		$BD = (new Connection\Connection())->Connection;

		$INSERT = "INSERT INTO CARTAO (BANCO, AGENCIA, DIGITO_AGENCIA, CONTA, DIGITO_CONTA) 
				   VALUES (:BANCO, :AGENCIA, :DIGITO_AGENCIA, :CONTA, :DIGITO_CONTA)";

		$SQL = $BD->prepare($INSERT);

		$SQL->bindParam(":BANCO", $cartao->banco);
		$SQL->bindParam(":AGENCIA", $cartao->agencia);
		$SQL->bindParam(":DIGITO_AGENCIA", $cartao->digitoAgencia);
		$SQL->bindParam(":CONTA", $cartao->conta);
		$SQL->bindParam(":DIGITO_CONTA", $cartao->digitoConta);

		$response = $SQL->execute();

		if(!$response){

			return -1;
		
		}else{

			$SELECT = "SELECT ID 
					   FROM CARTAO 
					   WHERE BANCO = :BANCO AND AGENCIA = :AGENCIA AND DIGITO_AGENCIA = :DIGITO_AGENCIA AND
					   CONTA = :CONTA AND DIGITO_CONTA = :DIGITO_CONTA";

			$SQL = $BD->prepare($SELECT);

			$SQL->bindParam(":BANCO", $cartao->banco);
			$SQL->bindParam(":AGENCIA", $cartao->agencia);
			$SQL->bindParam(":DIGITO_AGENCIA", $cartao->digitoAgencia);
			$SQL->bindParam(":CONTA", $cartao->conta);
			$SQL->bindParam(":DIGITO_CONTA", $cartao->digitoConta);

			$response = $SQL->execute();

			$result = $SQL->fetchAll(\PDO::FETCH_BOTH);

			return $result[0]['ID'];

		}

	}

}

?>