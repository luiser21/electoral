<?php
require_once 'Excel/reader.php';
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();
 include_once "../includes/GestionBD.new.class.php";
	$DBGestion = new GestionBD('AGENDAMIENTO');	
// Set output Encoding.
$data->setOutputEncoding('CP1251');
$data->read('AREAS.xls');
error_reporting(E_ALL ^ E_NOTICE);

		$sql="SELECT *  FROM ETOM_REPOSITORIO where to_char(FECHA, 'YYYY') = '2013' AND ESTADO='A'  ORDER BY ID_CONSECUTIVO ASC ";
		$DBGestion->ConsultaArray($sql);
		$repositorio=$DBGestion->datos;		
		$numeros=array();
		$numeros_excel=array();
		$numeros_segmentos=array();
		$numeros_gerencia=array();
		$numeros_tipodocumento=array();
		$numeros_version=array();
		$numeros_observacion=array();
		$nombre_excel=array();
		$numeros_id=array();
		$i=0;
		foreach ($repositorio as $datos){
			$id = $datos["ID_REPOSITORIO"];	
			
			$nombre = $datos["ID_CONSECUTIVO"];	
			//$nombre= split( '[_.(.-. -]', @$nombre);					
			if(is_numeric($nombre[0])){
				  $numeros[$i]=$nombre;
				 $numeros_id[$i]=$id;	
				 $sql = "UPDATE ETOM_REPOSITORIO SET TIPOSOLUCION = '1', ID_CONSECUTIVO = '".@$numeros[$i]."' WHERE ID_REPOSITORIO = '".$id."'";
        		//$DBGestion->Consulta($sql);
				//$DBGestion->Commit();	 
			}		
			$i++;
		}	
		
	//sort($numeros);   
	$y=0;
	//723
for ($i = 2; $i <= 112; $i++) {
	$idvice=$data->sheets[0]['cells'][$i][1];
	$segmento=$data->sheets[0]['cells'][$i][2];
	$gerencia=$data->sheets[0]['cells'][$i][3];	
	$tipodocumento=$data->sheets[0]['cells'][$i][4];
	$version=$data->sheets[0]['cells'][$i][5];
	$observacion=$data->sheets[0]['cells'][$i][6];
	$nombreexcel=$data->sheets[0]['cells'][$i][7];
	$numeros_excel[$y]=$idvice;
	$numeros_segmentos[$y]=$segmento;
	$numeros_gerencia[$y]=$gerencia;
	$numeros_tipodocumento[$y]=$tipodocumento;
	$numeros_version[$y]=$version;
	$numeros_observacion[$y]=$observacion;
	$nombre_excel[$y]=$nombreexcel;
	$y++;
}

$numeros_excel =$numeros_excel;
$contar1= count($numeros_excel);
$contar2= count($numeros);
$n=0;

for($i=0; $i<=$contar1; $i++){
	
	$n=0;
	for($y=0; $y<$contar2; $y++){	
		 
		if($numeros[$i]==$numeros_excel[$y]){
			
			$n=1;
			
			//echo $numeros_excel[$i].' - '.$numeros[$y].' - '.$numeros_id[$y].' - '.$numeros_segmentos[$i].'<br/>';
			$sql = "INSERT INTO SEGMENTO_HAS_REPOSITORIO (ID_REPOSITORIO,IDEMPRESA) VALUES ('".$numeros_id[$i]."','".$numeros_segmentos[$y]."')";
			//$DBGestion->Consulta($sql);
		//	$DBGestion->Commit();	
	//, OBSERVACION='".$numeros_observacion[$y]."' , VERSION='".$numeros_version[$y]."' 
			$sql = "UPDATE ETOM_REPOSITORIO SET ID_TIPODOCUMENTO = '".$numeros_tipodocumento[$y]."', OBSERVACION='".$numeros_observacion[$y]."' , VERSION='".$numeros_version[$y]."', NOMBRE='".$nombre_excel[$y]."'   WHERE ID_REPOSITORIO= '".$numeros_id[$i]."'";
			$DBGestion->Consulta($sql);
			$DBGestion->Commit();		
			
			@$encargado = split( ',', @$numeros_gerencia[$y]);		
			$k = 0;			
			if(isset($encargado)){				
				while(@$encargado[$k] != ""){				
				  @$responsable = @$encargado[$k];				
				  $sql = "INSERT INTO GERENCIA_HAS_REPOSITORIO (ID_REPOSITORIO,ID_GERENCIA) VALUES ('".$numeros_id[$i]."','".@$responsable."')";
				 //$DBGestion->Consulta($sql);
				 // $DBGestion->Commit();	
				  $k++;
				}
			}	
			//break;
		}
	}
	if($n==0){
		//echo 'No encontro el comunicado: '.$numeros[$y].'<br/>';
	}	
}
?>