<?php require_once('topadmin.php'); ?>	
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
<?php 
//imprimir($_SESSION);
?>			
<div class="main">					
			<header>				
				<div id="slider">
					<ul class="items">
						<li>
							<img src="images/<?php echo $_SESSION["username"]?>.png" alt="">
							<div class="banner">
								<span class="title"><span class="color2"><?php echo $_SESSION["nombre"]?></span><span class="color1" style="color: #E60000">
								<?php if($_SESSION["tipocandidato"]=='SENADO'){ 
										echo 'al '.ucwords(strtolower($_SESSION["tipocandidato"])). '</span><span> De la Rep&uacute;blica'; 
									}else if($_SESSION["tipocandidato"]=='ALCALDIA' || $_SESSION["tipocandidato"]=='CONSEJO'){ 
										if($_SESSION["tipocandidato"]=='ALCALDIA'){
											echo 'a la '.ucwords(strtolower($_SESSION["tipocandidato"])).' por </span><span>';
										}
										if($_SESSION["tipocandidato"]=='CONSEJO'){
											echo 'al '.ucwords(strtolower($_SESSION["tipocandidato"])).' por </span><span>';
										}
										echo ucwords(strtolower($_SESSION['municipio'])); 
									}else if($_SESSION["tipocandidato"]=='CAMARA' || $_SESSION["tipocandidato"]=='GOBERNACION'){ 
										echo 'a la '.ucwords(strtolower($_SESSION["tipocandidato"])).' por </span><span>';										
										echo ucwords(strtolower($_SESSION['departamento'])); 
									}?></span></span>
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
		<article id="content"><div class="ic"></div>
				<div class="wrapper">
					<div class="col1 marg_right1">
						<h2 style="font-size:25px; margin-left: 22px;">&iquest;D&oacute;nde Votar? </h2>
						<p><img src="images/ico-registraduria.png" width="149" height="101" style="margin-left: 30px;"><a  class='iframe2' href="consulta_2.php" ><input type="button"  value="BUSQUE SU PUESTO" name="cmdexport" style=" margin-left: 30px; margin-top:33px; width:180px" ></a></p>
										</div>
					<div class="col1 marg_right1" style="width:348px">
						<h2 style="font-size:25px; margin-left: 50px;">Conozca a sus Candidatos </h2> 
						<p><img src="images/ico-congreso-visible.png" width="183" height="116" style="margin-left: 90px;">
					 <a  href="http://www.congresovisible.org/agora/post/conozca-a-los-candidatos-por-partido-politico/6200/" target="_blank" > <input type="button"  value="ENCUENTRE SU CANDIDATO" name="cmdexport" style=" margin-left: 65px; margin-top:18px; width:250px"></a></p>
					
					</div>
					<div class="col1 marg_right1"  style="width:250px">
							<h2 style="font-size:22px;  margin-left: 58px;">&iquest;Quienes financian los Candidatos? </h2>
						    <blockquote>
						      <p><img src="images/ico-cuentas.png" width="117" height="101" style="margin-left: 90px;"><a  href="http://www5.registraduria.gov.co/CuentasClaraspublicoCon2014/consultas/consultacandidatos"  target="_blank"><input type="button"  value="VER APORTES DE LA CAMPA&Ntilde;A" name="cmdexport" style=" margin-left: 35px; margin-top:12px;width:250px"></a></p>
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