<nav style="background: none;" class="navbar navbar-inverse navbar-fixed-top col-md-10 offset-md-2 col-sm-9 offset-sm-3">
  <div class="container-fluid">
    <div id="navbar" class="navbar-collapse collapse">
		<div class="top-search">
			<form class="navbar-form navbar-right" style="float: left;">
				<input id="animesProcurar" type="text" class="form-control" placeholder="Procurar...">
				<input type="submit" style="right: initial !important; margin-left: 20px;" value=" ">
			</form>
			<script type="text/javascript">
					
				var availableAnimes = [
					<?php  

						require_once '../model/DAO/Connection.php';

						use DAO\Connection as Connection;

						$BD = (new Connection\Connection())->Connection;

						$SELECT = "SELECT NOME FROM ANIME GROUP BY NOME ORDER BY NOME";

						$SQL = $BD->prepare($SELECT);

						$response = $SQL->execute();

						$animes = $SQL->fetchAll(\PDO::FETCH_ASSOC);

						for ($i = 0; $i < count($animes); $i++) {
							
							echo '"'.$animes[$i]['NOME'].'",';

						}

					?>
			    ];

				$( "#animesProcurar" ).autocomplete({
					classes: {
        				"ui-autocomplete": "btn",
        				"ui-autocomplete": "btnAnimeList",
    				},
			     	source: availableAnimes,
			     	select: function( event, ui ) {
			     		window.location.href = "procurarAnime.php?nome='"+ui.item.label.trim()+"'";
			     	},
			     	change: function( event, ui ) {
			     		window.location.href = "procurarAnime.php?nome='"+$("#animesProcurar").val().trim()+"'";
			     	}
			    });

			</script>
		</div>
		<div class="header-top-right">
			<div class="signin">
				<script type="text/javascript" src="js/modernizr.custom.min.js"></script>    
				<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
				<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
				<script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>	


				<?php 

					if(isset($_SESSION['USUARIO'])){
						?>

							<div style="float: right !important;">
								<span><h4>Logado como: <?php echo $_SESSION['USUARIO']['nome']; ?></h4></span>
								
							</div>

						<?php						
					}else{
						?>
							<a href="cadastroUsuario.php" style="background-color: orange;" class="play-icon">Cadastrar-se</a>';
							<a href="login.php" class="play-icon">Logar</a>
						<?php
					}

				?>

				
				<!-- <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Logar</a> -->
				<div id="small-dialog" class="mfp-hide">
					<h3>Logar</h3>
					<div class="signup">
						<form>
							<input type="text" class="email" placeholder="E-Mail" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?"/>
							<input type="password" placeholder="Senha" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
							<input type="submit" value="LOGAR"/>
						</form>
						<!-- <div class="forgot"> -->
							<!-- <a href="#">Esqueceu sua senha?</a> -->
						<!-- </div> -->
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
    </div>
	<div class="clearfix"> </div>
  </div>
</nav>