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
				miembros.ID,
				CONCAT(TRIM(miembros.NOMBRES),' ',TRIM(miembros.APELLIDOS)) AS NOMBRE,
				miembros.CEDULA,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS LIDER,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				municipios.NOMBRE AS MUNICIPIO,
				departamentos.NOMBRE AS DEPARTAMENTO
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
				INNER JOIN municipios ON municipios.ID = puestos_votacion.IDMUNICIPIO
				INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
				where usuario.usuario='".$_SESSION["username"]."' ";
				if($_SESSION["tipocandidato"]=="ALCALDIA"){
					$sql.=" and municipios.NOMBRE<>'".$_SESSION["municipio"]."' ";
				}				
					
			if(isset($_POST["name"])!=""){
				$sql.=" and (upper(miembros.nombres) like upper('%".$_POST["name"]."%') OR (miembros.CEDULA like upper('%".$_POST["name"]."%'))) ";
			}
	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			//Get records from database
		$sql="SELECT
				miembros.ID,
				miembros.NOMBRES AS NOMBRE,
				miembros.CEDULA,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS LIDER,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				municipios.NOMBRE AS MUNICIPIO,
				departamentos.NOMBRE AS DEPARTAMENTO
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
				INNER JOIN municipios ON municipios.ID = puestos_votacion.IDMUNICIPIO
				INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
				where usuario.usuario='".$_SESSION["username"]."' ";
				if($_SESSION["tipocandidato"]=="ALCALDIA"){
					$sql.=" and municipios.NOMBRE<>'".$_SESSION["municipio"]."' ";
				}
			
			if(isset($_POST["name"])!=""){
				$sql.=" and (upper(miembros.nombres) like upper('%".$_POST["name"]."%') OR (miembros.CEDULA like upper('%".$_POST["name"]."%'))) ";
			}
			$sql.=" ORDER BY NOMBRE ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
				
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['LIDER']=utf8_encode($partidos[$i]['LIDER']);
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];				
				$row[$i]['MUNICIPIO']=$partidos[$i]['MUNICIPIO'];
				$row[$i]['DEPARTAMENTO']=$partidos[$i]['DEPARTAMENTO'];
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
				puesto.nombre AS NOMBRE_PUESTO,
				puesto.municipio,
				puesto.departamento
				FROM
				miembros_2010 miembros
				INNER JOIN lider_2010 lider ON lider.codigo = miembros.lider
				INNER JOIN mesa_puesto_miembro_2010 mesa_puesto_miembro ON mesa_puesto_miembro.miembro = miembros.codigo
				INNER JOIN mesas_2010 mesas ON mesas.codigo = mesa_puesto_miembro.mesas
				INNER JOIN puesto_2010 puesto ON puesto.codigo = mesas.puesto
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto.municipio<>(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')";
							
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
				puesto.nombre AS NOMBRE_PUESTO,
				puesto.municipio as MUNICIPIO,
				puesto.departamento AS DEPARTAMENTO
				FROM
				miembros_2010 miembros
				INNER JOIN lider_2010 lider ON lider.codigo = miembros.lider
				INNER JOIN mesa_puesto_miembro_2010 mesa_puesto_miembro ON mesa_puesto_miembro.miembro = miembros.codigo
				INNER JOIN mesas_2010 mesas ON mesas.codigo = mesa_puesto_miembro.mesas
				INNER JOIN puesto_2010 puesto ON puesto.codigo = mesas.puesto
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto.municipio<>(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')";
			
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
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
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
		$sql="delete from miembros where id=".$_POST['ID'];
		$DBGestion->Consulta($sql);				
		$partidos=$DBGestion->datos;
		$sql="delete from mesa_puesto_miembro where MIEMBRO=".$_POST['ID'];
		$DBGestion->Consulta($sql);				
		$partidos=$DBGestion->datos;
		$sql="UPDATE UPLOAD_FILE SET APTOSVOTAR=(APTOSVOTAR-1), DATOSVALIDOOS=(DATOSVALIDOOS-1)			
					WHERE CANDIDATO='".$_SESSION["username"]."' and FILE='Carga_Manual'";
		$DBGestion->Consulta($sql);
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