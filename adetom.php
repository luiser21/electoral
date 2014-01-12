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
							<img src="images/<?php echo $_SESSION["username"]?>.png" alt="">
							<div class="banner">
								<span class="title"><span class="color2"><?php echo $_SESSION["nombre"]?></span><span class="color1" style="color: #E60000"> a la <?php echo ucwords(strtolower($_SESSION["tipocandidato"]))?> por</span><span>
								<?php if($_SESSION["tipocandidato"]=='SENADO'){ echo 'De la República'; 
									}else if($_SESSION["tipocandidato"]=='ALCALDIA' || $_SESSION["tipocandidato"]=='CONSEJO'){ echo ucwords(strtolower($_SESSION['municipio'])); 
									}else if($_SESSION["tipocandidato"]=='CAMARA' || $_SESSION["tipocandidato"]=='GOBERNACION'){ echo ucwords(strtolower($_SESSION['departamento'])); }?></span></span>
								<h2 style="font-size:30px" class="color1"><?php echo $_SESSION["partido"]?></h2>
								
							</div>
						</li>
						
						<li>
							<img src="images/lideres.png" alt="">
								<div class="banner">
								<span class="title"><span class="color2">Gestione</span><span class="color1">Lideres de</span><span>Campa&ntilde;a</span></span>
								<p>Aumente su capacidad de Comunicaci&oacute;n generando credibilidad y confianza.</p>
								
							</div>
						</li>
						<li>
							<img src="images/miembros.png" alt="" >
							<div class="banner">
								<span class="title"><span class="color2">Gestione</span><span class="color1">Simpatizantes</span><span>que lo apoyan</span></span>
								<p>Administre los ciudanos, descargue informes con sus puestos de votaci&oacute;n.</p>
							
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