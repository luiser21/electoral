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
			$consulta=0;
            if(@$usuario != ""){
				$password=Hash::calcSHA($password);	
				$sql="SELECT
						usuario.USUARIO,
						usuario.CONSULTA,				
						usuario.ASOSIADO,
						usuario.CONTRASENA
						FROM usuario WHERE USUARIO = '".$usuario."' and CONTRASENA ='".$password."' and ACTIVO = 'Y'";				
				$DBGestion->ConsultaArray($sql);
				$usuario_consulta=$DBGestion->datos;				
				foreach (@$usuario_consulta as $datos2){
					if($datos2['ASOSIADO']!=''){						
						$usuario=$datos2['ASOSIADO'];
						$sql="SELECT usuario.CONTRASENA FROM usuario WHERE USUARIO = '".$datos2['ASOSIADO']."' and ACTIVO = 'Y'";
						$DBGestion->ConsultaArray($sql);
						$usuario_consulta2=$DBGestion->datos;	
						$password=$usuario_consulta2[0]['CONTRASENA'];
						$consulta=$datos2['CONSULTA'];
					}
				}
				//Encriptar el password para hacer match con el registro en la DB	
				$sql="SELECT
						candidato.ID AS IDCANDIDATO,
						usuario.USUARIO,
						usuario.PERMISO,					
						CONCAT(candidato.NOMBRES,' ',candidato.APELLIDOS) AS NOMBRE,
						partidos_politicos.NOMBRECORTO AS PARTIDO,
						partidos_politicos.LOGO2 AS LOGO2,
						tipo_eleccion.NOMBRE AS TIPOCANDIDATO,
						candidato.FOTO,
						candidato.NTARJETON,
						candidato.ESLOGAN,
						candidato.VOTOSPREVISTOS,
						candidato.MUNICIPIO AS IDMUNICIPIO,
						municipios.NOMBRE AS MUNICIPIO,
						departamentos.NOMBRE AS DEPARTAMENTO
						FROM
						usuario
						LEFT JOIN candidato ON candidato.IDUSUARIO = usuario.IDUSUARIO
						LEFT JOIN partidos_politicos ON partidos_politicos.IDPARTIDO = candidato.PARTIDO
						LEFT JOIN tipo_eleccion ON tipo_eleccion.IDTIPO = candidato.TIPOCANDIDATO
						LEFT JOIN municipios ON municipios.ID = candidato.MUNICIPIO
						LEFT JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					  WHERE USUARIO = '".$usuario."' and CONTRASENA ='".$password."' and ACTIVO = 'Y'";
				$DBGestion->ConsultaArray($sql);
				$usuarios=$DBGestion->datos;	
			
				foreach (@$usuarios as $datos){
					@$id = $datos['IDCANDIDATO'];
					@$usu = $datos['USUARIO'];
					@$per = $datos['PERMISO'];
					@$nombre = $datos['NOMBRE'];	
					@$partido = $datos['PARTIDO'];	
					@$municipio = $datos['MUNICIPIO'];	
					@$idmunicipio = $datos['IDMUNICIPIO'];	
					@$departamento = $datos['DEPARTAMENTO'];	
					@$tipocandidato = $datos['TIPOCANDIDATO'];
					@$foto = $datos['FOTO'];	
					@$ntarjeton = $datos['NTARJETON'];	
					@$logo2 = $datos['LOGO2'];
					@$eslogan = $datos['ESLOGAN'];	
					@$votos = $datos['VOTOSPREVISTOS'];	
						
				}				
				if(@$usu != "" ){
					$_SESSION["idcandidato"] = $id;
				    $_SESSION["username"] = $usu;
					$_SESSION["active"] = 2;
					$_SESSION["permiso"] = $per;
					$_SESSION["nombre"] = $nombre;		
					$_SESSION["partido"] = $partido;		
					$_SESSION["municipio"] = $municipio;	
					$_SESSION["idmunicipio"] = $idmunicipio;						
					$_SESSION["departamento"] = $departamento;		
					$_SESSION["foto"] = $foto;		
					$_SESSION["ntarjeton"] = $ntarjeton;
					$_SESSION["tipocandidato"] = $tipocandidato;	
					$_SESSION["logo2"] = $logo2;	
					$_SESSION["eslogan"] = $eslogan;
					$_SESSION["votosprevistos"] = $votos;	
					$_SESSION["consulta"] = $consulta;						
					header("location:adetom.php");    
				}else{
					?>
						<script type="text/javascript">
						alert('Usuario y/o Password Incorrecto\n\t Intente nuevamente');
						window.location.href = 'index.php';
						</script>						
					<?php
				}		
			}else{					
					// Registra sesion activa no autenticada y recarga "administrador.php" con las credenciales
					session_register("id");
					@$_SESSION["active"] = 1;
				}			
	}		
	// Si la sesion está activa y autenticada ingresa a este paso
	else{		
		// toma las variables de sesion y de edicion de contenidos
		@$usuario = $_SESSION["username"];
		@$per = $_SESSION["permiso"];	
		 @$nombre = $_SESSION['nombre'];	
		  @$id = $_SESSION["idcandidato"];	
		   @$municipio = $_SESSION["municipio"];	
		    @$idmunicipio = $_SESSION["idmunicipio"];	
		    @$departamento = $_SESSION["departamento"];	
			 @$partido = $_SESSION["partido"];	
			  @$foto = $_SESSION["foto"];	
			   @$ntarjeton = $_SESSION["ntarjeton"];	
			    @$tipocandidato = $_SESSION["tipocandidato"];	
				 @$logo2 = $_SESSION["logo2"];
				  @$eslogan = $_SESSION["eslogan"];
				   @$votos = $_SESSION["votosprevistos"];
					@$consulta=$_SESSION["consulta"];	
		if(!empty($usuario)){
			if(@$usuario != ""){
				header('Location: adetom.php');	    
			}
		}			
	}
?>
