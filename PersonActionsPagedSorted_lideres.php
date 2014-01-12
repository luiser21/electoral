<?php
session_start();
include_once "includes/GestionBD.new.class.php";
try
{
	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');
/*$_GET["action"] = "list";
$_GET["jtPageSize"]=	2;
$_GET["jtStartIndex"]=0;*/
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		if($_SESSION["username"]!='edgarcarreno'){	
		
			 $sql="SELECT
				lideres.ID,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE,
				lideres.CEDULA,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				(SELECT count(*) AS miembros FROM miembros m WHERE lideres.ID  = m.IDLIDER) as MIEMBROS 
				FROM
				lideres
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.LIDER = lideres.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA AND mesas.IDPUESTO = lideres.IDPUESTOSVOTACION
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
			  where usuario.usuario='".$_SESSION["username"]."' ";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(lideres.nombres) like upper('%".$_POST["name"]."%') ";
			}
	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		 $sql="SELECT
				lideres.ID,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE,
				lideres.CEDULA,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				(SELECT count(*) AS miembros FROM miembros m WHERE lideres.ID  = m.IDLIDER) as MIEMBROS 
				FROM
				lideres
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.LIDER = lideres.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA AND mesas.IDPUESTO = lideres.IDPUESTOSVOTACION
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
			  where usuario.usuario='".$_SESSION["username"]."' ";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(lideres.nombres) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" ORDER BY NOMBRE ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=$partidos[$i]['NOMBRE'];
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['MIEMBROS']=$partidos[$i]['MIEMBROS'];
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
			}	
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}else{
		 $sql="select  CODIGO AS ID,NOMBRE, CEDULA,COUNT(PUESTO) AS PUESTO, SUM(MESAS) AS MESAS, sum(miembros) as MIEMBROS FROM (SELECT
				puesto_2010.nombre as puesto,
				count(DISTINCT  mesas_2010.mesas) as mesas,
				lider_2010.codigo,
				CONCAT(lider_2010.nombre,' ',lider_2010.apellido) AS NOMBRE,
				lider_2010.identificacion AS CEDULA,
				count(miembros_2010.nombre) as miembros
				from puesto_2010
				INNER JOIN mesas_2010 ON mesas_2010.puesto = puesto_2010.codigo
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.mesas = mesas_2010.codigo
				INNER  JOIN miembros_2010 ON miembros_2010.codigo = mesa_puesto_miembro_2010.miembro
				RIGHT  JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER  JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER  JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				where usuario_2010.usuario='".$_SESSION["username"]."'
				GROUP BY lider_2010.codigo, puesto_2010.codigo
				ORDER BY lider_2010.nombre, puesto_2010.nombre) mesas_lider
				WHERE 1=1";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(NOMBRE) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" GROUP BY codigo ORDER BY NOMBRE ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		 $sql="select  CODIGO AS ID,NOMBRE, CEDULA,COUNT(PUESTO) AS PUESTO, SUM(MESAS) AS MESAS, sum(miembros) as MIEMBROS FROM (SELECT
				puesto_2010.nombre as puesto,
				count(DISTINCT  mesas_2010.mesas) as mesas,
				lider_2010.codigo,
				CONCAT(lider_2010.nombre,' ',lider_2010.apellido) AS NOMBRE,
				lider_2010.identificacion AS CEDULA,
				count(miembros_2010.nombre) as miembros
				from puesto_2010
				INNER JOIN mesas_2010 ON mesas_2010.puesto = puesto_2010.codigo
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.mesas = mesas_2010.codigo
				INNER  JOIN miembros_2010 ON miembros_2010.codigo = mesa_puesto_miembro_2010.miembro
				RIGHT  JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER  JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER  JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				where usuario_2010.usuario='".$_SESSION["username"]."'
				GROUP BY lider_2010.codigo, puesto_2010.codigo
				ORDER BY lider_2010.nombre, puesto_2010.nombre) mesas_lider
				WHERE 1=1";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(NOMBRE) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" GROUP BY codigo ORDER BY NOMBRE ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=$partidos[$i]['NOMBRE'];
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['MIEMBROS']=$partidos[$i]['MIEMBROS'];
				$row[$i]['PUESTO']=$partidos[$i]['PUESTO'];
				$row[$i]['MESAS']=$partidos[$i]['MESAS'];
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