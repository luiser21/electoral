<?php
header('Content-Type: text/html; charset=ISO-8859-1'); 
	session_start();
    include_once "includes/GestionBD.new.class.php";
	$DBGestion = new GestionBD('AGENDAMIENTO');	
	// Si la sesion no est� activa y/o autenticada ingresa a este paso
	if (!isset($_SESSION["active"]) == 1)
	{
		header("location:index.php");
	}
	// Si la sesion est� activa y autenticada ingresa a este paso
	else
	{
		// toma las variables de sesion y de edicion de contenidos		
		$usuario = $_SESSION["username"];
		$permiso = $_SESSION["permiso"];
		$consulta=$_SESSION["consulta"];
		$nombre = $_SESSION["nombre"];
		if($consulta==1){
			$nombre="Usuario de Consulta";
		}
		
	}
?>
<?php 
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
<style>
#logo3 {  position:absolute; float: left; margin-left: -47px; top:48px; 0px 0px no-repeat;width:500px;height:90px}
#logo4 {  position:absolute; float: left; margin-left: 771px; top:50px;  0px 0px no-repeat;width:500px;height:90px}
	
/****      ****/
/**** MARQUESINA ****/
#marquesina {background: url("images/marquesina.gif") no-repeat scroll transparent;height: 37px;width: 960px;margin:5px 195px 6px 195px;}
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
#marquesina2 {
color:#008000;
   font: oblique bold 100% cursive; 
    height: 37px;
	font-size:20px;
    margin: 5px 199px 6px;
    width: 545px;
}

#marque2 > div {
    height: 88px;
    overflow: hidden;
    width: 545px;
}

</style>
<link href="Scripts/jtable/themes/metro/lightgray/jtable.css" rel="stylesheet" type="text/css" />
<title>SIGE</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/favicon(2).ico">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/slide.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/master.css" type="text/css" media="all"> 
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
<link rel="stylesheet" href="css/careers_lightbox/colorbox.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css"/> 
<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />	
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>

<script type='text/javascript' src='js/jquery.min.js'></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 
<script type="text/javascript" src="js/jquery-1.6.js" ></script> 
<script type="text/javascript" src="js/FAjax.js"></script>
<script type="text/javascript" src="js/jquery.colorbox.js"></script> 
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/slide.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/atooltip.jquery.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script> 
<script type="text/javascript" src="js/Vegur_300.font.js"></script>
<script type="text/javascript" src="js/PT_Sans_700.font.js"></script>
<script type="text/javascript" src="js/PT_Sans_400.font.js"></script>
<script type="text/javascript" src="js/tms-0.3.js"></script>
<script type="text/javascript" src="js/tms_presets.js"></script>-->
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	 <script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
	 <script src="js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
		jQuery(document).ready(function(){
			jQuery("#form2").validationEngine();
		});	
</script>	
<!-- <div id="logo4">
					
						<span class="textRequired"> * </span>
							Cedula
					
						<input id="cedula" type="text" value="" name="cedula" class="validate[required,custom[integer]] " style="width: 150px;">&nbsp;&nbsp;&nbsp;<a  class='iframe' href="consulta.php" ><span style=" font-size:11px;">Donde Votar??<img src="images/padrones-2013-donde-votar.png" id="inputField"  style="cursor:pointer" width="40px" height="31px"></span></a>
	<div>	 -->
		<?php 
			if ($_SESSION["active"] == 1)
			{
				$sesion= "No se ha iniciado sesi&oacute;n";
			}
			else
			{
				$sesion= "<span class=\"style1\"><b> </b></span> ".$nombre; 
			}
		?>
		</head>
		<body id="page1">
	<div id="toppanel">
		<div id="panel">
			<div class="content clearfix">
				<div class="left">
						</div>
				<div class="left">
					
				</div>
				<div class="left">
					
				</div>
			</div>
	</div> 	
		<div class="tab">
			<ul class="login">
				<li class="left">&nbsp;</li>
				<li>Bienvenido! <?php echo "   ".$sesion?></li>
				<li class="sep">|</li>
				<li id="toggle">
					<a  class="close" href="logout.php">Cerrar Session</a>
					<a id="close" style="display: none;" class="close" href="#">Cerrar Session</a>			
				</li>
				<li class="right">&nbsp;</li>
			</ul> 
		</div> <!-- / top -->		
	</div> <!--panel -->			
					<div class="wrapper">
							<h1><a href="#" id="logo2"></a><a href="#" id="logo">SIGE </a><a href="#" id="logo3"><div id="marquesina2">
<div id="marque2">
<div class="first">
<marquee>	<img src="images/logo.png" width="60" height="40">
Sistema Integrado de Gestion Electoral
</marquee>
</div>
</div>
</div></a> <a href="#" id="logo6"><div id="marquesina2">

</div></a></h1>
						
							<fieldset>
								<div class="bg">      </div>
							</fieldset>						
					</div>
					<nav >
					<div id="menu">
						<?php    
						if($permiso!='1'){
							include_once "menu.php"; 
						}else{
							include_once "menuadmin.php";
						} ?>					 
					</div>						
					</nav>			