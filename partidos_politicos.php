<?php require_once('topadmin.php');?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">   
  <link rel="stylesheet" type="text/css" href="css/style2.css" />
		<script type="text/javascript" src="js/modernizr.custom.04022.js"></script>	
<style type="text/css">
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; }
 .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #ffffff; -webkit-border-radius: 1px; -moz-border-radius: 1px; border-radius: 1px; }
 .datagrid table td, .datagrid table th { padding: 4px 10px; }
 .datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #7D7D7D) );background:-moz-linear-gradient( center top, #8C8C8C 5%, #7D7D7D 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#7D7D7D');background-color:#8C8C8C; color:#FFFFFF; font-size: 12px; font-weight: bold; }
  .datagrid table thead th:first-child { border: none; }
  .datagrid table tbody td { color: #7D7D7D; border-left: 2px solid #DBDBDB;font-size: 13px;font-weight: normal; }.datagrid table tbody .alt td { background: #EBEBEB; color: #7D7D7D; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #8C8C8C;background: #EBEBEB;} 
  .datagrid table tfoot td { padding: 0; font-size: 15px } 
  .datagrid table tfoot td div{ padding: 1px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #F5F5F5;background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #7D7D7D) );background:-moz-linear-gradient( center top, #8C8C8C 5%, #7D7D7D 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#7D7D7D');background-color:#8C8C8C; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #7D7D7D; color: #F5F5F5; background: none; background-color:#8C8C8C;}
</style>
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
<script type="text/javascript">

function OcultarFilas(Fila, Fila2) {
    var elementos = document.getElementsByName(Fila);
	var elementos2 = document.getElementsByName(Fila2);
    for (k = 0; k< elementos.length; k++) {
               elementos[k].style.display = "none";
    }
	for (kk = 0; kk< elementos2.length; kk++) {
               elementos2[kk].style.display ="inline";
    }
	
}
function MostrarFilas(Fila, Fila2) {
	
var elementos = document.getElementsByName(Fila);
    for (i = 0; i< elementos.length; i++) {
        if(navigator.appName.indexOf("Microsoft") > -1){
               var visible = 'block'
        } else {
               var visible = 'table-row';
        }
	elementos[i].style.display = visible;
        }
		
var elementos2 = document.getElementsByName(Fila2);
    for (ii = 0; ii< elementos2.length; ii++) {
        if(navigator.appName.indexOf("Microsoft") > -1){
               var visible = 'block'
        } else {
               var visible = 'table-row';
        }
	elementos2[ii].style.display = "none";
        }
}

function llamadasincrona(id) {

var pagina= "Ajax_info_adicional.php";
var capa = "contenido_"+id;
$.get(pagina, { "id": id, "nocache": Math.random()}, function(data) {  $('#'+capa).html(data);});

}

</script>		
<div class="main">					
	<header>
	<div style=" position:absolute; top:190px">
	<h3>Partidos Politicos de Colombia</h3>
		<h1 style="padding: 0px 0 20px 0px;">Informacion tomada de la Registraduria Nacional de Colombia</h1>
		
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
    <th scope="row" width="36%"><h2>Senado</h2>
					<br/>
					<img src="images/chart.png" >
					<br/><br/><br/>
					
						<?php 
		$sql="SELECT * FROM CIRCUNSCRIPCION_ELECTORAL WHERE TIPO='5' AND INDIGENA='0' AND ELECCIONES='2010' ORDER BY ID";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="36%" border='1' cellpadding="1" cellspacing="1">
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
			</th>
    <th scope="row" width="36%"><h2>Camara</h2>
					<br/>
					<img src="images/chart.png" >
					<br/><br/><br/>
					
						<?php 
		$sql="SELECT * FROM CIRCUNSCRIPCION_ELECTORAL WHERE TIPO='5' AND INDIGENA='0' AND ELECCIONES='2010' ORDER BY ID";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="36%" border='1' cellpadding="1" cellspacing="1">
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
				</table></th>
    
    <th scope="row" width="36%"><h2>Parlamento Andino</h2>
					<br/>
					<img src="images/chart.png" >
					<br/><br/><br/>
					
						<?php 
		$sql="SELECT * FROM CIRCUNSCRIPCION_ELECTORAL WHERE TIPO='5' AND INDIGENA='0' AND ELECCIONES='2010' ORDER BY ID";
				$DBGestion->ConsultaArray($sql);
				$circun=$DBGestion->datos;		
		?>
		<table width="36%" border='1' cellpadding="1" cellspacing="1">
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
				</table></th>
  </tr>
</table>
	
					
		
		
					</div>
			        <div class="content-2">
						
				    </div>
			        <div class="content-3">
						
				    </div>
				    <div class="content-4 datagrid">
				<br/>
						<?php 
		$sql="SELECT * FROM PARTIDOS_POLITICOS ";
				$DBGestion->ConsultaArray($sql);
				$partidos=$DBGestion->datos;
				
				
		
		?>
		
		<table width="100%" >
			<thead>
				<tr>
					<th align="center" ></th>
					 <th align="center" ></th>
					 <th align="center" width="46%"><span style="font-weight: bold">Nombre</span></th>
					<th align="center" width="1%"><span style="font-weight: bold">A&ntilde;o de 	fundaci&oacute;n</span></th>
					<th align="center" width="18%"><span style="font-weight: bold">Posici&oacute;n frente al gobierno 2010-2014</span></th>
					<!--   <th align="center" width="1%"><span style="font-weight: bold">N&uacute;mero de Senadores</span></th>
					<th align="center" width="1%"><span style="font-weight: bold">N&uacute;mero de Representantes</span></th>
					--><th align="center" width="26%"><span style="font-weight: bold">Director(a) y/&oacute; Presidente(a)</span></th>
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
						<tr <?php if($i%2!=0){ ?> class="alt" <?php }?>>
						<td align="center">
						<img src="images/list-add.png" onClick="javascript:MostrarFilas('ajax_<?php echo $id?>','Op2_<?php echo $id?>'),llamadasincrona('<?php echo $id?>')" id="Op2_<?php echo $id?>" name="Op2_<?php echo $id?>" title="Ver Info Adicional" style="cursor:pointer;"/>
						<img src="images/list-remove.png" onclick="javascript:OcultarFilas('ajax_<?php echo $id?>','Op2_<?php echo $id?>')" id="ajax_<?php echo $id?>" name="ajax_<?php echo $id?>" style="display:none" title="Ocultar" style="cursor:pointer;"/>
						</td>
							<td align="center"><img src="<?php echo $logo?>" width="45" height="25"></td>
							<td><a href="http://<?php echo $pagina?>" style="cursor:pointer; color:#666666;  text-decoration: none " target="_blank"><?php echo $nombre?></a></td>
							<td align="center"><?php echo $fundacion?></td>
							<td><?php echo $posicion?></td>
						<!-- <td align="center"><?php echo $senadores?></td>
							<td align="center"><?php echo $representantes?></td> -->	
							<td><?php echo $director ?></td>
							
						</tr>
						 <tr align="center"  style="display:none" id="ajax_<?php echo $id?>" name="ajax_<?php echo $id?>">
                              <td height="550" colspan="11"> 
							  		<div style="height:550px; overflow:scroll; overflow-x: hidden" id="contenido_<?php echo $id?>">
									</div>
								</td>
                            </tr>
						
					<?php
					$i++;
						}
					 ?>	
					</tbody>
				</table>
			
				    </div>
		        </div>
			</section>
	 

	  </div>		
	</header>			
</div>	
<?php //require_once('bottom.php'); ?>		