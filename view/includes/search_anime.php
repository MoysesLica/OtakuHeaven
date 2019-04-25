<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	
	<?php 

		$_POST['acao'] = 'searchAnime';
		$_POST['nome'] = $_GET['nome'];

		require_once '../controller/Anime.php';

	?>	

</div>