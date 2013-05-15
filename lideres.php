<?php require_once('topadmin.php');?> 
		  <link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
		  		  <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" >
			$(document).ready(function() {
				$('#example').dataTable( {
					"sScrollY": 300,
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
			} );
		</script>
<div class="main">	
<header>
		<div style=" position:absolute; top:190px">
			<h3>Partidos Politicos de Colombia</h3>
				<div id="demo" style="width:950px">
					<?php 
		$sql="SELECT * FROM PARTIDOS_POLITICOS ";
				$DBGestion->ConsultaArray($sql);
				$partidos=$DBGestion->datos;
				
				
		
		?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" >
	<thead>
		<tr>
			<th></th>
			<th>Nombre</th>
			<th>A&ntilde;o de 	fundaci&oacute;n</th>
			<th>Posici&oacute;n frente al gobierno 2010-2014</th>
			<th>Director(a) y/&oacute; Presidente(a)</th>
			
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th></th>
				<th>Nombre</th>
			<th>A&ntilde;o de 	fundaci&oacute;n</th>
			<th>Posici&oacute;n frente al gobierno 2010-2014</th>
			<th>Director(a) y/&oacute; Presidente(a)</th>
			
		</tr>
	</tfoot>
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
			<td align="center"><img src="<?php echo $logo?>" width="45" height="25"></td>
			<td><a href="http://<?php echo $pagina?>" style="cursor:pointer; color:#666666;  text-decoration: none " target="_blank"><?php echo $nombre?></a></td>
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
			</div>
		</header>		
	 </div>

<?php require_once('bottom.php'); ?>		