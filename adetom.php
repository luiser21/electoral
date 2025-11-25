<?php require_once('topadmin_slider.php'); ?>	
<style>
.bg1 {  
	position: absolute;
	top:900px;
	width: 100%;
	right: 0px;
}
#logo {margin-top: -49px; margin-left: 300px; height:110px}
#logo2 {margin-top: -42px; width:250px;height:90px}
#menu  {padding-top:106px}
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
    padding: 0 12px;       /* agregado: espacio horizontal */
    white-space: nowrap;   /* agregado: evita que el texto se corte/rompa */
    min-width: 210px;      /* agregado: ancho mínimo para que quepa el texto */
    display: inline-block; /* asegura comportamiento consistente */
}
.main {
    bottom: 197px;
    margin: 0 auto;
    position: relative;
    width: 960px;
}

</style>
<?php 
$sql="";
/*if($_SESSION["username"]!='celispabon'){
	$sql="SELECT
sum(boletines.MOVILIZADOS) AS MOVILIZADOS
FROM
boletines
INNER JOIN candidato ON candidato.ID = boletines.CANDIDATO
INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
where usuario.USUARIO='".$_SESSION["username"]."'";
}else{
	
	*/
	$sql="SELECT SUM(MOVILIZADOS) AS MOVILIZADOS FROM (SELECT
					count(miembros.ID) as MOVILIZADOS
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					LEFT JOIN miembros ON miembros.IDPUESTOSVOTACION = p.IDPUESTO
					left JOIN lideres ON lideres.ID = miembros.IDLIDER
					left JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					LEFT JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."' ";
				if($_SESSION["tipocandidato"]=="ALCALDIA"){
					$sql.=" and municipios.NOMBRE='".$_SESSION["municipio"]."' ";
				}					
				$sql.=" GROUP BY p.IDPUESTO) AS TABLA";
/*$sql="SELECT
	count(recoleccion_cedulas.cedulas) as MOVILIZADOS	
	FROM
	puestos_votacion
	INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
	INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
	INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
	where usuario.USUARIO='".$_SESSION["username"]."'";*/
//}

$DBGestion->ConsultaArray($sql);				
$totales=$DBGestion->datos;	
 number_format($totales[0]['MOVILIZADOS'], 0, '', '.');
	   $voto_cargue= number_format($totales[0]['MOVILIZADOS'], 0, '', '.');
	   //echo  $voto_cargue;
?>		
<div id="marquesina">
<div id="marque">
<div class="first">
<marquee>
<!-- VOTOS PREVISTOS:  <span style="color:#FF0000"><?php echo $voto_cargue.' Simpatizantes';?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  -->
 <? if($_SESSION["username"]=='yesid'){?>
 Por un Ricaurte prospero para Todos
  <? } ?>
</marquee>
</div>
</div>
</div>	
<div class="main">					
			<header>				
				<div id="slider">
					<ul class="items">
						<li>
							<img src="images/<?php echo $_SESSION["username"]?>.png" alt="">
							<div class="banner">
						<!--	<? if($_SESSION["username"]!=52890539){?>
								<span class="title"><span class="color2" style="font-size:35px"><?php echo $_SESSION["nombre"]?></span>
								<span class="color1" style="color: #E60000; font-size:28px">
								<?php if($_SESSION["tipocandidato"]=='SENADO'){ 
										echo 'Senador </span><span style="font-size:35px"> 2018-2022'; 
									}else if($_SESSION["tipocandidato"]=='ALCALDIA' || $_SESSION["tipocandidato"]=='CONSEJO'){ 
										if($_SESSION["tipocandidato"]=='ALCALDIA'){
											echo 'Alcalde Municipal de</span><span style="font-size:35px">';
											
										}
										if($_SESSION["tipocandidato"]=='CONSEJO'){
											echo 'al '.ucwords(strtolower($_SESSION["tipocandidato"])).' del </span><span style="font-size:35px">';
										}
										echo ' '.ucwords(strtolower($_SESSION['municipio'])).' '.$_SESSION['abreviatura']; 
										echo '<span style="font-size:35px"> 2020-2023</span>'; 
									}else if($_SESSION["tipocandidato"]=='CAMARA' || $_SESSION["tipocandidato"]=='GOBERNACION'){ 
										echo 'a la '.ucwords(strtolower($_SESSION["tipocandidato"])).' por </span><span style="font-size:35px">';										
										echo ucwords(strtolower($_SESSION['departamento'])); 
									}?></span></span>
								<span style="font-size:30px" class="color1"><?php echo $_SESSION["partido"]?></span>
								<? } ?>
								-->
							</div>
						</li>
						
						<li>
							<img src="images/lideres.png" alt="">
								<div class="banner">
								<!-- <span class="title"><span class="color2">Gestion con Efectividad</span><span class="color1">Hacia sus</span><span>Lideres</span></span>
								<p>Aumente su capacidad de llegar con credibilidad y confianza.</p> -->
								
							</div>
						</li>
						<li>
							<img src="images/miembros.png" alt="" >
							<div class="banner">
								<span class="title"><span class="color2">Conozca sus</span><span class="color1">Simpatizantes</span><span>y Lideres que lo respaldan</span></span>
								<!-- <p>SIGE una Herramienta que acerca al candidato con los ciudadanos.</p> -->
							
							</div>
						</li>
					</ul>
			  </div>
			</header>	
		<article id="content"><div class="ic"></div>
				<div class="wrapper">
					<div class="col1 marg_right1">
						<h2 style="font-size:25px; margin-left: 30px;">Donde Votar </h2>
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