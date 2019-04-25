<?php 

namespace DAO\Connection;


class Connection{
	public $Connection;
    public function __construct(){
        $user = "root";
        $password = "";
        $server = "localhost";
        $dbType = "mysql";
        $dbName = "OtakuHeaven";
	        try {
				$this->Connection = new \PDO($dbType.':host='.$server.';dbname='.$dbName, $user, $password);	
			} catch (PDOException  $e) {
				echo "Erro ao conectar com o BD | ".$e->getMessage();  	
	        }
    }
}

?>