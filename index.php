<?php require_once('top.php'); ?>
<script src="js/countdown.js"></script>
<style>
.bg1 {  
	position: absolute;
	top:900px;
	width: 100%;
	right: 0px;
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
/****      ****/
/**** MARQUESINA ****/
#marquesina {background: url("images/marquesina.gif") no-repeat scroll transparent;height: 37px;width: 960px;margin:5px 195px 6px 195px;
position: absolute;
width: 958px;
    margin-top: 183px;
    margin-left: 0px;}
.tickercontainer { width: 810px; height: 40px; margin: 0 0 0 10px; padding: 0;overflow: hidden; }
.tickercontainer .mask { position: relative;left: 10px;top: 11px;width: 810px;overflow: hidden;}
ul.newsticker { position: relative;left: 835px;list-style-type: none;margin: 0;padding: 0;}
ul.newsticker li {float: left;margin: 0;padding: 0;}
ul.newsticker a {font-family: verdana;text-decoration: none;font-size: 12px;white-space: nowrap;padding: 0;color: #335D89;text-decoration:none;margin: 0 150px 0 0;} 
ul.newsticker a:hover {text-decoration: underline;} 
#cadena {
	visibility: hidden;
}
#marque {
    float: left;
    margin: 10px 0 0 10px;
}
#marque > div {
    height: 18px;
    overflow: hidden;
    width: 810px;
}
#slider{
	margin-top: 30px;
}#content {
    margin-top: 613px;
    padding-bottom: 0;
}

</style>
<script>
		$(document).ready(function(){
			$("#countdown").countdown({
				date: "8 march 2026 08:00:00",
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
			
				
				<div id="marquesina">
<div id="marque">
<div class="first">
<marquee>
<strong><span style="color:#f45805">ELECCIONES DE CONGRESO DE LA REPUBLICA 2026</span></strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--<strong><span style="color:#0008ff">DE TODOS Y PARA TODOS LOS COLOMBIANOS</span></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;t &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong><span style="color:#ff0000">DE TODOS Y PARA TODOS LOS COLOMBIANOS</span></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
-->
<!--<strong> DESDE EL 11 DE ENERO AL 11 DE FEBRERO DE 2018 </strong><span>Sorteo y publicación de listas de jurados de votación (Durante un mes). </span><span style="color:#FF0000"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong> 29 DE ENERO DE 2018 </strong><span style="color:#FF0000"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
-->
</marquee>
</div>
</div>
</div>	<div id="slider">
					<ul class="items"> 
						<li>
							<img src="images/img1.png" alt="">
							<div class="banner">
								<span class="title"><span class="color2">Elecciones</span><span class="color1">Congreso</span><span>2026</span></span>
								<p>DIA DE LA ELECCION 8 de Marzo de 2026<div class="timer-area" style=" margin-right:-100px">
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
						<!--<li>
							<img src="images/img2.png" alt="" >
							<div class="banner">
								<span class="title"><span class="" style="color:#FFFFFF">Innovaci&oacute;n</span><span class="color1">y Desarrollo a su</span><span style="font-size:36px">Servicio</span></span>
								<p >En donde las encuestas y estrategias sean aplicadas correctamente, obteniendo el exito de su campaña</p>
								
							</div>
						</li>
						<li>
							<img src="images/img3.png" alt="">
							<div class="banner">
								<span class="title"><span class="color2">Contacto</span><span class="color1">directo con sus Simpatizantes </span><span></span>y Lideres</span>
								<p></p>
							
							</div>
						</li>-->
					</ul>
			  </div>
			</header>
<!--header end-->
<!--content -->
			
		
		<article id="content"><div class="ic"></div>
				<div class="wrapper">
					<div class="col1 marg_right1">
						<h2 style="font-size:25px; margin-left: 30px;">¿D&oacute;nde Votar? </h2>
						<p><img src="images/1533886.png" width="149" height="101" style="margin-left: 30px;">
						<a  class='iframe2' href="https://wsp.registraduria.gov.co/censo/consultar/" target="iframe_a">
						<input type="button"  value="BUSQUE SU PUESTO" name="cmdexport" style=" margin-left: 30px; margin-top:33px" >
						</a>
						</p>
										</div>
					<div class="col1 marg_right1" style="width:348px">
						<h2 style="font-size:25px; margin-left: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;Autoridades  Locales </h2> 
						<p><img src="images/mesas.png" width="183" height="116" style="margin-left: 90px;">
					 <a  href="https://www.registraduria.gov.co/-AL-2019-.html" target="_blank" >
					<input type="button"  value="ELECCIONES ORDINARIAS 2019" name="cmdexport" style=" margin-left: 65px; margin-top:18px">
					</a></p>
					
					</div>
					<div class="col1 marg_right1"  style="width:250px">
							<h2 style="font-size:20px;  text-align:center;">Sistema de Gesti&oacute;n de <br/> Testigos Electorales</h2>
						    <blockquote>
						      <p style="text-align:center;"><img src="images/testigos.png" width="117" height="101" style="display:block; margin:0 auto;">
							   <a  href="../metronic/login.html" target="_blank">
							  <input type="button"  value="INGRESO AL SISTEMA" name="cmdexport" style="margin-top:12px;">
							  </a>
							  </p>
				      </blockquote>
					</div>
					
				</div>
		  </article>
			</div>
		<!--<script type="text/javascript"> Cufon.now(); </script>-->
		<script>
			$(window).load(function(){
				$('#slider')._TMS({
					banners:true,
					waitBannerAnimation:false,
					preset:'diagonalFade',
					easing:'easeOutQuad',
					pagination:true,
					duration:900,
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
	