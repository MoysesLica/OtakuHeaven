$(document).ready(function() {
	
	$("#form-cadastro-anime").on('submit',(function(e){
		e.preventDefault();

		data = new FormData();
		data.append('acao', 'cadastrarAnime');
		data.append('nome', $("#nome").val());
		data.append('descricao', $("#descricao").val());
		data.append('dataLancamento', $("#dataLancamento").val());
		data.append('valor', $("#valor").val());
		data.append('dublado', $("#dublado").val());
		data.append('capa', $("#capa")[0].files[0], 'capa.jpg');

		$.ajax({
			url: '../controller/Anime.php',
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
						
	}));

});
