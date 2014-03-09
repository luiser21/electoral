<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
$departamento= (!empty($_POST['departamento']))? $_POST['departamento']: 0;
        
?>
<input name="voto_<?php echo $departamento?>" type="text" id="voto_<?php echo $departamento?>" value="0"  style="width:70px" align="right">
	<input id="btnSave" class="submit" type="button" value="OK" onClick="guardar(<?php echo $departamento?>);" style="width: 50px;"/>	