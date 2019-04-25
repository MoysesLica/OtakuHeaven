<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="main-grids">
		<div class="top-grids">
			<div class="recommended-info">
				<h1 style="text-align: center;">Configurações da Conta</h1>
			</div>

			<center>
				<button id="btnDeleteAccount" class="btn btn-danger">Deletar Conta</button>
			</center>

			<form id="form-cadastro-usuario">

				<script type="text/javascript">

					$(document).ready(function() {

						idUsuario = null;

						$.ajax({
							url: '../controller/Usuario.php',
							type: 'POST',
							dataType: 'json',
							data: {acao: "getDados", idUsuario: "<?php echo $_SESSION['USUARIO']['id']; ?>"},
						})	
						.always(function(response) {
							console.log(response);
							$("#nome").val(response.NOME);
							$("#email").val(response.EMAIL);
							idUsuario = response.ID;
						});

					});					
					
				</script>

			  <div class="form-group col-md-12 col-sm-12">
			    <label for="nome"><h5>Nome</h5></label>
			    <input type="nome" class="form-control" id="nome" placeholder="Nome" disabled="disabled">
			    <label for="email"><h5>E-Mail</h5></label>
			    <input type="email" class="form-control" id="email" placeholder="E-Mail">
			  </div>
			  
			  <div class="clearfix"></div>

			  <center>
				  <button id="btnChangeData" class="btn btn-primary">Alterar E-Mail</button>
			  </center>

			  <div class="form-group col-md-12 col-sm-12">
			    <label for="senha"><h5>Senha</h5></label>
			    <input type="password" class="form-control" id="senha" placeholder="Senha">
			    <label for="senha2"><h5>E-Mail</h5></label>
			    <input type="password" class="form-control" id="senha2" placeholder="Confirmar Senha">
			  </div>

			  <center>
				  <button id="btnChangePassword" class="btn btn-primary">Alterar Senha</button>
			  </center>

			  <script type="text/javascript" src="js/config.js"></script>

			  <div id="modalArea"></div>
			  <div id="scriptArea"></div>

			</form>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>