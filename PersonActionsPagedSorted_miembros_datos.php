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
				where usuario.usuario='".$_SESSION["username"]."'";
				
					
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
				where usuario.usuario='".$_SESSION["username"]."'";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(miembros.nombres) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" ORDER BY NOMBRE ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
				
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['LIDER']=utf8_encode($partidos[$i]['LIDER']);
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
				'N/A' AS MESA,
				'NO REGISTRA' AS NOMBRE_PUESTO,
				'NO REGISTRA' as MUNICIPIO,
				'NO REGISTRA' AS DEPARTAMENTO
				FROM
				miembros_2010 miembros
				INNER JOIN lider_2010 lider ON lider.codigo = miembros.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope				
				where usuario_2010.usuario='".$_SESSION["username"]."' 	and (miembros.identificacion ='' OR miembros.puesto='') ";
				
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
				'N/A' AS MESA,
				'NO REGISTRA' AS NOMBRE_PUESTO,
				'NO REGISTRA' as MUNICIPIO,
				'NO REGISTRA' AS DEPARTAMENTO
				FROM
				miembros_2010 miembros
				INNER JOIN lider_2010 lider ON lider.codigo = miembros.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				where usuario_2010.usuario='".$_SESSION["username"]."' 	and (miembros.identificacion ='' OR miembros.puesto='') ";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(miembros.nombre) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" ORDER BY NOMBRE ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
				
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['CEDULA']=($partidos[$i]['CEDULA']!='')? $partidos[$i]['CEDULA']:'NO REGISTRA';
				$row[$i]['LIDER']=utf8_encode($partidos[$i]['LIDER']);
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
				$row[$i]['MUNICIPIO']=$partidos[$i]['MUNICIPIO'];
				$row[$i]['DEPARTAMENTO']=$partidos[$i]['DEPARTAMENTO'];
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