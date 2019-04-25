$(document).ready(function() {
	
	$("#btnCadastrarEpisodio").click(function(event) {
		
		event.preventDefault();

		data = new FormData();
		data.append('acao', 'cadastrarEpisodio');
		data.append('anime', $("#anime").val());
		data.append('nome', $("#nome").val());
		data.append('descricao', $("#descricao").val());
		data.append('dataLancamento', $("#dataLancamento").val());
		data.append('episodio', $("#episodio")[0].files[0]);

		$.ajax({
			url: '../controller/Episodio.php',
			type: 'POST',
	        data: data,
	        cache: false,
	        contentType: false,
	        processData: false,
		})
		.always(function(response) {
			console.log(response);
			$("#modalArea").html(response)
		});
		

	});

});
