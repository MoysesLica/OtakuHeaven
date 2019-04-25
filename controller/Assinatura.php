<?php 
namespace Controller\Assinatura;
if(!isset($_SESSION))
	session_start();

require_once '../model/Assinatura.php';
require_once '../model/DAO/Assinatura.php';

use Model\Assinatura as AssinaturaClass;
use DAO\Assinatura as AssinaturaDB;

require_once '../model/Anime.php';
require_once '../model/DAO/Anime.php';

use Model\Anime as AnimeClass;
use DAO\Anime as AnimeDB;

switch ($_POST['acao']) {

	case 'getMinhasAssinaturas':

			$usuario = $_SESSION['USUARIO']['id'];

			$assinaturas = AssinaturaDB\Assinatura::getAssinaturasByUser($usuario);

			for ($i = 0; $i < count($assinaturas); $i++) {
				
				$anime = AnimeDB\Anime::getAnime($assinaturas[$i]['ANIME']);

				echo '<tr><td>'.$anime['NOME'].'</td>';
				echo '<td>'.(new \DateTime($assinaturas[$i]['DATA_ASSINADA']))->format('d/m/Y').'</td>';
				echo '<td>'.$assinaturas[$i]['VALOR_ASSINADO'].'</td></tr>';

			}
		
		break;

	default:
		/*ERROR*/

		ECHO "ERROR";

		break;
}

?>