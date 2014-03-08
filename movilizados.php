<?php require_once('topadmin.php');?> 
 

<style>

#crudFormLineal label {
	width: 350px;
}
.bg1 {  
	position:relative;
	top:600px;
}



</style>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( "#accordion" ).accordion();
});
function movilizados(k){
	var pagina= "Ajax_total.php";
	var capa = "capa_documentos_"+k;
	var pagina2= "Ajax_movilizar.php";
	var capa2 = "capa_movilizar_"+k;
	var municipio = document.getElementById('municipio').value;
	
	var valores = 'k='+k+'&municipio=' + municipio + '&' + Math.random();
	if(municipio!=''){ 			
	    FAjax (pagina,capa,valores,'POST',true) ; 
			FAjax (pagina2,capa2,valores,'POST',true);     	 
	}
}
function guardar(departamento){
	var pagina= "Ajax_total.php";
	var capa = "capa_documentos_"+departamento;
	
	var pagina2= "Ajax_movilizar.php";
	var capa2 = "capa_movilizar_"+departamento;
	
	var voto = document.getElementById('voto_'+departamento).value;	
	var valores = 'voto='+voto+'&departamento=' + departamento + '&' + Math.random();		
	FAjax (pagina,capa,valores,'POST',true) ; 
	FAjax (pagina2,capa2,valores,'POST',true);     	 
	
}
</script>
<div class="main">	
<header>
		<div style=" position:absolute; top:190px; width:auto; clear:both"><br/>
			
			<div id="crudFormLineal" style="width: 910px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
<div id="accordion">
<?php 
$sql="SELECT
		DISTINCT boletines_departamentos.zona as ZONAS,
		boletines_departamentos.ENCARGADO
		FROM
		boletines_departamentos ";
$DBGestion->ConsultaArray($sql);
$zona=$DBGestion->datos;	
	for($i=0; $i<count($zona); $i++){
		
		echo "<h3>".$zona[$i]['ZONAS']." - ".$zona[$i]['ENCARGADO']."</h3><div><p>";
		$sql="SELECT 
			boletines_departamentos.IDDEPARTAMENTO,
			departamentos.NOMBRE,
			SUM(boletines_departamentos.MOVILIZADOS) AS MOVILIZADOS
			FROM
			boletines_departamentos
			INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = boletines_departamentos.IDDEPARTAMENTO
			where boletines_departamentos.zona='".$zona[$i]['ZONAS']."'
			GROUP BY IDDEPARTAMENTO
			order by NOMBRE";
		$DBGestion->ConsultaArray($sql);
		$departamentos=$DBGestion->datos; ?>
		<table width="100%" border="2" cellpadding="2" cellspacing="2" style="border: solid 1px #000000;  ">
			  <tr style="border: solid 1px #000000; background-color:#009933; color:#FFFFFF">
				<th scope="col" style="border: solid 1px #000000;">DEPARTAMENTO</th>
				<th scope="col" style="border: solid 1px #000000;">TOTAL</th>
				<th scope="col" style="border: solid 1px #000000;">MOVILIZADOS</th>
			  </tr>
	<?php	for($k=0; $k<count($departamentos); $k++){
		//	echo $departamentos[$k]['NOMBRE'].'<br/>'	;?>
			
			  <tr style="border: solid 1px #000000;">
				<td align="center" style="border: solid 1px #000000;"><?php echo $departamentos[$k]['NOMBRE']?> 
				<input type="hidden" id="departamento" name="departamento" value="<?php echo $departamentos[$k]['IDDEPARTAMENTO']?>"/></td>
				
				<td style="border: solid 1px #000000;" align="right"><div id="capa_documentos_<?php echo $departamentos[$k]['IDDEPARTAMENTO']?>">
				 <strong><?php echo $departamentos[$k]['MOVILIZADOS']?></strong>
				</div></td>
				<td style="border: solid 1px #000000;" align="center"><div id="capa_movilizar_<?php echo $departamentos[$k]['IDDEPARTAMENTO']?>">
				<input name="voto_<?php echo $departamentos[$k]['IDDEPARTAMENTO']?>" type="text" id="voto_<?php echo $departamentos[$k]['IDDEPARTAMENTO']?>" value="0"  style="width:70px" align="right">
	<input id="btnSave" class="submit" type="button" value="OK" onClick="guardar(<?php echo $departamentos[$k]['IDDEPARTAMENTO']?>);" style="width: 50px;"/>	
				</div></td>
			  </tr>
			

		<?php } echo "</table>";
		echo "</p></div>";
	}
?> 
</div>
			
				
		  </div></div>
		</header>	
		
	 </div>

	 
	 </body>
<?php require_once('bottom.php'); ?>		