<?php require_once('topadmin.php');?> 
		  <link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
		  		  <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="css/careers_lightbox/colorbox.css" />
<script src="js/jquery.colorbox.js"></script> 
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
    background: none repeat scroll 0 0 #090909;
    margin-top: 85px;
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
		$sql="SELECT * FROM PARTIDOS_POLITICOS where FUNDACION>2000";
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
			
		</tr>
	</thead>
	
	<tbody>
	<?php	
				$i=0;
				foreach ($partidos as $datos){
							 $id = $datos['IDPARTIDO'];
							 $nombre = $datos['NOMBRE'];
							 $fundacion = $datos['FUNDACION'];		
							 $pagina = $datos['PAGINAWEB'];	
							 $posicion = $datos['POSICIOGOBIERNO'];
							 $senadores = $datos['NUMEROSENADORES'];
							 $representantes= $datos['NUMEROREPRESENTANTES'];	
							 $director = $datos['DIRECTOR'];	
							  $logo = $datos['LOGO'];
							  			 
				?>
		<tr >
				<th><a  class='iframe' href="editar_candidatos.php?id=<?php echo $id?>"><img src="images/edit.png" title="Editar Candidato" ></a>&nbsp;&nbsp;<img src="images/user-trash-full.png"></th>
			<td><?php echo $nombre?></td>
			<td class="center"><?php echo $fundacion?></td>
			<td class="center"><?php echo $posicion?></td>
			<td ><?php echo $director ?></td>
		
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