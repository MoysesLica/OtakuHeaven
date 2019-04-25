$(document).ready(function() {
	
	$("#btnLogin").click(function(event) {
		
		event.preventDefault();

		$.ajax({
			url: '../controller/Usuario.php',
			type: 'POST',
			dataType: 'json',
			data: {acao: 'logar', email: $("#email").val(), senha: $("#senha").val()},
		})
		.always(function(response) {
			console.log(response);
			$("#modalArea").html(response.responseText);
		})				

	});

});
