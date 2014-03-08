<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
$municipio= (!empty($_POST['municipio']))? $_POST['municipio']: 0;
$k= (!empty($_POST['k']))? $_POST['k']: 0;
                
?>
<input name="voto_<?php echo $k?>" type="text" id="voto_<?php echo $k?>" value="0"  style="width:70px" align="right">
	<input id="btnSave" class="submit" type="button" value="OK" onClick="guardar(<?php echo $k?>,<?php echo $municipio?>);" style="width: 50px;"/>	