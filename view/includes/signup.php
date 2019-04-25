<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="main-grids">
		<div class="top-grids">
			<div class="recommended-info">
				<h1 style="text-align: center;">Cadastro de Conta</h1>
			</div>
			<form id="form-cadastro-usuario">

			  <div class="form-group col-md-6 col-sm-12">
			    <h3 style="text-align: center;">Dados da Conta</h3>
			    <label for="nome"><h5>Nome</h5></label>
			    <input type="text" class="form-control" id="nome" placeholder="Nome Completo">
			    <label for="cpf"><h5>CPF</h5></label>
			    <input type="text" class="form-control" id="cpf" placeholder="CPF">
			    <label for="email"><h5>E-Mail</h5></label>
			    <input type="email" class="form-control" id="email" placeholder="E-Mail">
			    <label for="senha"><h5>Senha</h5></label>
			    <input type="password" class="form-control" id="senha" placeholder="Senha">
			    <label for="senha2"><h5>Confirmar Senha</h5></label>
			    <input type="password" class="form-control" id="senha2" placeholder="Confirmar Senha">
			  </div>

			  <div class="form-group col-md-6 col-sm-12">
			  	<h3 style="text-align: center;">Dados do Cartão</h3>

			    <label for="banco"><h5>Banco</h5></label>
			    <input type="text" class="form-control" id="banco" placeholder="Banco">
				
			    <label for="agencia"><h5>Agência</h5></label>
			    <input type="text" class="form-control" id="agencia" placeholder="Agência">
		
			    <label for="digitoAgencia"><h5>Dígito Agência</h5></label>
			    <input type="text" class="form-control" id="digitoAgencia" placeholder="Dígito Agência">
		  
			    <label for="conta"><h5>Conta</h5></label>
			    <input type="text" class="form-control" id="conta" placeholder="Conta">
		
			    <label for="digitoConta"><h5>Dígito Conta</h5></label>
			    <input type="text" class="form-control" id="digitoConta" placeholder="Dígito Conta">
		
			  </div>
			  
			  <div class="clearfix"></div>

			  <center>
				  <button id="btnCadastrarUsuario" class="btn btn-primary">Cadastrar-se</button>
			  </center>

			  <script type="text/javascript" src="js/signup.js"></script>

			  <div id="modalArea"></div>
			  <div id="scriptArea"></div>

			</form>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>