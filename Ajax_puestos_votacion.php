<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	

$municipio= (!empty($_POST['municipio']))? $_POST['municipio']: 0;

echo '<select name="puestos" id="puestos" onclick="mesa()" >';   

 echo $sql="SELECT
				puestos_votacion.IDPUESTO,
				puestos_votacion.NOMBRE_PUESTO,	
				municipios.NOMBRE as MUNICIPIO
				FROM
				puestos_votacion
				Inner Join municipios ON municipios.ID = puestos_votacion.IDMUNICIPIO
				WHERE IDMUNICIPIO='".$municipio."' order by NOMBRE_PUESTO";
$DBGestion->ConsultaArray($sql);
$mun=$DBGestion->datos;	
	
echo '<option value="">Seleccione....</option>'; 
foreach ($mun as $datos){
	 $id = $datos['IDPUESTO'];
	 $nombre = $datos['NOMBRE_PUESTO'];
	 $municipio = $datos['MUNICIPIO'];
	 if($nombre==""){
	 	echo '<option value="'.$id.'">'.$municipio.'</option>';
	 }else{
		echo '<option value="'.$id.'">'.$nombre.'</option>';
		}
}
echo '</select>';
?>