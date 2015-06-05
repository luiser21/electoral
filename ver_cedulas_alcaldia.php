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
		if($_SESSION["username"]!='alcaldia' && $_GET["con"]==3){	
		
				$sql="SELECT
					recoleccion_cedulas.IDPUESTO AS ID,
					recoleccion_cedulas.CEDULAS
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."' and recoleccion_cedulas.IDPUESTO='".$_GET["idpuesto"]."' and recoleccion_cedulas.TIPOELECCION1=3";
				
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			//Get records from database
		$sql="SELECT
					recoleccion_cedulas.IDPUESTO AS ID,
					recoleccion_cedulas.CEDULAS
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."' and recoleccion_cedulas.IDPUESTO='".$_GET["idpuesto"]."' and recoleccion_cedulas.TIPOELECCION1=3 ";
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
		
				
			$row=array();
			//array_chunk
			$z=0;
			$j=1;
			$aux=0;
			$reg = ( ceil(count($partidos)/6) );
			//echo $reg;
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				if ($z <= $reg){
					$row[$z]['CEDULAS_RECOGIDAS'.$j]=$partidos[$i]['CEDULAS'];
				}				
				if ($z == $reg){
					$j++;
					//$aux=$z+1;
					$z=-1;
				}
				$z++;	
			}
			//echo count($row);
			for($i=($reg+1); $i<count($partidos);$i++){
				unset($row[$i]);			
			}			
			//imprimir($row);
			/*for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['CEDULAS_RECOGIDA5']=utf8_encode($partidos[$i]['CEDULAS']);
			}*/
			//Return result to jTable
			//$row = array_chunk($row,2);
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
		//	print json_encode($jTableResult);
		}
		if($_SESSION["username"]!='alcaldia' && $_GET["con"]==4){	
		
				$sql="SELECT
					recoleccion_cedulas.IDPUESTO AS ID,
					recoleccion_cedulas.CEDULAS
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."' and recoleccion_cedulas.IDPUESTO='".$_GET["idpuesto"]."' and recoleccion_cedulas.TIPOELECCION2=4";
				//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			//Get records from database
		$sql="SELECT
					recoleccion_cedulas.IDPUESTO AS ID,
					recoleccion_cedulas.CEDULAS
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."' and recoleccion_cedulas.IDPUESTO='".$_GET["idpuesto"]."' and recoleccion_cedulas.TIPOELECCION2=4 ";
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
		
				
			$row=array();
			//array_chunk
			$z=0;
			$j=1;
			$aux=0;
			$reg = ( ceil(count($partidos)/6) );
			//echo $reg;
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				if ($z <= $reg){
					$row[$z]['CEDULAS_RECOGIDAS'.$j]=$partidos[$i]['CEDULAS'];
				}				
				if ($z == $reg){
					$j++;
					//$aux=$z+1;
					$z=-1;
				}
				$z++;	
			}
			//echo count($row);
			for($i=($reg+1); $i<count($partidos);$i++){
				unset($row[$i]);			
			}			
			//imprimir($row);
			/*for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['CEDULAS_RECOGIDA5']=utf8_encode($partidos[$i]['CEDULAS']);
			}*/
			//Return result to jTable
			//$row = array_chunk($row,2);
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
		//	print json_encode($jTableResult);
		}
		if($_SESSION["username"]!='alcaldia' && $_GET["con"]==5){	
		
				$sql="SELECT
					recoleccion_cedulas.IDPUESTO AS ID,
					recoleccion_cedulas.CEDULAS
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."' and recoleccion_cedulas.IDPUESTO='".$_GET["idpuesto"]."' 
					and recoleccion_cedulas.TIPOELECCION2=0 and recoleccion_cedulas.TIPOELECCION1=0";
				//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			//Get records from database
		$sql="SELECT
					recoleccion_cedulas.IDPUESTO AS ID,
					recoleccion_cedulas.CEDULAS
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."' and recoleccion_cedulas.IDPUESTO='".$_GET["idpuesto"]."' 
					and recoleccion_cedulas.TIPOELECCION2=0 and recoleccion_cedulas.TIPOELECCION1=0 ";
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
		
				
			$row=array();
			//array_chunk
			$z=0;
			$j=1;
			$aux=0;
			$reg = ( ceil(count($partidos)/6) );
			//echo $reg;
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				if ($z <= $reg){
					$row[$z]['CEDULAS_RECOGIDAS'.$j]=$partidos[$i]['CEDULAS'];
				}				
				if ($z == $reg){
					$j++;
					//$aux=$z+1;
					$z=-1;
				}
				$z++;	
			}
			//echo count($row);
			for($i=($reg+1); $i<count($partidos);$i++){
				unset($row[$i]);			
			}			
			//imprimir($row);
			/*for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['CEDULAS_RECOGIDA5']=utf8_encode($partidos[$i]['CEDULAS']);
			}*/
			//Return result to jTable
			//$row = array_chunk($row,2);
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
		//	print json_encode($jTableResult);
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