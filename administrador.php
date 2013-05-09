<?php 
session_start();
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');
	// Si la sesion no está activa y/o autenticada ingresa a este paso
	if (@$_SESSION["active"] != 2)
	{
		
			@$usuario = $_POST["log"];
			@$password = $_POST["pwd"];

            if(@$usuario != ""){
				//Encriptar el password para hacer match con el registro en la DB
				$password = sha1($password);	
			
				$sql="SELECT * FROM USUARIO WHERE USUARIO = '$usuario' and CONTRASENA ='$password' and ACTIVO = 'Y'";
				$DBGestion->ConsultaArray($sql);
				$usuarios=$DBGestion->datos;
				
				foreach ($usuarios as $datos){
				     $usu = $datos['USUARIO'];
					 $per = $datos['PERMISO'];
					 $nombre = $datos['NOMBRE'];						 
				}
				
				if(@$usu != "" && $per == 1){
				    $_SESSION["username"] = $usu;
					$_SESSION["active"] = 2;
					$_SESSION["permiso"] = $per;
					$_SESSION["nombre"] = $nombre;						
					header("location:adetom.php");    
				}
                if(@$usu != "" && $per == 2){
				    $_SESSION["username"] = $usu;
					$_SESSION["active"] = 2;
					$_SESSION["permiso"] = $per; 
					$_SESSION["nombre"] = $nombre;	
				}
				
				if(@$usu != "" && $per == 3){
				    $_SESSION["username"] = $usu;
					$_SESSION["active"] = 3;
					$_SESSION["permiso"] = $per;
					$_SESSION["nombre"] = $nombre;			
					header('Location: adestructura1.php');	    
				}
				if(@$usu != "" && $per == 4){
				    $_SESSION["username"] = $usu;
					$_SESSION["active"] = 4;
					$_SESSION["permiso"] = $per;
					$_SESSION["nombre"] = $nombre;	
					header('Location: Sox/Ingresar.php');	    
				}
				if(@$usu != "" && $per == 5){
				    $_SESSION["username"] = $usu;
					$_SESSION["active"] = 5;
					$_SESSION["permiso"] = $per;
					$_SESSION["nombre"] = $nombre;		
					header('Location: Sox/Ingresar.php');	    
				}
			} 
			else 
				{
					// Registra sesion activa no autenticada y recarga "administrador.php" con las credenciales
					session_register("id");
					$_SESSION["active"] = 1;


				}			
	}
		
	// Si la sesion está activa y autenticada ingresa a este paso
	else
	{
		
		// toma las variables de sesion y de edicion de contenidos
		$usuario = $_SESSION["username"];
		$per = $_SESSION["permiso"];	
		if($usuario != "" && $per == 1){
			header('Location: adetom.php');	    
		}
        if($usuario != "" && $per == 3){
			header('Location: adestructura1.php');	    
		}
		if($usuario != "" && $per == 4){
			header('Location: Sox/Ingresar.php');	    
		}
		if($usuario != "" && $per == 5){
			header('Location: Sox/Ingresar.php');	    
		}	
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestion - Administrador</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/estilo-general-gestion.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/MenuMatic.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="css/carousel.css" />
<!--[if lt IE 7]>
<link rel="stylesheet" href="css/MenuMatic-ie6.css" type="text/css" media="screen" charset="utf-8" />
</script>


<![endif]-->
<!-- Load the MenuMatic Class -->
<script src="js/mootools-1.2.1.js" type="text/javascript"></script>

<script type="text/javascript" src="js/moocarousel_v1.0.js"></script>
<script type="text/javascript" src="js/mootools12_all_p.js"></script>
<!-- Create a MenuMatic Instance -->

<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript">
function verif(){
   if(document.getElementById('login').value == ""){
       document.getElementById('error1').style.visibility = "visible";
	   document.getElementById('camp1').style.backgroundColor = "#FF0000";
	   document.getElementById('login').focus();
       return false;
   }
   if(document.getElementById('password').value == ""){
       document.getElementById('error2').style.visibility = "visible";
	   document.getElementById('cam2').style.backgroundColor = "#FF0000";
	   document.getElementById('password').focus();
       return false;
   }
   document.form2.action = "administrador.php";
   document.form2.submit();
}
function quitar(){

   if(document.getElementById('login').value != ""){
      document.getElementById('error1').style.visibility = "hidden";
      document.getElementById('camp1').style.backgroundColor = "#d52b1e";
   }
}
function quitar1(){
   if(document.getElementById('password').value != ""){
      document.getElementById('error2').style.visibility = "hidden";
      document.getElementById('cam2').style.backgroundColor = "#d52b1e";
   }
}
function cancel(){
   window.location.href = "index.php";
}
</script>
</head>
<body>
<div id="contenedor">
  <div class="float-left" id="cabezote">
    <h1 class="float-left">SISTEMA DE GESTIÓN</h1>
    <img src="img/logo-telmex.jpg" alt="Telmex" width="160" height="26" class="telmex-logo-cabezote"/></div>
  
  <div class="float-left" id="contenido-general"> 
  <form id="form1" name="form1" method="post" action="">
    <div class="float-left" id="titulo-buscaador">
      <h2 class="float-left">:: Administrador</h2>
      <div class="float-right" id="buscador">
       
        <a href="#" class="boton-buscar">
			<?php 
		/*	 if ($_SESSION["active"] != 2)
			{
				echo "No se ha iniciado sesi&oacute;n";
			}
			else
			{
				echo "<span class=\"style1\"><b>Usuario :</b></span> ".$usuario."</a><a href=\"logout.php\" class=\"boton-buscar\">Cerrar Sesi&oacute;n</a>"; 
			}*/
		?>
		<a href="#" class="boton-mas"></a>    </div>
      
      </div></form>
    <div class="float-left" id="contenido-interno">
    <div class="float-right" id="contenido-columna02">
  <div align="center" class="float-right" id="noticias-caja">
		<?php 
		/*	 if ($_SESSION["active"] == 2)
			{
				include ("includes/menuadmin.inc");
			}*/
		?>
        </div>
          
    </div>
    
    <div id="contenido-columna01">
      
      <p>
        <?php 
		//	if ($_SESSION["active"] != 2)
			//	{
				//	include ("includes/login.inc");
				//}
		//	else
			//{
			   ?>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<div align="right">
		<table width="97%" border="0" align="center" style="margin-left:-10px;">
		  <tr>
					<td width=\"50%\">
					 <table width= "100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center" class="calendario-nombre-dias"><h5>Calendario</h5></td>
					</tr>
					<tr>
						<td align=\"center\" class=\"calendario-nombre-dias-contenido\">
					  <?
						//	include ("includes/minicalendario.inc");
							// Construye un calendario para mostrar el mes actual 
							//$cal = new Calendar; 
							//echo $cal->getCurrentMonthView();
						?></td>
					</tr>
				</table>
				</td>
				<td width="50%">
				<HR />
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td align="center" class="calendario-nombre-dias"><h5>Administraci&oacute;n de usuarios</h5></td>
					</tr>
					<tr>
					  <td align="center" class="calendario-nombre-dias-contenido"><a href="usuario-add.php"><img src="img/add-user.png"></a><br>Agregar un usuario nuevo</td>
					</tr>
				</table>
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0" >
					<tr>
					  <td align="center" class="calendario-nombre-dias-contenido"><a href="usuario-update.php"><img src="img/user3.png" ></a><br>Actualizar informaci&oacute;n de usuario</td>
					</tr>
					<tr>
					  <td align="center" class="calendario-nombre-dias-contenido"><a href="usuario-update.php"><img src="img/key.gif" width="55" height="39" /></a><br>
				      Cambiar contrase&ntilde;a de usuario</td>
					</tr>
				</table>
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0" >
					<tr>
					  <td align="center" class="calendario-nombre-dias-contenido"><a href="usuario-delete.php"><img src="img/delete-user.png" ></a><br>Eliminar un usuario</td>
					</tr>
				</table>
				<hr>
		    </td>
		  </tr>
		</table></div>
				<?
		//	}
		///if ($_SESSION["active"] != 2)
	//	{	
		?>
        <label></label>
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
	  <?
	  }
	  ?>
    </div>
    </div>
  </div>
  <div id="pie-pagina">
    <p>&nbsp;</p>
    <p><img src="img/logo_telmex_blanco.png" alt="telmex" width="162" height="35" /></p>
    <p>www.telmex.com * Prohibida su reproducci&oacute;n total o parcial, as&iacute; como su traducci&oacute;n a cualquier idioma sin autorizaci&oacute;n escrita del titular<br />
      Copyright &copy; 2009, Bogot&aacute; - Colombia. 
      Todos los derechos reservados. <br />
      Si tienes dudas, comentarios &oacute; mejoras escribenos: <br />
      <a href="mailto:soporte.procesos@telemex.com" style="color:#FFFFFF">soporte.procesos@telmex.com</a> </p>
  </div>
</div>
</body>
</html>
