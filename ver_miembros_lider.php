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
			//Get record count
		if($_SESSION["username"]!='edgarcarreno'){	
		
				$sql="SELECT
				miembros.ID,
				CONCAT(TRIM(miembros.NOMBRES),' ',TRIM(miembros.APELLIDOS)) AS NOMBRE,
				miembros.CEDULA,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS LIDER,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
				where usuario.usuario='".$_SESSION["username"]."' and lideres.ID='".$_GET["idlider"]."'";
				
					
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(miembros.nombres) like upper('%".$_POST["name"]."%') ";
			}
	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			//Get records from database
		$sql="SELECT
				miembros.ID,
				CONCAT(TRIM(miembros.NOMBRES),' ',TRIM(miembros.APELLIDOS)) AS NOMBRE,
				miembros.CEDULA,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS LIDER,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
				where usuario.usuario='".$_SESSION["username"]."' and lideres.ID='".$_GET["idlider"]."'";
				
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(miembros.nombres) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" ORDER BY NOMBRE ";
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
				
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=$partidos[$i]['NOMBRE'];
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['LIDER']=$partidos[$i]['LIDER'];
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
			$sql="SELECT
				miembros.codigo AS ID,
				CONCAT(TRIM(miembros.nombre),' ',TRIM(miembros.apellido)) AS NOMBRE,
				miembros.identificacion AS CEDULA,
				CONCAT(lider.nombre,' ',lider.apellido) AS LIDER,
				mesas.mesas AS MESA,
				puesto.nombre AS NOMBRE_PUESTO
				FROM
				miembros_2010 miembros
				INNER JOIN lider_2010 lider ON lider.codigo = miembros.lider
				INNER JOIN mesa_puesto_miembro_2010 mesa_puesto_miembro ON mesa_puesto_miembro.miembro = miembros.codigo
				INNER JOIN mesas_2010 mesas ON mesas.codigo = mesa_puesto_miembro.mesas
				INNER JOIN puesto_2010 puesto ON puesto.codigo = mesas.puesto
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				where usuario_2010.usuario='".$_SESSION["username"]."' and lider.codigo='".$_GET["idlider"]."'";
				
					
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(miembros.nombre) like upper('%".$_POST["name"]."%') ";
			}
	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			//Get records from database
		$sql="SELECT
				miembros.codigo AS ID,
				CONCAT(TRIM(miembros.nombre),' ',TRIM(miembros.apellido)) AS NOMBRE,
				miembros.identificacion AS CEDULA,
				CONCAT(lider.nombre,' ',lider.apellido) AS LIDER,
				mesas.mesas AS MESA,
				puesto.nombre AS NOMBRE_PUESTO
				FROM
				miembros_2010 miembros
				INNER JOIN lider_2010 lider ON lider.codigo = miembros.lider
				INNER JOIN mesa_puesto_miembro_2010 mesa_puesto_miembro ON mesa_puesto_miembro.miembro = miembros.codigo
				INNER JOIN mesas_2010 mesas ON mesas.codigo = mesa_puesto_miembro.mesas
				INNER JOIN puesto_2010 puesto ON puesto.codigo = mesas.puesto
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				where usuario_2010.usuario='".$_SESSION["username"]."' and lider.codigo='".$_GET["idlider"]."'";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(miembros.nombre) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" ORDER BY NOMBRE ";
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
				
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=$partidos[$i]['NOMBRE'];
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['LIDER']=$partidos[$i]['LIDER'];
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
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