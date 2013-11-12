<?php require_once('topadmin.php'); ?>	
<style>
.bg1 {  
	position: absolute;
	top:800px;
}
</style>			
<div class="main">					
			<header>				
				<div id="slider">
					<ul class="items">
						<li>
						<?php if($_SESSION["username"]=='edgarcarreno'){?>
							<img src="images/puzzle.png" alt="">
								<?php }else{?>
									<img src="images/puzzle.png" alt="">
									<?php } ?>
							<div class="banner">
								<span class="title"><span class="color2">Bienvenido</span><span class="color1">Modulo</span><span>Candidato</span></span>
								<p>Administre y realice configuraciones de la informaci&oacute;n que posee</p>
								
							</div>
						</li>
						<li>
							<img src="images/usuario.png" alt="" >
							<div class="banner">
								<span class="title"><span class="color2">Controle los</span><span class="color1">Accesos de</span><span>Usuarios</span></span>
								<p>Administre la red,los usuarios que acceden al sistemas y realice cargues masivos.</p>
							
							</div>
						</li>
						<li>
							<img src="images/img32.jpg" alt="">
								<div class="banner">
								<span class="title"><span class="color2">Conviertase </span><span class="color1">en el Lider </span><span>que desea ser</span></span>
								<p>Aumente su capacidad de Comunicaci&oacute;n generando credibilidad y confianza.</p>
								
							</div>
						</li>
					</ul>
			  </div>
			</header>	
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
						<a  class='iframe' href="#"  >Consulte lugar Votaci&oacute;n</a>
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