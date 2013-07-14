<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	

$puesto= (!empty($_POST['puesto']))? $_POST['puesto']: 0;

echo '<select name="mesas" id="mesas" >';   

 echo $sql="SELECT
				mesas.ID,
				mesas.MESA
				FROM
				mesas
				where IDPUESTO='".$puesto."' order by MESA";
$DBGestion->ConsultaArray($sql);
$mun=$DBGestion->datos;	
	
echo '<option value="">Seleccione....</option>'; 
foreach ($mun as $datos){
	 $id = $datos['ID'];
	 $nombre = $datos['MESA'];
	echo '<option value="'.$id.'">'.$nombre.'</option>';
		
}
echo '</select>';
?>