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
		if($_SESSION["username"]!='alcaldia'){	
		
			 $sql="SELECT
				lideres.ID,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE,
				lideres.CEDULA,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				(SELECT count(*) AS miembros FROM miembros m WHERE lideres.ID  = m.IDLIDER) as MIEMBROS,
				(SELECT sum(VOTOREAL) AS VOTOREAL FROM miembros m 
				LEFT JOIN mesa_puesto_miembro ON mesa_puesto_miembro.LIDER = m.IDLIDER
				LEFT JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA 
				WHERE lideres.ID  = m.IDLIDER) AS VOTOREAL				
				FROM
				lideres
				LEFT JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				LEFT JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				LEFT JOIN mesa_puesto_miembro ON mesa_puesto_miembro.LIDER = lideres.ID
				LEFT JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA AND mesas.IDPUESTO = lideres.IDPUESTOSVOTACION
				LEFT JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
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
				(SELECT count(*) AS miembros FROM miembros m WHERE lideres.ID  = m.IDLIDER) as MIEMBROS,
				(SELECT sum(VOTOREAL) AS VOTOREAL FROM miembros m 
				LEFT JOIN mesa_puesto_miembro ON mesa_puesto_miembro.LIDER = m.IDLIDER
				LEFT JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA 
				WHERE lideres.ID  = m.IDLIDER) AS VOTOREAL
				FROM
				lideres
				LEFT JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				LEFT JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				LEFT JOIN mesa_puesto_miembro ON mesa_puesto_miembro.LIDER = lideres.ID
				LEFT JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA AND mesas.IDPUESTO = lideres.IDPUESTOSVOTACION
				LEFT JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
			  where usuario.usuario='".$_SESSION["username"]."' ";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(lideres.nombres) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" ORDER BY MIEMBROS desc ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['MIEMBROS']=utf8_encode($partidos[$i]['MIEMBROS']);
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
				$row[$i]['VOTOSREALES']=$partidos[$i]['VOTOREAL'];
				$row[$i]['VARIACION']=$partidos[$i]['VOTOREAL']-$partidos[$i]['MIEMBROS'];
			}	
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}else{
		 $sql="select lider.codigo AS ID,
			 CONCAT(lider.nombre,' ',lider.apellido) AS NOMBRE,
			  lider.identificacion AS CEDULA,
			  puesto_2010.nombre as NOMBRE_PUESTO,
			  mesas_2010.mesas AS MESA,
			  (SELECT count(*)AS miembros FROM miembros_2010 m WHERE lider.codigo  = m.lider) as MIEMBROS 
			  FROM lider_2010 lider
			  LEFT JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.lider = lider.codigo
			  LEFT JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas 
			  LEFT JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto 
			  INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
		 	  INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
			  where usuario_2010.usuario='".$_SESSION["username"]."' ";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(lider.nombre) like upper('%".$_POST["name"]."%') ";
			}
	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		 $sql="select lider.codigo AS ID,
			 CONCAT(lider.nombre,' ',lider.apellido) AS NOMBRE,
			  lider.identificacion AS CEDULA,
			  puesto_2010.nombre as NOMBRE_PUESTO,
			  mesas_2010.mesas AS MESA,
			  (SELECT count(*)AS miembros FROM miembros_2010 m WHERE lider.codigo  = m.lider) as MIEMBROS 
			  FROM lider_2010 lider
			  LEFT JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.lider = lider.codigo
			  LEFT JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas 
			  LEFT JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto 
			  INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
		 	  INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
			  where usuario_2010.usuario='".$_SESSION["username"]."' ";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(lider.nombre) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" ORDER BY MIEMBROS desc ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['MIEMBROS']=utf8_encode($partidos[$i]['MIEMBROS']);
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
		$_SESSION['graficos_lideres'] = $jTableResult;
		print json_encode($jTableResult);		
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$result = mysql_query("INSERT INTO people(Name, Age, RecordDate) VALUES('" . $_POST["Name"] . "', " . $_POST["Age"] . ",now());");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM people WHERE PersonId = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE people SET Name = '" . $_POST["Name"] . "', Age = " . $_POST["Age"] . " WHERE PersonId = " . $_POST["PersonId"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM people WHERE PersonId = " . $_POST["PersonId"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	//mysql_close($con);

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