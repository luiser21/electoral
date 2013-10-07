<?php require_once('topadmin.php');?> 
<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" /> 
<script type="text/javascript" >
	$(document).ready(function() {
		$('#example').dataTable( {
			"sScrollY": 310,
			"bJQueryUI": true,
			"sPaginationType": "full_numbers"
		});
		$(".iframe").colorbox({
			iframe:true, 
			width:"985px", 
			height:"510px"
		});		
	} );
</script>		
<style>
select {   
	 width: 50px;
}
#crudFormLineal label {
	width: 350px;
}
.bg1 {  
	position:relative;
	top:660px;
}
</style>
<div class="main">	
<header>
		<div style=" position:absolute; top:190px"><br/>
			<h4>Simpatizantes</h4>
			
			<div id="crudFormLineal" style="width: 910px; height: 520px; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
				<h2>Listado de Simpatizantes</h2>
					<div id="tableButtons">
<input id="cmdatras" type="button" onclick="history.go(-1);" value="Atras" name="cmdatras">
<input id="cmdexport" class="cmdexport" type="button" onclick="window.location='miembros_add.php'" value="Aderir +" name="cmdexport">
</div>			
				<div id="demo"  >
					<?php 
		$sql="SELECT
				miembros.ID,
				miembros.NOMBRES,
				miembros.APELLIDOS,
				miembros.CEDULA,
				puestos_votacion.NOMBRE_PUESTO,
				mesas.MESA,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS LIDER
				FROM
				miembros
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = miembros.IDPUESTOSVOTACION
				INNER JOIN mesas ON mesas.IDPUESTO = puestos_votacion.IDPUESTO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID AND mesa_puesto_miembro.MIEMBRO = miembros.ID
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
				ORDER BY NOMBRES, APELLIDOS";

				$DBGestion->ConsultaArray($sql);
				$partidos=$DBGestion->datos;
		?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" >
	<thead>
		<tr>
			<th></th>
			<th>N°</th>
			<th>Nombres y Apellidos</th>
			<th>Documento</th>
			<th>Puesto de Votacion</th>
			<th>Mesa</th>
			<th>Lider</th>
			
		</tr>
	</thead>	
	<tbody>
	<?php	
				$i=1;
				foreach ($partidos as $datos){
							 $id = $datos['ID'];
							 $nombre = $datos['NOMBRES'];
							 $apellido = $datos['APELLIDOS'];		
							 $cedula = $datos['CEDULA'];								
							 $puesto = $datos['NOMBRE_PUESTO'];
							 $mesa = $datos['MESA'];		
							 $lider = $datos['LIDER'];						
				?>
		<tr >
				<th><a  class='iframe' href="editar_candidatos.php?id=<?php echo $id?>"><img src="images/edit.png" title="Editar Candidato" ></a>&nbsp;&nbsp;<img src="images/user-trash-full.png"></th>
			<td><?php echo $i?></td>
			<td><?php echo $nombre.' '.$apellido?></td>
			<td class="center"><?php echo $cedula?></td>
			<td class="center"><?php echo $puesto?></td>
			<td class="center" ><?php echo $mesa ?></td>
			<td class="center"><?php echo $lider ?></td>		
		</tr>
			<?php
					$i++;
						}
					 ?>	
	</tbody>
</table>
			</div>
			</div></div>
		</header>		
	 </div>
<?php require_once('bottom.php'); ?>		