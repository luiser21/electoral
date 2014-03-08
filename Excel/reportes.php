<?php
//require_once('topadmin.php');
require_once 'Excel/reader.php';
session_start();
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();
include_once "../includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	
// Set output Encoding.
@$data->setOutputEncoding('CP1251');
@$data->read('Distribucion Zonas Departamentales.xls');
error_reporting(E_ALL ^ E_NOTICE);  
$y=0;
$registros=count($data->sheets[0]['cells']);
for ($i = 2; $i <= $registros; $i++) {
	$zona[$y]=trim($data->sheets[0]['cells'][$i][1]);
	$encargado[$y]=$data->sheets[0]['cells'][$i][2];
	$departamento[$y]=$data->sheets[0]['cells'][$i][3];
	
	$y++;
}
//var_dump($departamento);
//exit;
for($i=0; $i<$registros-1; $i++){	

		
		$sql="SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE
					FROM
					departamentos
					where UPPER(departamentos.NOMBRE) = UPPER('".trim($departamento[$i])."')";
			$DBGestion->ConsultaArray($sql);
			$departamentos=$DBGestion->datos;	
			
			$iddepartamento=$departamentos[0]['IDDEPARTAMENTO'];
			echo $departamentos[0]['NOMBRE'];
			echo '<br/>';
			echo '<br/>';
			$sql2="SELECT
						municipios.ID,
						municipios.NOMBRE
						FROM
						municipios
						where IDDEPARTAMENTO=".$iddepartamento;
					try{	
				$DBGestion->ConsultaArray($sql2);
				$municipios=$DBGestion->datos;	
				for($k=0; $k<count($municipios); $k++){
					$idmunicipio=$municipios[$k]['ID'];
					$zona[$i];
					$encargado[$i];
					
						$sql="INSERT INTO BOLETINES (REPORTES, HORA, IDDEPARTAMENTO, MOVILIZADOS, ZONA, ESTADO, IDMUNICIPIO, ENCARGADO) 
						VALUES ('1er REPORTE','10am','".$iddepartamento."',0,'".strtoupper(trim($zona[$i]))."',0,'".$idmunicipio."','".strtoupper(trim($encargado[$i]))."')";							
						$DBGestion->Consulta($sql);	
						$sql="INSERT INTO BOLETINES (REPORTES, HORA, IDDEPARTAMENTO, MOVILIZADOS, ZONA, ESTADO, IDMUNICIPIO, ENCARGADO) 
						VALUES ('2do REPORTE','11am','".$iddepartamento."',0,'".strtoupper(trim($zona[$i]))."',0,'".$idmunicipio."','".strtoupper(trim($encargado[$i]))."')";							
						$DBGestion->Consulta($sql);	
						$sql="INSERT INTO BOLETINES (REPORTES, HORA, IDDEPARTAMENTO, MOVILIZADOS, ZONA, ESTADO, IDMUNICIPIO, ENCARGADO) 
						VALUES ('3er REPORTE','12pm','".$iddepartamento."',0,'".strtoupper(trim($zona[$i]))."',0,'".$idmunicipio."','".strtoupper(trim($encargado[$i]))."')";							
						$DBGestion->Consulta($sql);	
						$sql="INSERT INTO BOLETINES (REPORTES, HORA, IDDEPARTAMENTO, MOVILIZADOS, ZONA, ESTADO, IDMUNICIPIO, ENCARGADO) 
						VALUES ('4to REPORTE','1pm','".$iddepartamento."',0,'".strtoupper(trim($zona[$i]))."',0,'".$idmunicipio."','".strtoupper(trim($encargado[$i]))."')";							
						$DBGestion->Consulta($sql);	$sql="INSERT INTO BOLETINES (REPORTES, HORA, IDDEPARTAMENTO, MOVILIZADOS, ZONA, ESTADO, IDMUNICIPIO, ENCARGADO) 
						VALUES ('5to REPORTE','2pm','".$iddepartamento."',0,'".strtoupper(trim($zona[$i]))."',0,'".$idmunicipio."','".strtoupper(trim($encargado[$i]))."')";							
						$DBGestion->Consulta($sql);	
						$sql="INSERT INTO BOLETINES (REPORTES, HORA, IDDEPARTAMENTO, MOVILIZADOS, ZONA, ESTADO, IDMUNICIPIO, ENCARGADO) 
						VALUES ('6to REPORTE','3pm','".$iddepartamento."',0,'".strtoupper(trim($zona[$i]))."',0,'".$idmunicipio."','".strtoupper(trim($encargado[$i]))."')";							
						$DBGestion->Consulta($sql);	
						$sql="INSERT INTO BOLETINES (REPORTES, HORA, IDDEPARTAMENTO, MOVILIZADOS, ZONA, ESTADO, IDMUNICIPIO, ENCARGADO) 
						VALUES ('7mo REPORTE','4pm','".$iddepartamento."',0,'".strtoupper(trim($zona[$i]))."',0,'".$idmunicipio."','".strtoupper(trim($encargado[$i]))."')";							
						$DBGestion->Consulta($sql);		
					
				}
			}catch(Exception $e){
						imprimir($e);
					}
}
?>