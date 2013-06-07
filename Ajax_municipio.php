<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	
$departamento= (!empty($_POST['departamento']))? $_POST['departamento']: 0;
echo '<select name="municipio" id="municipio" >';                       
$sql="SELECT * FROM MUNICIPIOS WHERE IDDEPARTAMENTO='".$departamento."'";
$DBGestion->ConsultaArray($sql);
$mun=$DBGestion->datos;		
echo '<option value="">Seleccione....</option>'; 
foreach ($mun as $datos){
	 $id = $datos['ID'];
	 $nombre = $datos['NOMBRE'];
	echo '<option value="'.$id.'">'.$nombre.'</option>';
}
echo '</select>';
?>