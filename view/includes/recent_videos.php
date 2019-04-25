<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div>
		<h3>Últimos Episódios</h3>
	</div>

	<?php 

		$_POST['acao'] = "getLastEpis";

		require_once '../controller/Episodio.php';

	?>
	<div class="clearfix"> </div>
	<script type="text/javascript" src="js/recent_videos.js"></script>
</div>