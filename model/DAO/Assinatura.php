<?php 

namespace DAO\Assinatura;

require_once 'Connection.php';

use DAO\Connection as Connection;

class Assinatura{

	public static function getAssinaturasByUser($usuario){
		
		$BD = (new Connection\Connection())->Connection;

		$SELECT = 'SELECT * FROM ASSINATURA WHERE USUARIO = :USUARIO ORDER BY DATA_ASSINADA DESC';

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":USUARIO", $usuario);

		$response = $SQL->execute();

		return $SQL->fetchAll(\PDO::FETCH_ASSOC);
		
	}

}

?>