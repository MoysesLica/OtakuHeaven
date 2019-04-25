<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="main-grids">
		<div class="top-grids">
			<div class="recommended-info">
				<h1 style="text-align: center;">Cadastro de Anime</h1>
			</div>
			<form id="form-cadastro-anime" enctype="multipart/form-data">

			  <input type="text" name="acao" value="cadastrarAnime" style="display: none;">

			  <div class="form-group col-md-6 col-sm-12">
			    <label for="nome"><h5>Nome</h5></label>
			    <input type="text" class="form-control" id="nome" placeholder="Nome Completo do Anime">
			    <label for="descricao"><h5>Descrição</h5></label>
			    <textarea class="form-control" id="descricao"></textarea>
			    <label for="dataLancamento"><h5>Data de Lançamento</h5></label>
			    <input type="text" class="form-control" id="dataLancamento" placeholder="Data de Lançamento">
			  </div>
			  <div class="form-group col-md-6 col-sm-12">
			    <label for="valor"><h5>Valor da Assinatura</h5></label>
			    <input type="text" class="form-control" id="valor" placeholder="Valor da Assinatura">
			    <label for="capa"><h5>Capa</h5></label>
    			<input type="file" style="padding: 0px;" class="form-control" id="capa">
			    <label for="dublado"><h5>Dublado/Legendado</h5></label>
			    <select class="form-control" id="dublado">
			    	<option value="1">Dublado</option>
			    	<option value="0">Legendado</option>
			    </select>
			  </div>
			  
			  <div class="clearfix"></div>

			  <center>
				  <input type="submit" id="btnCadastrarUsuario" class="btn btn-primary" value="Cadastrar Anime">
			  </center>

			  <script type="text/javascript" src="js/saveAnime.js"></script>

			  <div id="modalArea"></div>
			  <div id="scriptArea"></div>

			</form>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>