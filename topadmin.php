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
		$nombre = $_SESSION["nombre"];
		
	}
?>
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
				<link rel="stylesheet" href="css/master.css" type="text/css" media="all"> 
				
	
	<!-- <link rel="stylesheet" type="text/css" href="css/menu.css"/> -->

<script type='text/javascript' src='js/jquery.min.js'></script>
	  <script type="text/javascript" src="js/jquery.js"></script>
 <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script> 
 	<script type="text/javascript" src="js/jquery-1.6.js" ></script> 

	<script src="js/superfish.js"></script>
		<script src="js/slide.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/cufon-yui.js"></script>
		<script type="text/javascript" src="js/cufon-replace.js"></script>  
		<script type="text/javascript" src="js/Vegur_300.font.js"></script>
		<script type="text/javascript" src="js/PT_Sans_700.font.js"></script>
		<script type="text/javascript" src="js/PT_Sans_400.font.js"></script>
		<script type="text/javascript" src="js/tms-0.3.js"></script>
		<script type="text/javascript" src="js/tms_presets.js"></script>
	


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
		
		<!-- Panel -->
	<div id="toppanel">
		<div id="panel">
			<div class="content clearfix">
				<div class="left">
					
				</div>
				<div class="left">
					<!-- Login Form -->
					<form class="clearfix" action="#" id="form2" name="form2" method="post" >
						<h1>Iniciar Session</h1>
						<label class="grey" for="log">Usuario:</label>
						<input class="field" type="text" name="log" id="log" value="" size="23" />
						<label class="grey" for="pwd">Contrase&ntilde;a:</label>
						<input class="field" type="password" name="pwd" id="pwd" size="23" />
		            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Recordarme</label>
	        			<div class="clear"></div>
						<input  type="button" name="Submit" value="Ingresar" class="bt_login"  onClick="verif()"/>
						
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
							<h1><a href="index.html" id="logo2"></a><a href="index.html" id="logo">SOPAC </a> </h1>
						
							<fieldset>
								<div class="bg">      </div>
							</fieldset>
						
					</div>
					<nav>
					<div id="menu">
						<?php    include_once "menu.php"; ?>
					  <!--  <ul class="sf-menu" >
					    		<li class="active"><a href="partidos_politicos.php"><span>Partidos Politicos</span></a></li>
											<li><a href="reporte_candidatos.php"><span>Candidatos</span></a></li>
											<li><a href="lideres.php"><span>Lideres</span></a></li>
											<li><a href="Services.html"><span>Usuarios</span></a></li>
											<li class="last"><a href="Contacts.html"><span>Miembros</span></a></li>
					    </ul>-->
					</div>
						
					</nav>
					
				