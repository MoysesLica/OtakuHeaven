<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="main-grids">
		<div class="top-grids">
			<div class="recommended-info">
				<h1 style="text-align: center;">Cadastro de Anime</h1>
			</div>
			<form id="form-cadastro-anime" enctype="multipart/form-data">

			  <input type="text" name="acao" value="cadastrarAnime" style="display: none;">

			  <div class="form-group col-md-6 col-sm-12">
			    <label for="anime"><h5>Anime</h5></label>
			    <select class="form-control" id="anime">
			    	<option value="0"></option>
			    	<?php 

			    		$_POST['acao'] = 'getAllAnimes';

			    		require_once '../controller/Anime.php';

			    	?>
			    </select>
			    <label for="nome"><h5>Nome do Episódio</h5></label>
			    <input type="text" class="form-control" id="nome" placeholder="Nome do Episódio">
			    <label for="descricao"><h5>Descrição</h5></label>
			    <textarea class="form-control" id="descricao"></textarea>
			  </div>
			  <div class="form-group col-md-6 col-sm-12">
			    <label for="dataLancamento"><h5>Data de Lançamento</h5></label>
			    <input type="text" class="form-control" id="dataLancamento" placeholder="Data de Lançamento">
			    <label for="episodio"><h5>Episódio</h5></label>
    			<input type="file" style="padding: 0px;" class="form-control" id="episodio">
			  </div>
			  
			  <div class="clearfix"></div>

			  <center>
				  <input type="submit" id="btnCadastrarEpisodio" class="btn btn-primary" value="Cadastrar Episódio">
			  </center>

			  <script type="text/javascript" src="js/insertEpi.js"></script>

			  <div id="modalArea"></div>
			  <div id="scriptArea"></div>

			</form>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>