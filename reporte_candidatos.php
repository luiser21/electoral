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
			<h4>Candidatos</h4>
			
			<div id="crudFormLineal" style="width: 910px; height: 520px; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
				<h2>Reporte de Candidatos</h2>
					<div id="tableButtons">
<input id="cmdatras" type="button" onclick="history.go(-1);" value="Atras" name="cmdatras">
<input id="cmdexport" class="cmdexport" type="button" onclick="window.location='candidatos.php'" value="Aderir +" name="cmdexport">
</div>			
				<div id="demo"  >
					<?php 
		$sql="SELECT
					candidato.ID,
					candidato.NOMBRES,
					candidato.APELLIDOS,
					candidato.CEDULA,
					tipo_eleccion.NOMBRE as TIPOCANDIDATO,
					candidato.NTARJETON,
					partidos_politicos.NOMBRECORTO as PARTIDO
					FROM
					candidato
					INNER JOIN tipo_eleccion ON tipo_eleccion.IDTIPO = candidato.TIPOCANDIDATO
					INNER JOIN partidos_politicos ON partidos_politicos.IDPARTIDO = candidato.PARTIDO";

				$DBGestion->ConsultaArray($sql);
				$partidos=$DBGestion->datos;
		?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" >
	<thead>
		<tr>
			<th></th>
			<th>Nombres y Apellidos</th>
			<th>Documento</th>
			<th>Tipo Candidato</th>
			<th>Partido Politico</th>
			<th>N Tarjeton</th>
			
		</tr>
	</thead>	
	<tbody>
	<?php	
				$i=0;
				foreach ($partidos as $datos){
							 $id = $datos['ID'];
							 $nombre = $datos['NOMBRES'];
							 $apellido = $datos['APELLIDOS'];		
							 $cedula = $datos['CEDULA'];	
							 $tipo= $datos['TIPOCANDIDATO'];
							 $partido = $datos['PARTIDO'];
							 $tarjeton= $datos['NTARJETON'];								
				?>
		<tr >
				<th><a  class='iframe' href="editar_candidatos.php?id=<?php echo $id?>"><img src="images/edit.png" title="Editar Candidato" ></a>&nbsp;&nbsp;<img src="images/user-trash-full.png"></th>
			<td><?php echo $nombre.' '.$apellido?></td>
			<td class="center"><?php echo $cedula?></td>
			<td class="center"><?php echo $tipo?></td>
			<td ><?php echo $partido ?></td>
			<td ><?php echo $tarjeton ?></td>		
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