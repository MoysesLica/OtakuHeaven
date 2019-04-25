<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="main-grids">
		<div class="top-grids">
			<div class="recommended-info">
				<h1 style="text-align: center;">Minhas Assinaturas</h1>
			</div>

			<table class="table">
				<thead>
					<th>Anime</th>
					<th>Data da Assinatura</th>
					<th>Valor da Assinatura (R$)</th>
				</thead>
				<tbody>
					<?php 

						$_POST['acao'] = 'getMinhasAssinaturas';

						require_once '../controller/Assinatura.php';

					?>
				</tbody>
			</table>

			<div class="clearfix"> </div>
		</div>
	</div>
</div>