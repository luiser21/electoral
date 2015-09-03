<?php
session_start();
include_once "includes/GestionBD.new.class.php";
try
{
	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');
	//Getting records (listAction)
	if(!empty($_GET["id"]))
	{		
		 $sql="SELECT 1 as ID,MUERTE,'Cancelada por Muerte' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."		
				UNION
				SELECT 2 as ID,BAJA,'Baja por Perdida o Suspension de los Derechos Politicos' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."		
				UNION
				SELECT 3 as ID,DEBEINSCRIBIRSE,'No se encuentra en el censo para las próximas elecciones' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."		
				UNION
				SELECT 4 as ID,PENDIENTE,'Pendiente por Solicitud en proceso' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."		
				UNION
				SELECT 5 as ID,DATOSINVALIDOS,'Registros Duplicados' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."
				UNION
				SELECT 6 as ID,DIFERENTEMUNICIPIO,'No Inscrito en el Municipo ' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."";		

			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			$recordCount=count($partidos);
			
			//Get records from database
			 $sql="SELECT 1 as ID,MUERTE,'Cancelada por Muerte' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."		
				UNION
				SELECT 2 as ID,BAJA,'Baja por Perdida o Suspension de los Derechos Politicos' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."		
				UNION
				SELECT 3 as ID,DEBEINSCRIBIRSE,'No se encuentra en el censo para las próximas elecciones' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."		
				UNION
				SELECT 4 as ID,PENDIENTE,'Pendiente por Solicitud en proceso' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."		
				UNION
				SELECT 5 as ID,DATOSINVALIDOS,'Registros Duplicados' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."
				UNION
				SELECT 6 as ID,DIFERENTEMUNICIPIO,'No Inscrito en el Municipo ' AS DETALLE from UPLOAD_FILE 
				WHERE ESTADO='A' AND id=".$_GET["id"]."";
			//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();			
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$i+1;
				$row[$i]['MUERTE']=utf8_encode($partidos[$i]['MUERTE']);
				$row[$i]['DETALLE']=$partidos[$i]['DETALLE'];
			}	
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);		
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