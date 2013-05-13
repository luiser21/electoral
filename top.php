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
		<script language="javascript">
function verif(){
  // if(document.getElementById('login').value == ""){
    //   document.getElementById('error1').style.visibility = "visible";
	 //  document.getElementById('camp1').style.backgroundColor = "#FF0000";
	 //  document.getElementById('login').focus();
     //  return false;
  // }
  // if(document.getElementById('password').value == ""){
    //   document.getElementById('error2').style.visibility = "visible";
	//   document.getElementById('cam2').style.backgroundColor = "#FF0000";
	//   document.getElementById('password').focus();
    //   return false;
  // }
   document.form2.action = "administrador.php";
   document.form2.submit();
}
</script>
		<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5.js"></script>
		<link rel="stylesheet" href="css/ie.css" type="text/css" media="all">
		<![endif]-->
		<!--[if lt IE 7]>
			<div style=' clear: both; text-align:center; position: relative;'>
				<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a>
			</div>
		<![endif]-->
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
					<h1><a href="index.html" id="logo2"></a><a href="index.html" id="logo">SOPAC </a> </h1>
					
						<fieldset>
							<div class="bg">      </div>
						</fieldset>
					
				</div>
				<nav>
				<div id="menu">
				    <ul class="sf-menu" >
				    		<li class="active"><a href="index.html"><span>Homepage</span></a></li>
										<li><a href="Company.html"><span>Company</span></a></li>
										<li><a href="Solutions.html"><span>Solutions</span></a></li>
										<li><a href="Services.html"><span>Services</span></a></li>
										<li class="last"><a href="Contacts.html"><span>Contacts</span></a></li>
				    </ul>
				</div>
					
				</nav>
				
			