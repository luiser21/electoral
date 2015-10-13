<?php require_once('topadmin.php');?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">   
<link rel="stylesheet" type="text/css" href="css/style2.css" />
<script type="text/javascript" src="js/modernizr.custom.04022.js"></script>	
<link rel="stylesheet" type="text/css" media="screen" href="themes/redmond/jquery-ui-custom.css" />
<script src="js/jquery.jqChart.min.js" type="text/javascript"></script>     
<script src="js/jquery-ui-custom.min.js" type="text/javascript"></script>
	
<style type="text/css">
.bg1 {
    background: none repeat scroll 0 0 #090909;
    margin-top: 455px;
}
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; }
 .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #ffffff; -webkit-border-radius: 1px; -moz-border-radius: 1px; border-radius: 1px; }
 .datagrid table td, .datagrid table th { padding: 4px 10px; }
 .datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #7D7D7D) );background:-moz-linear-gradient( center top, #8C8C8C 5%, #7D7D7D 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#7D7D7D');background-color:#8C8C8C; color:#FFFFFF; font-size: 12px; font-weight: bold; }
  .datagrid table thead th:first-child { border: none; }
  .datagrid table tbody td { color: #7D7D7D; border-left: 2px solid #DBDBDB;font-size: 13px;font-weight: normal; }.datagrid table tbody .alt td { background: #EBEBEB; color: #7D7D7D; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #8C8C8C;background: #EBEBEB;} 
  .datagrid table tfoot td { padding: 0; font-size: 15px } 
  .datagrid table tfoot td div{ padding: 1px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #F5F5F5;background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #7D7D7D) );background:-moz-linear-gradient( center top, #8C8C8C 5%, #7D7D7D 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#7D7D7D');background-color:#8C8C8C; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #7D7D7D; color: #F5F5F5; background: none; background-color:#8C8C8C;}
</style>
		  <link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" />
		  		  <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" />
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"sScrollY": 525,
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
			} );
		</script>
<!--[if lt IE 9]>
			<style>
				.content{
					height: auto;
					margin: 0;
				}
				.content div {
					position: relative;
				}
			</style>
		<![endif]-->
		
<div class="main">					
	<header>
	<div style=" position:absolute; top:190px">
	<h4>Partidos Politicos de Colombia</h4>
	<div>
		<?php include ("grafico_partido_mayorvotacion.php");?>
      </div>
				<section class="tabs">
	            <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
		        <label for="tab-1" class="tab-label-1">Resumen Nacional</label>
		
	            <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
		        <label for="tab-2" class="tab-label-2">Senado</label>
		
	            <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
		        <label for="tab-3" class="tab-label-3">Camara</label>
			
	            <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" />
		        <label for="tab-4" class="tab-label-4">Partidos Politicos</label>
            
			    <div class="clear-shadow"></div>
			
		        <div class="content">
			        <div class="content-1 datagrid">
				<table width="100%" border="1">
  <tr>
    <th scope="row" width="50%" style="border: 1px solid #CCCCCC;"><h2>Senado</h2>
					<br/>
					<p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/chart.png" ></p>
					<br/>
					
						<?php 
		$sql="SELECT * FROM  circunscripcion_electoral WHERE TIPO='5' AND INDIGENA='0' AND ELECCIONES='2010' ORDER BY ID";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="50%" border='1' cellpadding="1" cellspacing="1"  style="border: 1px solid #CCCCCC;">
				<tbody >
					
				<?php	
				$i=0;
				foreach ($circun as $datos){
							 $descripcion = $datos['DESCRIPCION'];
							 $votos = $datos['VOTOS'];
							 $participacion = $datos['PARTICIPACION'];		
							 
							  			 
				?>
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
					
							<td align="left"><?php echo $descripcion?></td>
							<td align="center"><?php echo $votos?></td>
							<td align="center"><?php echo $participacion ?></td>
							
						</tr>			
						
					<?php
					$i++;
						}
					 ?>	
					</tbody>
				</table>
		<h3>Partidos Con Mayor  Votaci&oacute;n</h3>
					
				<br/><br/>
					
						<?php 
		$sql="SELECT
				partidos_politicos.NOMBRE,
				elecciones_senado.VOTOS,
				elecciones_senado.PARTICIPACION
				FROM
				elecciones_senado
				INNER JOIN partidos_politicos ON partidos_politicos.IDPARTIDO = elecciones_senado.IDPARTIDO
				where elecciones_senado.TIPO='5' and
				elecciones_senado.INDIGENA='0' and elecciones_senado.ELECCIONES='2010'
				ORDER BY partidos_politicos.IDPARTIDO asc";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="50%" border='1' cellpadding="1" cellspacing="1"  style="border: 1px solid #CCCCCC;">
				<tbody >
					
				<?php	
				$i=0;
				foreach ($circun as $datos){
					if($i<4){
							 $nombre = $datos['NOMBRE'];
							 $votos = $datos['VOTOS'];
							 $participacion = $datos['PARTICIPACION'];		
							 
							  			 
				?>
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
					
							<td align="left"><?php echo $nombre?></td>
							<td align="center"><?php echo $votos?></td>
							<td align="center"><?php echo $participacion ?></td>
							
						</tr>			
						
					<?php 
					
					}else{
					break;
					}
					$i++;
						}
					 ?>	
					</tbody>
				</table><br/><br/><br/>
				
			
			</th>
    <th scope="row" width="70%"  style="border: 1px solid #CCCCCC;"><h2>Camara</h2>
					<br/>
					<p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/chart.png" ></p>
					<br/>
					
						<?php 
		$sql="SELECT * FROM circunscripcion_electoral WHERE TIPO='6' AND INDIGENA='0' AND ELECCIONES='2010' ORDER BY ID";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="70%" border='1' cellpadding="1" cellspacing="1"  style="border: 1px solid #CCCCCC;">
				<tbody >
					
				<?php	
				$i=0;
				foreach ($circun as $datos){
							 $descripcion = $datos['DESCRIPCION'];
							 $votos = $datos['VOTOS'];
							 $participacion = $datos['PARTICIPACION'];		
							 
							  			 
				?>
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
					
							<td align="left"><?php echo $descripcion?></td>
							<td align="center"><?php echo $votos?></td>
							<td align="center"><?php echo $participacion ?></td>
							
						</tr>			
						
					<?php
					$i++;
						}
					 ?>	
					</tbody>
				</table>
				<h3>Departamentos con Mayor Nivel de Reporte</h3>
					<br/><br/>
					
						<?php 
		$sql="SELECT
				departamentos.NOMBRE
				FROM
				eleccions_camara_departamento AS Tabla1
				INNER JOIN eleccions_camara_departamento AS Tabla2 ON Tabla2.MESAS = Tabla1.MESAS_PROCESADAS
				INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = Tabla1.IDDEPARTAMENTO
				where Tabla1.ELECCION='2010'";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="70%" border='1' cellpadding="1" cellspacing="1"  style="border: 1px solid #CCCCCC;">
				<tbody >
					
				<?php	
				$i=0;
				foreach ($circun as $datos){
							 $nombre = $datos['NOMBRE'];
						
							 
							  			 
				?>
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
					
							<td align="left"><?php echo $nombre?></td>
							<td align="center"><?php echo '100.00%'?></td>
							
							
						</tr>			
						
					<?php
					$i++;
						}
					 ?>	
					</tbody>
				</table>
				</th>
    
 
  </tr>
</table>
	
					
		
		
					</div>
			        <div class="content-2 datagrid" style="  height: 800px;
    overflow-y: scroll;
    width: 91%;">
					<table width="100%" style="overflow:scroll;">
					<tr><td>
						<h2>Resultado por Partidos Pol&iacute;ticos</h2>
						<h1 style="font-size:18px">CIRCUNSCRIPCI&Oacute;N NACIONAL</h1>
					<br/>
						<br/>
					
						<?php 
		$sql="SELECT * FROM circunscripcion_electoral WHERE TIPO='5' AND INDIGENA='0' AND ELECCIONES='2010' ORDER BY ID";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="100%" border='1' cellpadding="1" cellspacing="1"  style="border: 1px solid #CCCCCC;">
				<tbody >
					
				<?php	
				$i=0;
				foreach ($circun as $datos){
							 $descripcion = $datos['DESCRIPCION'];
							 $votos = $datos['VOTOS'];
							 $participacion = $datos['PARTICIPACION'];		
							 
							  			 
				?>
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
					
							<td align="left"><?php echo $descripcion?></td>
							<td align="center"><?php echo $votos?></td>
							<td align="center"><?php echo $participacion ?></td>
							
						</tr>			
						
					<?php
					$i++;
						}
					 ?>	
					</tbody>
				</table>
				<br/><br/>
						<?php 
		$sql="SELECT
				partidos_politicos.NOMBRE,
				elecciones_senado.VOTOS,
				elecciones_senado.PARTICIPACION
				FROM
				elecciones_senado
				INNER JOIN partidos_politicos ON partidos_politicos.IDPARTIDO = elecciones_senado.IDPARTIDO
				where elecciones_senado.TIPO='5' and
				elecciones_senado.INDIGENA='0' and elecciones_senado.ELECCIONES='2010'
				ORDER BY partidos_politicos.IDPARTIDO asc";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="100%" border='1' cellpadding="1" cellspacing="1"  style="border: 1px solid #CCCCCC;">
<thead>				<tr>
					<th width="1%"></th>
					<th>Partidos Pol&iacute;ticos</th>
					<th>Votos</th>
					<th>Participaci&oacute;n (VotosPartido/VotosV&aacute;lidos)</th>
				</tr></thead>
				<tbody >
					
				<?php	
				$i=0;
				foreach ($circun as $datos){
				//	if($i<4){
							 $nombre = $datos['NOMBRE'];
							 $votos = $datos['VOTOS'];
							 $participacion = $datos['PARTICIPACION'];		
							 
							  			 
				?>
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
					<td align="center"><img src="images/list-add.png" title="Ver Candidatos que se lanzaron" style="cursor:pointer"></td>
							<td align="left"><?php echo $nombre?></td>
							<td align="center"><?php echo $votos?></td>
							<td align="center"><?php echo $participacion ?></td>
							
						</tr>			
						
					<?php 
					
					
					$i++;
						}
					 ?>	
					</tbody>
				</table>
						<h1 style="font-size:18px">CIRCUNSCRIPCI&Oacute;N INDIGENA</h1>
					<br/>
						<br/>
					
						<?php 
		$sql="SELECT * FROM circunscripcion_electoral WHERE TIPO='5' AND INDIGENA='1' AND ELECCIONES='2010' ORDER BY ID";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="100%" border='1' cellpadding="1" cellspacing="1"  style="border: 1px solid #CCCCCC;">
				<tbody >
					
				<?php	
				$i=0;
				foreach ($circun as $datos){
							 $descripcion = $datos['DESCRIPCION'];
							 $votos = $datos['VOTOS'];
							 $participacion = $datos['PARTICIPACION'];		
							 
							  			 
				?>
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
					
							<td align="left"><?php echo $descripcion?></td>
							<td align="center"><?php echo $votos?></td>
							<td align="center"><?php echo $participacion ?></td>
							
						</tr>			
						
					<?php
					$i++;
						}
					 ?>	
					</tbody>
				</table>
				<br/><br/>
						<?php 
		$sql="SELECT
				partidos_politicos.NOMBRE,
				elecciones_senado.VOTOS,
				elecciones_senado.PARTICIPACION
				FROM
				elecciones_senado
				INNER JOIN partidos_politicos ON partidos_politicos.IDPARTIDO = elecciones_senado.IDPARTIDO
				where elecciones_senado.TIPO='5' and
				elecciones_senado.INDIGENA='1' and elecciones_senado.ELECCIONES='2010'
				ORDER BY partidos_politicos.IDPARTIDO asc";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="100%" border='1' cellpadding="1" cellspacing="1"  style="border: 1px solid #CCCCCC;">
				<thead>				<tr>
					<th width="1%"></th>
					<th>Partidos Pol&iacute;ticos</th>
					<th>Votos</th>
					<th>Participaci&oacute;n (VotosPartido/VotosV&aacute;lidos)</th>
				</tr></thead>
				<tbody >
					
				<?php	
				$i=0;
				foreach ($circun as $datos){
				//	if($i<4){
							 $nombre = $datos['NOMBRE'];
							 $votos = $datos['VOTOS'];
							 $participacion = $datos['PARTICIPACION'];		
							 
							  			 
				?>
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
						<td align="center"><img src="images/list-add.png" title="Ver Candidatos que se lanzaron" style="cursor:pointer"></td>
							<td align="left"><?php echo $nombre?></td>
							<td align="center"><?php echo $votos?></td>
							<td align="center"><?php echo $participacion ?></td>
							
						</tr>			
						
					<?php 
					
					
					$i++;
						}
					 ?>	
					</tbody>
				</table> 
				</td></tr></table>
				    </div>
			        <div class="content-3">						
				    </div>
				    <div class="content-4">			
				    </div>
		        </div>
			</section>
	  </div>		
	</header>			
</div>	
<?php require_once('bottom.php'); ?>		