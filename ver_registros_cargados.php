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
$sql="SELECT 11 as ID,'100%' AS PORCENTAJE,(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) as MUERTE,'Total Registros' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 7 as ID,CONCAT(ROUND((APTOSVOTAR/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,APTOSVOTAR,'Aptos para Votar' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 9 as ID,CONCAT(ROUND((DATOSVALIDOOS/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,DATOSVALIDOOS,'Inscritos en el Municipio' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 6 as ID,CONCAT(ROUND((DIFERENTEMUNICIPIO/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,DIFERENTEMUNICIPIO,'No Inscrito en el Municipo ' AS DETALLE from UPLOAD_FILE WHERE ESTADO='A' AND id=".$_GET["id"]."
UNION
SELECT 8 as ID,CONCAT(ROUND(((NOAPTOSVOTAR+DATOSINVALIDOS)/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,(NOAPTOSVOTAR+DATOSINVALIDOS),'No Aptos para Votar' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 3 as ID,CONCAT(ROUND((DEBEINSCRIBIRSE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,DEBEINSCRIBIRSE,'No se encuentra en el censo para las próximas elecciones' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 1 as ID,CONCAT(ROUND((MUERTE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,MUERTE,'Cancelada por Muerte' AS DETALLE from UPLOAD_FILE WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 2 as ID,CONCAT(ROUND((BAJA/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,BAJA,'Baja por Perdida o Suspension de los Derechos Politicos' AS DETALLE from UPLOAD_FILE WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 4 as ID,CONCAT(ROUND((PENDIENTE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,PENDIENTE,'Pendiente por Solicitud en proceso' AS DETALLE from UPLOAD_FILE WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 5 as ID,CONCAT(ROUND((count(CEDULA)/(SELECT (APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."))*100,0),'%') AS PORCENTAJE,count(CEDULA),'Registros Duplicados' AS DETALLE from tmp_miembros WHERE PUESTO='Cedula ya existe'AND IDFILE=".$_GET["id"]."
UNION
SELECT 10 as ID,CONCAT(ROUND((count(CEDULA)/(SELECT (APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."))*100,0),'%') AS PORCENTAJE,count(CEDULA),'Para Reprocesar' AS DETALLE from tmp_miembros WHERE PUESTO<>'Cedula ya existe'AND IDFILE=".$_GET["id"]."";		

			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			$recordCount=count($partidos);
			
			//Get records from database
			$sql="SELECT 11 as ID,'100%' AS PORCENTAJE,(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) as MUERTE,'Total Registros Procesados' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 7 as ID,CONCAT(ROUND((APTOSVOTAR/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,APTOSVOTAR,'1.APTOS PARA VOTAR' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 9 as ID,CONCAT(ROUND((DATOSVALIDOOS/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,DATOSVALIDOOS,'  - Inscritos en el Municipio' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 6 as ID,CONCAT(ROUND((DIFERENTEMUNICIPIO/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,DIFERENTEMUNICIPIO,'  - No Inscrito en el Municipo ' AS DETALLE from UPLOAD_FILE WHERE ESTADO='A' AND id=".$_GET["id"]."
UNION
SELECT 8 as ID,CONCAT(ROUND(((NOAPTOSVOTAR+DATOSINVALIDOS)/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,(NOAPTOSVOTAR+DATOSINVALIDOS),'2.NO APTOS PARA VOTAR' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 3 as ID,CONCAT(ROUND((DEBEINSCRIBIRSE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,DEBEINSCRIBIRSE,'  - No se encuentra en el censo para las próximas elecciones' AS DETALLE from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 1 as ID,CONCAT(ROUND((MUERTE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,MUERTE,'  - Cancelada por Muerte' AS DETALLE from UPLOAD_FILE WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 2 as ID,CONCAT(ROUND((BAJA/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,BAJA,'  - Baja por Perdida o Suspension de los Derechos Politicos' AS DETALLE from UPLOAD_FILE WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 4 as ID,CONCAT(ROUND((PENDIENTE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,0),'%') AS PORCENTAJE,PENDIENTE,'  - Pendiente por Solicitud en proceso' AS DETALLE from UPLOAD_FILE WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 5 as ID,CONCAT(ROUND((count(CEDULA)/(SELECT (APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."))*100,0),'%') AS PORCENTAJE,count(CEDULA),'  - Registros Duplicados' AS DETALLE from tmp_miembros WHERE PUESTO='Cedula ya existe'AND IDFILE=".$_GET["id"]."
UNION
SELECT 10 as ID,CONCAT(ROUND((count(CEDULA)/(SELECT (APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) from UPLOAD_FILE  WHERE ESTADO='A' AND id=".$_GET["id"]."))*100,0),'%') AS PORCENTAJE,count(CEDULA),'  - Para Reprocesar' AS DETALLE from tmp_miembros WHERE PUESTO<>'Cedula ya existe'AND IDFILE=".$_GET["id"]."";		

			//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();			
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$i+1;
				$row[$i]['MUERTE']=number_format($partidos[$i]['MUERTE'],0,",",".");
				$row[$i]['DETALLE']=$partidos[$i]['DETALLE'];
				$row[$i]['PORCENTAJE']=$partidos[$i]['PORCENTAJE'];
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