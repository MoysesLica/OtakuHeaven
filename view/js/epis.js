$(document).ready(function() {

	$("#btnAssinar").click(function(event) {

		event.preventDefault();

		if(confirm('Deseja Mesmo Assinar Este Anime?')){

			$.ajax({
				url: '../controller/Anime',
				type: 'POST',
				dataType: 'json',
				data: {acao: 'assinarAnime', id: $("#btnAssinar").val()},
			})
			.always(function(response) {
				console.log(response);
				$("#modalArea").html(response.responseText);
			});

		}
		
	});
	
	$("#btnDeletarAnime").click(function(event) {

		event.preventDefault();

		if(confirm('Deseja Mesmo Deletar Este Anime?')){

			$.ajax({
				url: '../controller/Anime',
				type: 'POST',
				dataType: 'json',
				data: {acao: 'deleteAnime', id: $("#btnDeletarAnime").val()},
			})
			.always(function(response) {
				console.log(response);
				$("#modalArea").html(response.responseText);
			});

		}
		
	});

	$(".btnDeletarEpi").click(function(event) {

		event.preventDefault();

		if(confirm('Deseja Mesmo Deletar Este Episódio?')){

			$.ajax({
				url: '../controller/Episodio',
				type: 'POST',
				dataType: 'json',
				data: {acao: 'deleteEpisodio', id: $(this).attr('value')},
			})
			.always(function(response) {
				console.log(response);
				$("#modalArea").html(response.responseText);
			});

		}
		
	});

});