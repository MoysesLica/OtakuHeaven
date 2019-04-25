<div class="col-sm-3 col-md-2 sidebar">
	<div class="top-navigation">
		<div class="t-menu">MENU</div>
		<div class="t-img">
			<img src="images/lines.png" alt="" />
		</div>
		<div class="clearfix"> </div>
	</div>
		<div class="drop-navigation drop-navigation">
		  <ul class="nav nav-sidebar">
		  	<!--------------------------------------------------------------------->
			<li class="active"><a href="index.php" class="home-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Inicio</a></li>
		  	<!--------------------------------------------------------------------->
			<li><a href="#" class="menu1"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>Animes<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></li>
				<ul class="cl-effect-2">
					<li><a href="animesDublados.php">Dublado</a></li>
					<li><a href="animesLegendados.php">Legendado</a></li>
				</ul>
				<!-- script-for-menu -->
				<script>
					$( "li a.menu1" ).click(function() {
					$( "ul.cl-effect-2" ).slideToggle( 300, function() {
					// Animation complete.
					});
					});
				</script>
		  	<!--------------------------------------------------------------------->		
		  	<?php 

				if(isset($_SESSION['USUARIO'])){
					
						if($_SESSION['USUARIO']['tipo_usuario'] == 1){

							?>

								<li><a href="cadastrarAnime.php" class="menu"><span style="margin: 0px 2.0em 0px 0px; font-size: 16px !important;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>Cadastrar Anime</a></li>
								<li><a href="cadastrarEpisodio.php" class="menu"><span style="margin: 0px 2.0em 0px 0px; font-size: 16px !important;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>Inserir Episódio</a></li>


							<?php

						}else {

							?>

								<li><a href="minhasAssinaturas.php" class="menu"><span style="margin: 0px 2.0em 0px 0px; font-size: 16px !important;" class="glyphicon glyphicon-th-list" aria-hidden="true"></span>Minhas Assinaturas</a></li>


							<?php
							
						}

					?>

						<li><a href="config.php" class="menu"><span style="margin: 0px 2.0em 0px 0px; font-size: 16px !important;" class="glyphicon glyphicon-cog" aria-hidden="true"></span>Configurações</a></li>

						<li><a href="quit.php" class="menu"><span style="margin: 0px 2.0em 0px 0px; font-size: 16px !important;" class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>Deslogar</a></li>

					<?php						
				}

			?>
		  	<!--------------------------------------------------------------------->
		  </ul>
		  <!-- script-for-menu -->
				<script>
					$( ".top-navigation" ).click(function() {
					$( ".drop-navigation" ).slideToggle( 300, function() {
					// Animation complete.
					});
					});
				</script>
			<div class="side-bottom" style="padding: 10px;">
				<div class="copyright">
					<p>Copyright © 2019 by Moyses Lica. All Rights Reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
				</div>
			</div>
		</div>
</div>