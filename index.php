<?php require_once('top.php'); ?>
<script src="js/countdown.js"></script>
<style>
.bg1 {  
	position: absolute;
	top:850px;
}
button, input[type="button"], input[type="submit"] {
   background-color: #A1AAAF;
    border: 0 none;
    color: #FFFFFF;
    cursor: pointer;
    font-family: arial,helvetica,sans-serif;
    font-size: 15px;
    font-weight: bold;
     height: 32px;
    margin-right: 0px;
   /* width: 108px;*/
}
</style>
<script>
		$(document).ready(function(){
			$("#countdown").countdown({
				date: "08 march 2014 23:59:59",
				format: "on"
			},
			function() {
				// callback function
			});
		});
	</script>			
		<div class="main">
<!--header -->
			<header>				
				<div id="slider">
					<ul class="items">
						<li>
							<img src="images/img1.png" alt="">
							<div class="banner">
								<span class="title"><span class="color2">Elecciones</span><span class="color1">Parlamentarias</span><span> 2014</span></span>
								<p>Cuenta Regresiva para el 09 de Marzo<div class="timer-area" style=" margin-right:-100px">	
										<ul id="countdown">
											<li>
												<span class="days">00</span>
												<p class="timeRefDays">days</p>
											</li>
											<li>
												<span class="hours">00</span>
												<p class="timeRefHours">hours</p>
											</li>
											<li>
												<span class="minutes">00</span>
												<p class="timeRefMinutes">minutes</p>
											</li>
											<li>
												<span class="seconds">00</span>
												<p class="timeRefSeconds">seconds</p>
											</li>
										</ul>
										
									</div> </p>
								
							</div>
						</li>
						<li>
							<img src="images/img2.png" alt="" >
							<div class="banner">
								<span class="title"><span class="color2">Innovaci&oacute;n</span><span class="color1">y Desarrollo a su</span><span style="font-size:36px">Servicio</span></span>
								<p >En donde las encuestas y estrategias sean aplicadas correctamente, obteniendo el exito de su campaña</p>
								
							</div>
						</li>
						<li>
							<img src="images/img3.png" alt="">
							<div class="banner">
								<span class="title"><span class="color2">Contacto</span><span class="color1">directo con sus Simpatizantes </span><span></span>y Lideres</span>
								<p></p>
							
							</div>
						</li>
					</ul>
			  </div>
			</header>
<!--header end-->
<!--content -->
			
		
		<article id="content"><div class="ic"></div>
				<div class="wrapper">
					<div class="col1 marg_right1">
						<h2 style="font-size:25px; margin-left: 30px;">¿D&oacute;nde Votar? </h2>
						<p><img src="images/ico-registraduria.png" width="149" height="101" style="margin-left: 30px;"><a  class='iframe2' href="consulta_2.php" ><input type="button"  value="BUSQUE SU PUESTO" name="cmdexport" style=" margin-left: 30px; margin-top:33px" ></a></p>
										</div>
					<div class="col1 marg_right1" style="width:348px">
						<h2 style="font-size:25px; margin-left: 50px;">Conozca a sus Candidatos </h2> 
						<p><img src="images/ico-congreso-visible.png" width="183" height="116" style="margin-left: 90px;">
					 <a  href="http://www.congresovisible.org/agora/post/conozca-a-los-candidatos-por-partido-politico/6200/" target="_blank" > <input type="button"  value="ENCUENTRE SU CANDIDATO" name="cmdexport" style=" margin-left: 65px; margin-top:18px"></a></p>
					
					</div>
					<div class="col1 marg_right1"  style="width:250px">
							<h2 style="font-size:22px;  margin-left: 58px;">¿Quienes financian los Candidatos? </h2>
						    <blockquote>
						      <p><img src="images/ico-cuentas.png" width="117" height="101" style="margin-left: 90px;"><a  href="http://www5.registraduria.gov.co/CuentasClaraspublicoCon2014/consultas/consultacandidatos"  target="_blank"><input type="button"  value="VER APORTES DE LA CAMPA&Ntilde;A" name="cmdexport" style=" margin-left: 35px; margin-top:12px;"></a></p>
				      </blockquote>
					</div>
					
				</div>
		  </article>
			</div>
		<script type="text/javascript"> Cufon.now(); </script>
		<script>
			$(window).load(function(){
				$('#slider')._TMS({
					banners:true,
					waitBannerAnimation:false,
					preset:'diagonalFade',
					easing:'easeOutQuad',
					pagination:true,
					duration:400,
					slideshow:8000,
					bannerShow:function(banner){
						banner.css({marginRight:-500}).stop().animate({marginRight:0}, 600)
					},
					bannerHide:function(banner){
						banner.stop().animate({marginRight:-500}, 600)
					}
					})
			})
		</script>
	<?php require_once('bottom.php'); ?>			
	