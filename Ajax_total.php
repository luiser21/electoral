<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	

$municipio= (!empty($_POST['municipio']))? $_POST['municipio']: 0;
$voto= (!empty($_POST['voto']))? $_POST['voto']: 0;
            


$sql="SELECT boletines.MOVILIZADOS
FROM
boletines
where boletines.IDMUNICIPIO='".$municipio."' and boletines.ESTADO=1";
//echo $sql;
$DBGestion->ConsultaArray($sql);
$mun=$DBGestion->datos;	

if($voto>0){
	$suma=(@$mun[0]['MOVILIZADOS']+$voto);
	$sql="UPDATE BOLETINES set MOVILIZADOS=".$suma." where IDMUNICIPIO='".$municipio."' AND ESTADO in (1,0)";			
					
	$DBGestion->Consulta($sql);	
}
$sql="SELECT boletines.MOVILIZADOS
FROM
boletines
where boletines.IDMUNICIPIO='".$municipio."' and boletines.ESTADO=1";
//echo $sql;
$DBGestion->ConsultaArray($sql);
$mun=$DBGestion->datos;	

	echo '<strong>'.@$mun[0]['MOVILIZADOS'].'</strong>';

?>