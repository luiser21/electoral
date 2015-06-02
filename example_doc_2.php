<?php
ini_set('default_socket_timeout', 5);
require_once 'Excel/Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
include_once "includes/GestionBD.new.class.php";

@$data->setOutputEncoding('CP1251');
$data->read('Excel/cargas/cedulas_recojidas.xls');
$y=0;
$registros=count($data->sheets[0]['cells']);
for ($i = 2; $i <= $registros; $i++) {
	$cedula_simpatizante[$y]=trim($data->sheets[0]['cells'][$i][1]);
	@$alcaldia[$y]=trim($data->sheets[0]['cells'][$i][2]);
	@$consejo[$y]=$data->sheets[0]['cells'][$i][3];
	$y++;
	
}
$DBGestion = new GestionBD('AGENDAMIENTO');	
$tipo=0;
for($i=0; $i<$registros-1; $i++){		
	$sql="select IDPUESTO from cedulas_inscritas where CEDULAS=".trim($cedula_simpatizante[$i]);
	$DBGestion->ConsultaArray(strtoupper($sql));	
	$idpuesto=$DBGestion->datos;
	if(strtoupper(@$alcaldia[$i])=='X'){
		$tipo=3;
	}else{
		$tipo=4;
	}
	if(!empty($idpuesto[0])){
		$sql="INSERT INTO recoleccion_cedulas (IDPUESTO, CEDULAS,CANDIDATO, TIPOELECCION) VALUES 
		(".$idpuesto[0]['IDPUESTO'].",".trim($cedula_simpatizante[$i]).",23,".$tipo.")";		
		echo $sql;
		$DBGestion->Consulta($sql);
	}else{
		$sql="INSERT INTO recoleccion_cedulas (CEDULAS,CANDIDATO, TIPOELECCION) VALUES 
		(".trim($cedula_simpatizante[$i]).",23,".$tipo.")";			
		echo '<br/>'.$sql;
		$DBGestion->Consulta($sql);
	}
}	?>