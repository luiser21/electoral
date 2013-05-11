<?php 
session_start();
include_once "includes/GestionBD.new.class.php";
require("secure/hash.class.php");

$DBGestion = new GestionBD('AGENDAMIENTO');
	// Si la sesion no está activa y/o autenticada ingresa a este paso
	if (@$_SESSION["active"] != 2)
	{
		
			@$usuario = (!empty($_POST["log"]))?  $_POST["log"] : "";
			@$password = (!empty($_POST["pwd"]))?  $_POST["pwd"] : "";

            if(@$usuario != ""){
			
				//Encriptar el password para hacer match con el registro en la DB
				$password=Hash::calcSHA($password);
			
			
				$sql="SELECT * FROM USUARIO WHERE USUARIO = '$usuario' and CONTRASENA ='$password' and ACTIVO = 'Y'";
				$DBGestion->ConsultaArray($sql);
				$usuarios=$DBGestion->datos;
				
				foreach (@$usuarios as $datos){
				     @$usu = $datos['USUARIO'];
					 @$per = $datos['PERMISO'];
					 @$nombre = $datos['NOMBRE'];						 
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
					@$_SESSION["active"] = 1;


				}			
	}
		
	// Si la sesion está activa y autenticada ingresa a este paso
	else
	{
		
		// toma las variables de sesion y de edicion de contenidos
		@$usuario = $_SESSION["username"];
		@$per = $_SESSION["permiso"];	
		if(!isset($usuario)){
			if(@$usuario != "" && $per == 1){
				header('Location: adetom.php');	    
			}
			if(@$usuario != "" && $per == 3){
				header('Location: adestructura1.php');	    
			}
			if(@$usuario != "" && $per == 4){
				header('Location: Sox/Ingresar.php');	    
			}
			if(@$usuario != "" && $per == 5){
				header('Location: Sox/Ingresar.php');	    
			}
		}	
		
	}

?>
