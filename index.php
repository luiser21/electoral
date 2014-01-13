<?php require_once('top.php'); ?>
<script src="js/countdown.js"></script>
<style>
.bg1 {  
	position: absolute;
	top:800px;
}
</style>
<script>
		$(document).ready(function(){
			$("#countdown").countdown({
				date: "09 march 2014 12:00:00",
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
								<p>Obtenga informaci&oacute;n detallada para ganar sus elecciones.</p>
							
							</div>
						</li>
					</ul>
			  </div>
			</header>
<!--header end-->
<!--content -->
			
		
		<article id="content"><div class="ic">More Website Templates @ TemplateMonster.com - November 14, 2011!</div>
				<div class="wrapper">
					<div class="col1 marg_right1">
						<h2>Consulting</h2>
						<p>Superior.com is one of <a href="http://blog.templatemonster.com/free-website-templates/" target="_blank">free website templates</a> created by TemplateMonster.com. It is also XHTML & CSS valid.</p>
					</div>
					<div class="col1 marg_right1">
						<h2>An&aacute;lisis</h2>
						<p>This website template has sev- eral pages: <a href="index.html">Home</a>, <a href="Company.html">Company</a>, <a href="Solutions.html">Solutions</a>, <a href="Services.html">Services</a>, <a href="Contacts.html">Contact Us</a> (contact form – doesn’t work).</p>
					</div>
					<div class="col1 marg_right1">
							<h2>Estrategias</h2>
						<p>This <a href="http://blog.templatemonster.com/2011/11/14/free-website-template-jquery-slider-business-project/" target="_blank" rel="nofollow">Superior Template</a> goes with two packages. PSD source files are available for the registered members.</p>
					</div>
					<div class="col1">
						<h2>Servicios</h2>
						<ul class="list1">
							<li><a href="#">Sed ut perspiciatis unde </a></li>
							<li><a href="#">Omnis iste natus errorsitvo</a></li>
							<li><a href="#">Uptatem acusantium domque </a></li>
							<li><a href="#">Laudantium totam rem</a></li>
						</ul>
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
	