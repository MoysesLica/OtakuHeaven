<?php 
namespace Controller\Episodio;
if(!isset($_SESSION))
	session_start();

require_once '../model/Anime.php';
require_once '../model/DAO/Anime.php';

use Model\Anime as AnimeClass;
use DAO\Anime as AnimeDB;

require_once '../model/Episodio.php';
require_once '../model/DAO/Episodio.php';

use Model\Episodio as EpisodioClass;
use DAO\Episodio as EpisodioDB;

switch ($_POST['acao']) {

	case 'deleteEpisodio':

		$episodio = $_POST['id'];

		$anime    = AnimeDB\Anime::getAnimeByEpisodio($episodio);

		$response = EpisodioDB\Episodio::deleteEpisodio($episodio);

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Episódio Deletado com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); setTimeout(function() {window.location.href="episodios.php?anime='.$anime['ID'].'"}, 1500); </script>';		

		break;

	case 'getLastEpis':

		$episodios = EpisodioDB\Episodio::getLastEpis();

		for ($i = 0; $i < count($episodios); $i++) {
				
			$anime = AnimeDB\Anime::getAnimeByEpisodio($episodios[$i]['ID']);

			$ffmpegDir = 'cd ../ffmpeg/bin/';
			$ffmpeg = 'ffmpeg.exe';
			$video = $episodios[$i]['CAMINHO_EPISODIO'];
			$thumbnail = str_replace("episodios", "thumbnails", $video);
			$thumbnail = str_replace(".mp4", ".jpg", $thumbnail);
			$thumbnailPath = '..' . explode('OtakuHeaven', $thumbnail)[1];

			$interval = 5;
			$size = '320x240';


			$cmd = "$ffmpegDir && $ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $thumbnail 2>&1";       

			if(!file_exists($thumbnailPath)){
				exec($cmd);	
			}

			?>

			<div class="col-md-3" style="display: inline-block;">

				<a href="assistirEpisodio.php?episodio=<?php echo $episodios[$i]['ID']; ?>"><img style="max-width: 100%;" src="<?php echo $thumbnailPath; ?>" alt="" /></a>
				<div class="resent-grid-info recommended-grid-info">
					<h3><a href="single.html" class="title title-info"><?php echo $anime['NOME']; ?> - <?php echo $episodios[$i]['NOME']; ?></a></h3>
				</div>
			</div>

			<?php

		}

	break;
	
	case 'getAnimeEpis':

		if(isset($_GET['anime'])){
			$anime = $_GET['anime'];
			$dadosAnime = AnimeDB\Anime::getAnime($anime);
		}else{
			$episodio = $_GET['episodio'];
			$dadosAnime = AnimeDB\Anime::getAnimeByEpisodio($episodio);
		}


		$anime = new AnimeClass\Anime($dadosAnime['ID'], $dadosAnime['NOME'], $dadosAnime['DESCRICAO'], $dadosAnime['DATA_LANCAMENTO'], $dadosAnime['VALOR_ASSINATURA'], $dadosAnime['CAMINHO_CAPA'], $dadosAnime['DUBLADO']);

		$anime->caminhoCapa = '..' . explode('OtakuHeaven', $anime->caminhoCapa)[1];

		?>

			<div class="row">
				
				<div class="col-md-11">
				
					<div style="margin-left: 20px; float: left;" class="col-md-3 resent-grid recommended-grid movie-video-grid">
						<div class="resent-grid-img recommended-grid-img">
							<a href="episodios.php?anime=<?php echo $anime->id; ?>"><img src="<?php echo $anime->caminhoCapa; ?>" alt="" /></a>
						</div>
					</div>

					<div>
						<h1><?php echo $anime->nome; ?></h1><hr>
						<h4 style="text-align: justify;"><?php echo $anime->descricao; ?></h4><hr>
						<h5>Data de Lançamento: <?php echo (new \DateTime($anime->dataLancamento))->format('d/m/Y'); ?>, Valor Assinatura: R$ <?php echo $anime->valorAssinatura; ?>, <b>Anime <?php if($anime->dublado) echo 'Dublado'; else echo 'Legendado'; ?></b></h5><hr>
						<?php if($_SESSION['USUARIO']['tipo_usuario'] == 0){ 

							$assinatura = AnimeDB\Anime::getAnimeAllow($anime->id, $_SESSION['USUARIO']['id']);

							if($assinatura == 0){

							?>
							<button value="<?= $anime->id ?>" id="btnAssinar" class="btn btn-success">Assinar</button>
						<?php }}else if($_SESSION['USUARIO']['tipo_usuario'] == 1){?>
							<button value="<?= $anime->id ?>" id="btnDeletarAnime" class="btn btn-danger">Deletar Anime</button>
						<?php } ?>
					</div>

				</div>

			</div>

			<div class="row">
				
				<div class="col-md-12">

					<h1 style="text-align: center;">Lista de Episódios</h1>
					
					<hr>

					<?php 

						$episodios = EpisodioDB\Episodio::getListEpisodios($anime->id);

						if(count($episodios) == 0)

							echo "<h4 style='margin-left: 20px;'>Não há episódios ainda para esse anime.</h4>";

						for($i = 0; $i < count($episodios); $i++){

							echo "<a href='assistirEpisodio.php?episodio=".$episodios[$i]['ID']."' style='margin-left: 20px; font-size: 16px; cursor: pointer;'>".($i + 1)." - ".$episodios[$i]['NOME']."</a>";

							if($_SESSION['USUARIO']['tipo_usuario'] == 1){

								echo " - <a style='font-size: 16px; cursor: pointer; color: red;' value='".$episodios[$i]['ID']."' class='btnDeletarEpi'>Deletar Episódio</a>";

							}

							echo '<br>';

						}

					?>

				</div>

			</div>

		<?php

	break;

	case 'cadastrarEpisodio':

		$anime 			= $_POST['anime'];
		$nome 			= $_POST['nome'];
		$descricao      = $_POST['descricao'];
		$dataLancamento = $_POST['dataLancamento'];

		$episodio       = $_FILES['episodio'];
		$extensaoEpisodio   = explode('.', $episodio['name'])[count(explode('.', $episodio['name'])) - 1];
		$episodio['name'] = (new \DateTime('now'))->format('Y_m_d_H_i_s');
		
		$episodiosDir = $_SERVER['DOCUMENT_ROOT'] . '/OtakuHeaven/storage/episodios/';
		$caminhoEpisodio = $episodiosDir . basename($episodio['name'] .'.'. $extensaoEpisodio);

		move_uploaded_file($episodio['tmp_name'], $caminhoEpisodio);

		$episodio = new EpisodioClass\Episodio(null, $anime, $nome, $descricao, $caminhoEpisodio, $dataLancamento);

		$response = EpisodioDB\Episodio::createEpisodio($episodio);

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Episódio Cadastrado com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); </script>';

		break;

	case 'getEpisodio':

		$episodio       = $_GET['episodio'];

		if(!isset($_SESSION['USUARIO']['id'])){
			echo '<script type="text/javascript">window.location.href="logarAntesDeAssistir.php"</script>';
			break;
		}

		if($_SESSION['USUARIO']['tipo_usuario'] == 0){

			$assinatura = AnimeDB\Anime::getEpisodioAllow($episodio, $_SESSION['USUARIO']['id']);

			if($assinatura == 0){

				echo '<script type="text/javascript">alert("Você não é assinante deste Anime."); window.location.href="episodios.php?episodio='.$episodio.'";</script>';
				break;

			}

		}

		$dadosAnime    = AnimeDB\Anime::getAnimeByEpisodio($episodio);
		$dadosEpisodio = EpisodioDB\Episodio::getEpisodio($episodio);

		$dadosEpisodio['CAMINHO_EPISODIO'] = '..' . explode('OtakuHeaven', $dadosEpisodio['CAMINHO_EPISODIO'])[1];

		?>

			<div class="recommended-info">
				<h1 style="text-align: center;"><?php echo $dadosAnime['NOME']; ?></h1>
				<h2 style="text-align: center;"><?php echo $dadosEpisodio['NOME']; ?></h2>
				<h5 style="text-align: justify;"><b>Sinopse:</b> <?php echo $dadosEpisodio['DESCRICAO']; ?></h5>
				<center><video width="640" height="480" controls>
					<source type="video/mp4" src="<?php echo $dadosEpisodio['CAMINHO_EPISODIO']; ?>">
				</video></center> 
			</div>
			
		<?php

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Episódio Cadastrado com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); </script>';

		break;

	default:
		/*ERROR*/

		ECHO "ERROR";

		break;
}

?>