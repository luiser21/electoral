<!DOCTYPE html>
<html lang="es">
<head>
<link rel="shortcut icon" href="images/favicon(2).ico">
<title>SOPAC</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/slide.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<script type="text/javascript" src="js/jquery-1.6.js" ></script>
<link rel="stylesheet" type="text/css" href="css/menu.css"/> 
<script src="js/superfish.js"></script>
<script src="js/slide.js" type="text/javascript"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>  
<script type="text/javascript" src="js/Vegur_300.font.js"></script>
<script type="text/javascript" src="js/PT_Sans_700.font.js"></script>
<script type="text/javascript" src="js/PT_Sans_400.font.js"></script>
<script type="text/javascript" src="js/tms-0.3.js"></script>
<script type="text/javascript" src="js/tms_presets.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/atooltip.jquery.js"></script>		
<script src="js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<script>
		jQuery(document).ready(function(){
			jQuery("#form2").validationEngine();
		});	
</script>		
</head>
<body id="page1">	
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">				
			</div>
			<div class="left">
				<!-- Login Form -->
				<form id="form2" class="formular" method="post" action="administrador.php">				
						<h1>Iniciar Session</h1>
						<label class="grey" for="log">Usuario:</label>
						<input  type="text" name="log" id="log" value=""  class="validate[required]"  size="23" />
						<label class="grey" for="pwd">Contrase&ntilde;a:</label>
						<input class="validate[required]" type="password" name="pwd" id="pwd" size="23" />
		            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Recordarme</label>
	        			<div class="clear"></div>
							<input class="submit" type="submit" value="Ingresar"/>					
						<a class="lost-pwd" href="#">Olvido su Contrase&ntilde;a?</a>
					</form>
			</div>
			<div class="left">				
			</div>
		</div>
</div> <!-- /login -->	
	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li>Bienvenido!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Ingresar</a>
				<a id="close" style="display: none;" class="close" href="#">Cerrar Panel</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->	
</div> <!--panel -->		
				<div class="wrapper">
					<h1><a href="#" id="logo2"></a><a href="#" id="logo">SOPAC </a> </h1>
					
						<fieldset>
							<div class="bg">      </div>
						</fieldset>					
				</div>
				<nav >
				<div id="menu">
					<ul id="nav">
						<li class="current"><a href="index.php">Inicio</a></li>
						<li><a href="#">Quienes Somos</a></li>
						<li><a href="#">T&eacute;rminos Oficiales</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Acerca del Programa</a></li>
						<li><a href="#">Casos de Exito</a></li>
						<li><a href="#">Cont&aacute;ctenos</a></li>
					</ul>
				</div>					
				</nav>				