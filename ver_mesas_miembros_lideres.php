<?php
session_start();
include_once "includes/GestionBD.new.class.php";
try
{
	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');

		//Get record count
		if($_SESSION["username"]!='edgarcarreno'){	
		
			$sql="SELECT
					lideres.ID AS CODIGO,
					CONCAT(trim(lideres.nombres),' ',trim(lideres.apellidos)) AS LIDER,
					lideres.TELEFONO AS TELEFONO,
					CONCAT(trim(miembros.nombres)) AS SIMPATIZANTES
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.usuario='".$_SESSION["username"]."'
					##and puesto_2010.codigo='".$_SESSION["username"]."' 
					and mesas.ID='".$_GET["idmesa"]."' ";	
			//Add all records to an array
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$recordCount=count($partidos);	
			
			//Get records from database
			$sql="SELECT
					lideres.ID AS CODIGO,
					CONCAT(trim(lideres.nombres),' ',trim(lideres.apellidos)) AS LIDER,
					lideres.TELEFONO AS TELEFONO,
					CONCAT(trim(miembros.nombres)) AS SIMPATIZANTES

					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.usuario='".$_SESSION["username"]."'
					##and puesto_2010.codigo='".$_SESSION["username"]."' 
					and mesas.ID='".$_GET["idmesa"]."' ";	
			
			
			$sql.=" ORDER BY LIDER ";			
			
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";	
					
			//Add all records to an array
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			$idlider='';
			$row=array();		
			for($i=0; $i<count($partidos);$i++){	
				if($idlider==$partidos[$i]['CODIGO']){
					$row[$i]['CODIGO']='';
					$row[$i]['LIDER']='';
					$row[$i]['TELEFONO']='';
					$row[$i]['SIMPATIZANTES']=$partidos[$i]['SIMPATIZANTES'];
				}else{
					$row[$i]['CODIGO']=$partidos[$i]['CODIGO'];
					$row[$i]['LIDER']=$partidos[$i]['LIDER'];
					$row[$i]['TELEFONO']=$partidos[$i]['TELEFONO'];
					$row[$i]['SIMPATIZANTES']=$partidos[$i]['SIMPATIZANTES'];
				}
				$idlider=$partidos[$i]['CODIGO'];
			}
				
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}else{
			$sql="SELECT
					lider_2010.codigo AS CODIGO,
					CONCAT(trim(lider_2010.nombre),' ',trim(lider_2010.apellido)) AS LIDER,
					lider_2010.celular AS TELEFONO,
					CONCAT(trim(miembros_2010.nombre),' ',trim(miembros_2010.apellido)) AS MIEMBROS

					FROM
					miembros_2010
					INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
					INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
					INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo

					INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
					INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
					where usuario_2010.usuario='".$_SESSION["username"]."' 
					##and puesto_2010.codigo='".$_SESSION["username"]."' 
					and mesas_2010.codigo='".$_GET["idmesa"]."' ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		$sql="SELECT
					lider_2010.codigo AS CODIGO,
					CONCAT(trim(lider_2010.nombre),' ',trim(lider_2010.apellido)) AS LIDER,
					lider_2010.celular AS TELEFONO,
					CONCAT(trim(miembros_2010.nombre),' ',trim(miembros_2010.apellido)) AS SIMPATIZANTES

					FROM
					miembros_2010
					INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
					INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
					INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo

					INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
					INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
					where usuario_2010.usuario='".$_SESSION["username"]."' 
					##and puesto_2010.codigo='".$_SESSION["username"]."' 
					and mesas_2010.codigo='".$_GET["idmesa"]."' ";
			
			$sql.=" order by lider ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$idlider='';
			$row=array();		
			for($i=0; $i<count($partidos);$i++){	
				if($idlider==$partidos[$i]['CODIGO']){
					$row[$i]['CODIGO']='';
					$row[$i]['LIDER']='';
					$row[$i]['TELEFONO']='';
					$row[$i]['SIMPATIZANTES']=$partidos[$i]['SIMPATIZANTES'];
				}else{
					$row[$i]['CODIGO']=$partidos[$i]['CODIGO'];
					$row[$i]['LIDER']=$partidos[$i]['LIDER'];
					$row[$i]['TELEFONO']=$partidos[$i]['TELEFONO'];
					$row[$i]['SIMPATIZANTES']=$partidos[$i]['SIMPATIZANTES'];
				}
				$idlider=$partidos[$i]['CODIGO'];
			}
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}
		print json_encode($jTableResult);		

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>