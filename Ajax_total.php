<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	

$departamento= (!empty($_POST['departamento']))? $_POST['departamento']: 0;
$voto= (!empty($_POST['voto']))? $_POST['voto']: 0;
            


$sql="SELECT boletines_departamentos.MOVILIZADOS
FROM
boletines_departamentos
where boletines_departamentos.IDDEPARTAMENTO='".$departamento."' ";
//echo $sql;
$DBGestion->ConsultaArray($sql);
$mun=$DBGestion->datos;	

if($voto>0){

	$suma=(@$mun[0]['MOVILIZADOS']+$voto);
	
	$sql="UPDATE boletines_departamentos set MOVILIZADOS=".$suma." where IDDEPARTAMENTO='".$departamento."' ";						
	$DBGestion->Consulta($sql);	
	
	$sql="SELECT boletines.HORA_REAL
			FROM
			boletines
			where ESTADO=1 ";
	//echo $sql;
	$DBGestion->ConsultaArray($sql);
	$reporte=$DBGestion->datos;	
	
	if($reporte[0]['HORA_REAL']==date('H')){

		$sql="UPDATE boletines set ESTADO_DEPARTAMENTO=1 where IDDEPARTAMENTO='".$departamento."' AND ESTADO=1";						
		$DBGestion->Consulta($sql);	
		
		$sql="UPDATE boletines set MOVILIZADOS=".$suma." where IDDEPARTAMENTO='".$departamento."' AND ESTADO IN (1,0)";						
		$DBGestion->Consulta($sql);
		
	}elseif($reporte[0]['HORA_REAL']<date('H')){
	
		$sql="UPDATE boletines set ESTADO=2 where ESTADO=1";						
		$DBGestion->Consulta($sql);	
		
		$sql="UPDATE boletines set ESTADO=1 where HORA_REAL=".date('H');						
		$DBGestion->Consulta($sql);	
		
		$sql="UPDATE boletines set ESTADO_DEPARTAMENTO=1 where IDDEPARTAMENTO='".$departamento."' AND ESTADO=1";						
		$DBGestion->Consulta($sql);	
		
		$sql="UPDATE boletines set MOVILIZADOS=".$suma." where IDDEPARTAMENTO='".$departamento."' AND ESTADO IN (1,0)";						
		$DBGestion->Consulta($sql);
	}
}
$sql="SELECT boletines_departamentos.MOVILIZADOS
FROM
boletines_departamentos
where boletines_departamentos.IDDEPARTAMENTO='".$departamento."' ";;
//echo $sql;
$DBGestion->ConsultaArray($sql);
$mun=$DBGestion->datos;	
//imprimir($mun);
	echo '<strong>'.@$mun[0]['MOVILIZADOS'].'</strong>';

?>