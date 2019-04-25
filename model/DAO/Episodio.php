<?php 

namespace DAO\Episodio;

require_once 'Connection.php';

use DAO\Connection as Connection;

class Episodio{


	public static function deleteEpisodio($id){

		$BD = (new Connection\Connection())->Connection;

		$DELETE = "DELETE FROM EPISODIO WHERE ID = :ID";

		$SQL = $BD->prepare($DELETE);

		$SQL->bindParam(":ID", $id);

		$response = $SQL->execute();
		
	}



	public static function getLastEpis(){

		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM EPISODIO ORDER BY DATA_LANCAMENTO DESC LIMIT 4";

		$SQL = $BD->prepare($SELECT);

		$response = $SQL->execute();

		return $SQL->fetchAll(\PDO::FETCH_ASSOC);

	}

	public static function getEpisodio($idEpisodio){

		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM EPISODIO WHERE ID = :ID";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":ID", $idEpisodio);

		$response = $SQL->execute();

		return $SQL->fetch(\PDO::FETCH_ASSOC);

	}

	public static function createEpisodio($episodio){

		$BD = (new Connection\Connection())->Connection;

		$INSERT = "INSERT INTO EPISODIO (ID, ANIME, NOME, DESCRICAO, CAMINHO_EPISODIO, DATA_LANCAMENTO) 
				   VALUES (:ID, :ANIME, :NOME, :DESCRICAO, :CAMINHO_EPISODIO, :DATA_LANCAMENTO)";

		$SQL = $BD->prepare($INSERT);

		$SQL->bindParam(":ID", $episodio->id);
		$SQL->bindParam(":ANIME", $episodio->anime);
		$SQL->bindParam(":NOME", $episodio->nome);
		$SQL->bindParam(":DESCRICAO", $episodio->descricao);
		$SQL->bindParam(":DATA_LANCAMENTO", $episodio->dataLancamento);
		$SQL->bindParam(":CAMINHO_EPISODIO", $episodio->caminhoEpisodio);

		$response = $SQL->execute();

		return $response;

	}

	public static function getListEpisodios($idAnime){

		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM EPISODIO WHERE ANIME = :ANIME ORDER BY DATA_LANCAMENTO ASC";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":ANIME", $idAnime);

		$response = $SQL->execute();

		return $SQL->fetchAll(\PDO::FETCH_ASSOC);

	}

}

?>