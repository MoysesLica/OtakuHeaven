<?php 
namespace Controller\Anime;
if(!isset($_SESSION))
	session_start();

require_once '../model/Anime.php';
require_once '../model/DAO/Anime.php';

use Model\Anime as AnimeClass;
use DAO\Anime as AnimeDB;

switch ($_POST['acao']) {

	case 'searchAnime':

		$nome = $_POST['nome'];

		$animes = AnimeDB\Anime::getAnimesByName($nome);

		if(count($animes) == 0){

			echo '<h1 style="color: red;">Nenhum Anime Encontrado</h1>';			

		}

		for($i = 0; $i < count($animes); $i++){

			$anime = new AnimeClass\Anime($animes[$i]['ID'], $animes[$i]['NOME'], $animes[$i]['DESCRICAO'], $animes[$i]['DATA_LANCAMENTO'], $animes[$i]['VALOR_ASSINATURA'], $animes[$i]['CAMINHO_CAPA'], $animes[$i]['DUBLADO']);

			$anime->caminhoCapa = '..' . explode('OtakuHeaven', $anime->caminhoCapa)[1];

			?>

				<div style="display: inline-block;" class="col-md-3 resent-grid recommended-grid movie-video-grid">
					<div class="resent-grid-img recommended-grid-img">
						<a href="episodios.php?anime=<?php echo $anime->id; ?>"><img src="<?php echo $anime->caminhoCapa; ?>" alt="" /></a>
					</div>
					<div class="resent-grid-info recommended-grid-info recommended-grid-movie-info">
						<h5 style="font-weight: bold;"><?php echo $anime->nome; ?></h5>
						<h5>Data Lançamento: <?php echo (new \DateTime($anime->dataLancamento))->format('d/m/Y'); ?></h5>
					</div>
				</div>

			<?php

		}

		break;

	case 'assinarAnime':

		$anime = $_POST['id'];
		$usuario = $_SESSION['USUARIO']['id'];

		$response = AnimeDB\Anime::signAnime($anime, $usuario);

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Assinatura Feita com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); setTimeout(function() {window.location.href="episodios.php?anime='.$anime.'"}, 1000); </script>';		

		break;

	case 'deleteAnime':

		$anime = $_POST['id'];

		$response = AnimeDB\Anime::deleteAnime($anime);

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Anime Deletado com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); setTimeout(function() {window.location.href="index.php"}, 1500); </script>';		

		break;

	case 'getAllAnimes':

		$animes = AnimeDB\Anime::getAllAnimes();

		for($i = 0; $i < count($animes); $i++){

			$anime = new AnimeClass\Anime($animes[$i]['ID'], $animes[$i]['NOME'], $animes[$i]['DESCRICAO'], $animes[$i]['DATA_LANCAMENTO'], $animes[$i]['VALOR_ASSINATURA'], $animes[$i]['CAMINHO_CAPA'], $animes[$i]['DUBLADO']);

			$anime->caminhoCapa = '..' . explode('OtakuHeaven', $anime->caminhoCapa)[1];

			?>

				<option value="<?php echo $anime->id ?>"><?php echo $anime->nome; ?></option>

			<?php

		}

		break;

	case 'cadastrarAnime':

		$nome 			= $_POST['nome'];
		$descricao      = $_POST['descricao'];
		$dataLancamento = $_POST['dataLancamento'];
		$valor			= $_POST['valor'];
		$dublado 		= $_POST['dublado'];

		$capa           = $_FILES['capa'];
		$extensaoCapa   = explode('.', $capa['name'])[count(explode('.', $capa['name'])) - 1];
		$capa['name'] = (new \DateTime('now'))->format('Y_m_d_H_i_s');
		
		$capasDir = $_SERVER['DOCUMENT_ROOT'] . '/OtakuHeaven/storage/capas/';
		$caminhoCapa = $capasDir . basename($capa['name'] .'.'. $extensaoCapa);

		move_uploaded_file($capa['tmp_name'], $caminhoCapa);

		$anime = new AnimeClass\Anime(null, $nome, $descricao, $dataLancamento, $valor, $caminhoCapa, $dublado);

		$response = AnimeDB\Anime::createAnime($anime);

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Anime Cadastrado com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); </script>';

		break;
	
	case 'getAnimes':

		$dublado = $_POST['dublado'];

		$animes = AnimeDB\Anime::getAnimes($dublado);

		for($i = 0; $i < count($animes); $i++){

			$anime = new AnimeClass\Anime($animes[$i]['ID'], $animes[$i]['NOME'], $animes[$i]['DESCRICAO'], $animes[$i]['DATA_LANCAMENTO'], $animes[$i]['VALOR_ASSINATURA'], $animes[$i]['CAMINHO_CAPA'], $animes[$i]['DUBLADO']);

			$anime->caminhoCapa = '..' . explode('OtakuHeaven', $anime->caminhoCapa)[1];

			?>

				<div style="display: inline-block;" class="col-md-3 resent-grid recommended-grid movie-video-grid">
					<div class="resent-grid-img recommended-grid-img">
						<a href="episodios.php?anime=<?php echo $anime->id; ?>"><img src="<?php echo $anime->caminhoCapa; ?>" alt="" /></a>
					</div>
					<div class="resent-grid-info recommended-grid-info recommended-grid-movie-info">
						<h5 style="font-weight: bold;"><?php echo $anime->nome; ?></h5>
						<h5>Data Lançamento: <?php echo (new \DateTime($anime->dataLancamento))->format('d/m/Y'); ?></h5>
					</div>
				</div>

			<?php

		}

		break;

	default:
		/*ERROR*/

		ECHO "ERROR";

		break;
}

?>