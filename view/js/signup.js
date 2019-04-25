$(document).ready(function() {
	
	$("#btnCadastrarUsuario").click(function(event) {
		
		event.preventDefault();

		if($("#senha").val().length < 8){
			$("#modalArea").html('<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Erro no Tamanho da Senha</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Sua senha precisa ter no mínimo 8 caracteres.</p></div><div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button> </div></div></div></div>');
			$(".modal").modal();
			return;
		}
		
		if($("#senha").val() != $("#senha2").val()){
			$("#modalArea").html('<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Erro na Confirmação da Senha</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Confirme sua senha corretamente.</p></div><div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button> </div></div></div></div>');
			$(".modal").modal();
			return;
		}

		dadosPessoa = {
			"CPF" : $("#cpf").val(),
			"nome" : $("#nome").val(),
			"email" : $("#email").val(),
			"senha" : $("#senha").val()
		}

		dadosCartao = {
			"banco" : $("#banco").val(),			
			"agencia" : $("#agencia").val(),			
			"digito_agencia" : $("#digitoAgencia").val(),			
			"conta" : $("#conta").val(),			
			"digito_conta" : $("#digitoConta").val()			
		}

		$.ajax({
			url: '../controller/Usuario.php',
			type: 'POST',
			dataType: 'json',
			data: {acao: 'cadastrarUsuario', dadosPessoa: dadosPessoa, dadosCartao: dadosCartao},
		})
		.always(function(response) {
			console.log(response);
			$("#modalArea").html(response.responseText);
		})				

	});

});
