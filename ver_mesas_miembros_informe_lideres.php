<?php
session_start();
include_once "includes/GestionBD.new.class.php";
try
{
	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');

		//Get record count
		if($_SESSION["username"]!='alcaldia'){	
		
	
			$sql="SELECT
					miembros.ID,
					miembros.NOMBRES,
					puestos_votacion.NOMBRE_PUESTO,
					mesas.MESA,
					mesas.VOTOREAL
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = miembros.IDPUESTOSVOTACION
					INNER JOIN mesas ON mesas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID
					where usuario.USUARIO='".$_SESSION["username"]."'  and miembros.idlider='".$_GET["idlider"]."' 
					GROUP BY miembros.id ";	
			//Add all records to an array
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$recordCount=count($partidos);	
			
			//Get records from database
			$sql="SELECT
					miembros.ID,
					miembros.NOMBRES,
					miembros.CEDULA,
					puestos_votacion.NOMBRE_PUESTO,
					mesas.MESA,
					mesas.VOTOREAL
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = miembros.IDPUESTOSVOTACION
					INNER JOIN mesas ON mesas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID
					where usuario.USUARIO='".$_SESSION["username"]."'  and miembros.idlider='".$_GET["idlider"]."' 
					GROUP BY miembros.id ";	
			
			
			$sql.=" ORDER BY NOMBRES ";				
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";	
					
			//Add all records to an array
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			$idlider='';
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRES']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
				$row[$i]['VOTOREAL']=$partidos[$i]['VOTOREAL'];
				$row[$i]['VARIACION']=$partidos[$i]['VOTOREAL']-1;
			}	
				
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}else{
			$sql="SELECT
					miembros_2010.codigo as ID,
					CONCAT(trim(miembros_2010.nombre),' ',trim(miembros_2010.apellido)) AS NOMBRES,
					miembros_2010.identificacion AS CEDULA,
					puesto_2010.nombre as NOMBRE_PUESTO,
					mesas_2010.mesas as  MESA,
					mesas_2010.votoreal AS VOTOREAL
					FROM
					miembros_2010
					INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
					INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
					INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo

					INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
					INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
					where usuario_2010.usuario='".$_SESSION["username"]."' 
					and miembros_2010.lider=".$_GET["idlider"];
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		$sql="SELECT
					miembros_2010.codigo as ID,
					CONCAT(trim(miembros_2010.nombre),' ',trim(miembros_2010.apellido)) AS NOMBRES,
					miembros_2010.identificacion AS CEDULA,
					puesto_2010.nombre as NOMBRE_PUESTO,
					mesas_2010.mesas as  MESA,
					mesas_2010.votoreal AS VOTOREAL
					FROM
					miembros_2010
					INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
					INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
					INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo

					INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
					INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
					where usuario_2010.usuario='".$_SESSION["username"]."' 
					and miembros_2010.lider=".$_GET["idlider"];
			
			$sql.=" order by NOMBRES ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$idlider='';
			$row=array();		
			for($i=0; $i<count($partidos);$i++){	
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRES']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
				$row[$i]['VOTOREAL']=$partidos[$i]['VOTOREAL'];
				$row[$i]['VARIACION']=$partidos[$i]['VOTOREAL']-1;
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