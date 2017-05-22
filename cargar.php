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
		if($_SESSION["username"]=='alcaldia'){	
		
			 $sql="SELECT
				lideres.ID,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE,
				lideres.CEDULA,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				(SELECT count(*) AS miembros FROM miembros m WHERE lideres.ID  = m.IDLIDER) as MIEMBROS 
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
				(SELECT count(*) AS miembros FROM miembros m WHERE lideres.ID  = m.IDLIDER) as MIEMBROS 
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
			$sql.=" ORDER BY NOMBRE ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['MIEMBROS']=utf8_encode($partidos[$i]['MIEMBROS']+1);
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
		 $sql="SELECT ID,FILE,TRANSFERIR,INVALIDAR,DATOSVALIDOOS,APTOSVOTAR,NOAPTOSVOTAR,CREADO from upload_file WHERE ESTADO='A' AND CANDIDATO='".$_SESSION["username"]."'";		
				//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			//imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
			 $sql="SELECT ID,FILE,TRANSFERIR,INVALIDAR,DATOSVALIDOOS,DATOSINVALIDOS,APTOSVOTAR,NOAPTOSVOTAR,CREADO,DIFERENTEMUNICIPIO,TRASHUMANCIA,
			 INHUMACION,VIGENTE,DOBLECEDULACION,INDEFINIDO,INCORRECTO,CONEXION,
BAJA,PENDIENTE,MUERTE,DEBEINSCRIBIRSE,(SELECT count(CEDULA) from tmp_miembros WHERE PUESTO='Cedula ya existe' AND candidato=".$_SESSION["idcandidato"].") as DUPLICADO,
(SELECT count(CEDULA) from tmp_miembros WHERE PUESTO<>'Cedula ya existe' AND CANDIDATO=".$_SESSION["idcandidato"].") AS REPROCESAR from upload_file
				WHERE ESTADO='A' AND CANDIDATO='".$_SESSION["username"]."' ";				
			$sql.=" ORDER BY ID DESC ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();

			$row2=array();			
//imprimir($partidos);			
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['FILES']=utf8_encode($partidos[$i]['FILE']);
				$row[$i]['REGISTRADO']=$partidos[$i]['CREADO'];
				$row[$i]['VALIDOS']=number_format($partidos[$i]['DATOSVALIDOOS'],0,",",".");
				$row[$i]['INVALIDOS']=number_format($partidos[$i]['DATOSINVALIDOS'],0,",",".");				
				$row[$i]['REGISTROS']=number_format($partidos[$i]['APTOSVOTAR']+$partidos[$i]['NOAPTOSVOTAR']+$partidos[$i]['DATOSINVALIDOS'],0,",",".");
				$row[$i]['APTOS']=number_format($partidos[$i]['APTOSVOTAR'],0,",",".");
				$row[$i]['NOAPTOS']=number_format($partidos[$i]['NOAPTOSVOTAR'],0,",",".");
				
				$row2[$i]['ID']=$partidos[$i]['ID'];
				$row2[$i]['FILES']=utf8_encode($partidos[$i]['FILE']);
				$row2[$i]['REGISTRADO']=$partidos[$i]['CREADO'];
				$row2[$i]['DIFERENTEMUNICIPIO']=$partidos[$i]['DIFERENTEMUNICIPIO'];
				$row2[$i]['VALIDOS']=$partidos[$i]['DATOSVALIDOOS'];
				$row2[$i]['INVALIDOS']=$partidos[$i]['DATOSINVALIDOS'];	
				$row2[$i]['BAJA']=$partidos[$i]['BAJA'];
				$row2[$i]['MUERTE']=$partidos[$i]['MUERTE'];
				$row2[$i]['TRASHUMANCIA']=$partidos[$i]['TRASHUMANCIA'];	
				$row2[$i]['INHUMACION']=$partidos[$i]['INHUMACION'];	
				$row2[$i]['VIGENTE']=$partidos[$i]['VIGENTE'];	
				$row2[$i]['DOBLECEDULACION']=$partidos[$i]['DOBLECEDULACION'];
				$row2[$i]['CONEXION']=$partidos[$i]['CONEXION'];
				$row2[$i]['INDEFINIDO']=$partidos[$i]['INDEFINIDO'];
				$row2[$i]['INCORRECTO']=$partidos[$i]['INCORRECTO'];
				$row2[$i]['PENDIENTE']=$partidos[$i]['PENDIENTE'];	
				$row2[$i]['DEBEINSCRIBIRSE']=$partidos[$i]['DEBEINSCRIBIRSE'];					
				$row2[$i]['REGISTROS']=$partidos[$i]['APTOSVOTAR']+$partidos[$i]['NOAPTOSVOTAR']+$partidos[$i]['DATOSINVALIDOS'];
				$row2[$i]['APTOS']=$partidos[$i]['APTOSVOTAR'];
				$row2[$i]['NOAPTOS']=$partidos[$i]['NOAPTOSVOTAR'];
				$row2[$i]['DUPLICADO']=$partidos[$i]['DUPLICADO'];
				$row2[$i]['REPROCESAR']=$partidos[$i]['REPROCESAR'];
			}	

			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $recordCount;
			$jTableResult['Records'] = $row;
			
			
			$jTableResult2 = array();
			$jTableResult2['Result'] = "OK";
			$jTableResult2['TotalRecordCount'] = $recordCount;
			$jTableResult2['Records'] = $row2;
			//print json_encode($jTableResult);
		}
		$_SESSION['graficos_estructura'] = $jTableResult2;
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