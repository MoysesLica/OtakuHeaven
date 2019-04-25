<?php 

namespace DAO\Anime;

require_once 'Connection.php';

use DAO\Connection as Connection;

class Anime{

	public static function getAnimesByName($nome){
		
		$nome = trim(str_replace("'", "", $nome));

		$BD = (new Connection\Connection())->Connection;

		$SELECT = 'SELECT * FROM ANIME WHERE NOME LIKE "%'.$nome.'%"';

		$SQL = $BD->prepare($SELECT);

		$response = $SQL->execute();

		$result = $SQL->fetchAll(\PDO::FETCH_ASSOC);

		return $result;
		
	}

	public static function signAnime($anime, $usuario){
		
		$BD = (new Connection\Connection())->Connection;

		$INSERT = "INSERT INTO ASSINATURA VALUES(:USUARIO, :ANIME, (SELECT VALOR_ASSINATURA FROM ANIME WHERE ID = :ANIME), DATE(NOW()))";

		$SQL = $BD->prepare($INSERT);

		$SQL->bindParam(":ANIME", $anime);
		$SQL->bindParam(":USUARIO", $usuario);

		$response = $SQL->execute();
		
	}

	public static function getEpisodioAllow($episodio, $usuario){
		
		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM ASSINATURA WHERE ANIME = (SELECT ANIME FROM EPISODIO WHERE ID = :EPISODIO) AND USUARIO = :USUARIO";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":EPISODIO", $episodio);
		$SQL->bindParam(":USUARIO", $usuario);

		$response = $SQL->execute();

		return count($SQL->fetchAll());
		
	}

	public static function getAnimeAllow($anime, $usuario){
		
		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM ASSINATURA WHERE ANIME = :ANIME AND USUARIO = :USUARIO";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":ANIME", $anime);
		$SQL->bindParam(":USUARIO", $usuario);

		$response = $SQL->execute();

		return count($SQL->fetchAll());
		
	}

	public static function deleteAnime($id){

		$BD = (new Connection\Connection())->Connection;

		$DELETE = "DELETE FROM ASSINATURA WHERE ANIME = :ANIME";

		$SQL = $BD->prepare($DELETE);

		$SQL->bindParam(":ANIME", $id);

		$response = $SQL->execute();

		$DELETE = "DELETE FROM EPISODIO WHERE ANIME = :ANIME";

		$SQL = $BD->prepare($DELETE);

		$SQL->bindParam(":ANIME", $id);

		$response = $SQL->execute();

		$DELETE = "DELETE FROM ANIME WHERE ID = :ID";

		$SQL = $BD->prepare($DELETE);

		$SQL->bindParam(":ID", $id);

		$response = $SQL->execute();
		
	}

	public static function getAnimeByEpisodio($idEpisodio){

		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM ANIME WHERE ID = (SELECT ANIME FROM EPISODIO WHERE ID = :ID)";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":ID", $idEpisodio);

		$response = $SQL->execute();

		return $SQL->fetch(\PDO::FETCH_ASSOC);
		
	}

	public static function getAnime($id){

		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM ANIME WHERE ID = :ID ORDER BY NOME";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":ID", $id);

		$response = $SQL->execute();

		return $SQL->fetch(\PDO::FETCH_ASSOC);

	}

	public static function getAllAnimes(){

		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM ANIME ORDER BY NOME";

		$SQL = $BD->prepare($SELECT);

		$response = $SQL->execute();

		return $SQL->fetchAll(\PDO::FETCH_ASSOC);

	}

	public static function getAnimes($dublado){

		$BD = (new Connection\Connection())->Connection;

		$SELECT = "SELECT * FROM ANIME WHERE DUBLADO = :DUBLADO ORDER BY NOME";

		$SQL = $BD->prepare($SELECT);

		$SQL->bindParam(":DUBLADO", $dublado);

		$response = $SQL->execute();

		return $SQL->fetchAll(\PDO::FETCH_ASSOC);

	}

	public static function createAnime($anime){

		$BD = (new Connection\Connection())->Connection;

		$INSERT = "INSERT INTO ANIME (ID, NOME, DESCRICAO, DATA_LANCAMENTO, VALOR_ASSINATURA, CAMINHO_CAPA, DUBLADO) 
				   VALUES (:ID, :NOME, :DESCRICAO, :DATA_LANCAMENTO, :VALOR_ASSINATURA, :CAMINHO_CAPA, :DUBLADO)";

		$SQL = $BD->prepare($INSERT);

		$SQL->bindParam(":ID", $anime->id);
		$SQL->bindParam(":NOME", $anime->nome);
		$SQL->bindParam(":DESCRICAO", $anime->descricao);
		$SQL->bindParam(":DATA_LANCAMENTO", $anime->dataLancamento);
		$SQL->bindParam(":VALOR_ASSINATURA", $anime->valorAssinatura);
		$SQL->bindParam(":CAMINHO_CAPA", $anime->caminhoCapa);
		$SQL->bindParam(":DUBLADO", $anime->dublado);

		$response = $SQL->execute();

		return $response;

	}

}

?>