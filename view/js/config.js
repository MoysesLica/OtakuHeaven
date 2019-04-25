$(document).ready(function() {

	$("#btnDeleteAccount").click(function(event) {
		
		event.preventDefault();

		if(confirm('Tem certeza que deseja cancelar a conta?')){
	
			$.ajax({
				url: '../controller/Usuario.php',
				type: 'POST',
				dataType: 'json',
				data: {acao: 'deleteAccount', idUsuario: idUsuario},
			})
			.always(function(response) {
				console.log(response);
				$("#modalArea").html(response.responseText);
			});

		}	

	});

	$("#btnChangeData").click(function(event) {
		
		event.preventDefault();

		$.ajax({
			url: '../controller/Usuario.php',
			type: 'POST',
			dataType: 'json',
			data: {acao: 'changeEmail', idUsuario: idUsuario, email: $("#email").val()},
		})
		.always(function(response) {
			console.log(response);
			$("#modalArea").html(response.responseText);
		});
		

	});

	$("#btnChangePassword").click(function(event) {
		
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

		$.ajax({
			url: '../controller/Usuario.php',
			type: 'POST',
			dataType: 'json',
			data: {acao: 'changePassword', idUsuario: idUsuario, senha: $("#senha").val()},
		})
		.always(function(response) {
			console.log(response);
			$("#modalArea").html(response.responseText);
		});

	});

});
