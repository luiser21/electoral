<?php

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
<?php 
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<head>

<title>SIGE</title>
<link rel="shortcut icon" href="images/favicon(2).ico">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/slide.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/master_2.css" type="text/css" media="all"> 
<link rel="stylesheet" type="text/css" href="css/menu.css"/> 


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
							<h1><a href="#" id="logo2"></a><a href="#" id="logo">SOPAC </a><a href="#" id="logo3"></a> </h1>
						
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