<?php require_once('topadmin.php');?> 
  <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>

<style>

#crudFormLineal label {
	width: 350px;
}

h4{

 color: #006600;
    font-family: 'GothamLight',arial,serif;
    font-size: 18px;
    font-weight: lighter;
    margin-bottom: 1px;
    margin-left: 1px;
    margin-top: 1px;
}
button, input[type="button"], input[type="submit"] {
    background-color: #A1AAAF;
    border: 0 none;
    color: #FFFFFF;
    cursor: pointer;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    height: 32px;
    margin-right: 2px;
    width: 108px;
}
</style>
<div class="main">	
<header>
		<div style=" position:absolute; top:190px; width:auto; clear:both"><br/>
			
			<div id="crudFormLineal" style="width: 910px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			
			<table width="auto" border="0" style="line-height:2px;">
  <tr>
    <th width="227" rowspan="7" scope="row"><?php if($_SESSION['foto']!=""){?>
						<img src="<?php echo $_SESSION['foto']?>" width="94" height="108" style="border:3px solid #CCCCCC;">
			<?php }else{ ?>		
				<img src="fotos/images.jpg" width="94" height="108" style="border:3px solid #CCCCCC;">
			<?php } ?>	</th>
    <td width="575"><h4 align="left">&nbsp;</h4>
      <h4 align="left">&nbsp;</h4>
      <h4 align="left"><h4 align="left">Consolidado por Lideres VS Simpatizantes</h4></td>
  </tr>
  <tr>
    <td>

      <h4 align="left" style="font-size: 14px; color: #999999"><?php echo $_SESSION['nombre']?></h4></td>
  </tr>

     <td><h4 align="left" style="font-size: 14px">Candidato 
	<?php if($_SESSION['tipocandidato']=='PRESIDENCIA'){
		echo 'a la '.$_SESSION['tipocandidato'];
	}elseif($_SESSION['tipocandidato']=='GOBERNACION'){
		echo 'a la '.$_SESSION['tipocandidato'].' de ';	
	}elseif($_SESSION['tipocandidato']=='ALCALDIA'){
		echo 'a la '.$_SESSION['tipocandidato'].' del ';	
	}elseif($_SESSION['tipocandidato']=='CONSEJO'){
		echo 'al '.$_SESSION['tipocandidato'].' de ';	
	}elseif($_SESSION['tipocandidato']=='SENADO'){
		echo 'al '.$_SESSION['tipocandidato'].' de la República';	
	}elseif($_SESSION['tipocandidato']=='CAMARA'){
		echo 'a la '.$_SESSION['tipocandidato'].' de Representantes';	
	}elseif($_SESSION['tipocandidato']=='JAL'){
		echo 'a la '.$_SESSION['tipocandidato'];	
	}
	?> </h4></td>
  </tr>
    <tr><td><h4 align="left" style="font-size: 14px; color: #999999">
	<?php 
	if($_SESSION['tipocandidato']=='PRESIDENCIA'){
		echo 'COLOMBIA';
	}elseif($_SESSION['tipocandidato']=='GOBERNACION'){
		echo ucwords(strtolower($_SESSION['departamento']));	
	}elseif($_SESSION['tipocandidato']=='ALCALDIA'){
		echo 'Municipio de '. ucwords(strtolower($_SESSION['municipio'])); 
	}elseif($_SESSION['tipocandidato']=='CONSEJO'){
		echo ucwords(strtolower($_SESSION['municipio'])).' - '.ucwords(strtolower($_SESSION['departamento'])); 
	}elseif($_SESSION['tipocandidato']=='SENADO'){
		echo 'Por '.ucwords(strtolower($_SESSION['departamento']));	
	}elseif($_SESSION['tipocandidato']=='CAMARA'){
		echo 'Por '.ucwords(strtolower($_SESSION['departamento']));
	}elseif($_SESSION['tipocandidato']=='JAL'){
		echo ucwords(strtolower($_SESSION['municipio'])).' - '.ucwords(strtolower($_SESSION['departamento'])); 
	}?></h4></td></tr>
  <tr>
  <tr>
    <td><h4 align="left" style="font-size: 14px"><?php echo $_SESSION['partido']?> </h4></td>
  </tr>
  <tr>
    <td><h4 align="left" style="font-size: 14px; color: #999999"><?php 
	if($_SESSION['tipocandidato']!='PRESIDENCIA'  && $_SESSION['tipocandidato']!='GOBERNACION' && $_SESSION['tipocandidato']!='ALCALDIA'){?>
		Tarjeton # <?php echo $_SESSION['ntarjeton']?></h4> </td>
	<?php }?>
  </tr> 
</table>
<?php 
$sql="";
$sql2="";
if($_SESSION["username"]!='alcaldia'){	
		
	$sql="SELECT
	count(miembros.ID) AS TOTAL
	FROM
	miembros
	INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
	INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
	INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
	INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
	where usuario.USUARIO='".$_SESSION["username"]."'";
	
}else{
	$sql="SELECT count(miembros_2010.codigo) AS TOTAL
		FROM
		miembros_2010
		INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
		INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
		INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
		INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo

		INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
		INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
		where usuario_2010.usuario='".$_SESSION["username"]."'";
	
	$sql2="SELECT count(lider_2010.codigo) AS TOTAL FROM lider_2010
			  LEFT JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.lider = lider_2010.codigo
			  LEFT JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas 
			  LEFT JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto 
			  INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
		 	  INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
			  where usuario_2010.usuario='".$_SESSION["username"]."'";
}

$DBGestion->ConsultaArray($sql);				
	$totales=$DBGestion->datos;
//Lideres
$DBGestion->ConsultaArray($sql2);				
$totales_lideres=$DBGestion->datos;
?>
						<br/>
<div class="filtering">
    <form>
        Nombre: <input type="text" name="name" id="name" />
       <!-- City:
        <select id="cityId" name="cityId">
            <option selected="selected" value="0">All cities</option>
            <option value="1">Adana</option>
            <option value="2">Ankara</option>
            <option value="3">Athens</option>
            <option value="4">Beijing</option>
            <option value="5">Berlin</option>
            <option value="6">Bursa</option>
            <option value="7">Istanbul</option>
            <option value="8">London</option>
            <option value="9">Madrid</option>
            <option value="10">Mekke</option>
            <option value="11">New York</option>
            <option value="12">Paris</option>
            <option value="13">Samsun</option>
            <option value="14">Trabzon</option>
            <option value="15">Volos</option>
        </select>-->
        <button type="submit" id="LoadRecordsButton">Buscar</button>
<input id="cmdexport" class="cmdexport" type="button" onclick="window.location='informe_puestos_exportar.php?action=exportar'" value="Exportar" name="cmdexport">

    </form>
</div>
<div style="position:absolute; left: 628px; top: 171px;">
<table width="257" border="1" align="center">
  <tr align="center">
    <th scope="col">LIDERES </th>
    <th scope="col">SIMPATIZANTES </th>
  </tr>
  <tr align="center">
    <td style="font-size:26px"><img src="images/Ejecutivo.png" width="35" height="35" /><strong><?php echo '    '.@$totales_lideres[0]['TOTAL']?></strong></td>
    <td style="font-size:26px"><img src="images/partners.png" width="35" height="35" /><strong><?php echo '    '.@$totales[0]['TOTAL']?></strong></td>
  </tr>
</table></div>
<p></p>
					<div id="PeopleTableContainer" style="width: auto;">
					<?php 
	$valores=@$_SESSION['graficos_lideres']['Records'];
	$conta='';
	for($i=0; $i<count($valores);$i++){
		if($i<8 && $valores[$i]['MIEMBROS']>=10){
			$conta.="['".$valores[$i]['NOMBRE']."', ".$valores[$i]['MIEMBROS']."],";			
		}if($i==8 && $valores[$i]['MIEMBROS']>=10){
			$conta.="['".$valores[$i]['NOMBRE']."', ".$valores[$i]['MIEMBROS']."]";			
		}
	}
	//imprimir($conta);
	//imprimir($_SESSION['graficos']['Records']);
	?>
	<div id="chart_div"><script>
google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawBasic);
function drawBasic() {
      var data = google.visualization.arrayToDataTable([
        ['Lideres', 'Simpatizantes',],
        <?php echo $conta?>
      ]);
      var options = {
        title: 'Lideres con mayor # de Simpatizantes',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Total Simpatizantes',
          minValue: 0
        },
        vAxis: {
          title: 'Lideres'
        }
      };
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>
					</div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Tabla de Lideres',
				paging: true,
				pageSize: 20,
				sorting: true,
				defaultSorting: 'Name ASC',
				actions: {
					listAction: 'PersonActionsPagedSorted_informes_lideres.php?action=list'
					//createAction: 'PersonActionsPagedSorted.php?action=create',
					//updateAction: 'PersonActionsPagedSorted.php?action=update',
					//deleteAction: 'PersonActionsPagedSorted.php?action=delete'
				},
				fields: {
					ID: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					 //CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
					Phones: {
						title: '',
						width: '5%',
						sorting: false,
						edit: false,
						create: false,
						display: function (studentData) {
							//Create an image that will be used to open child table
							var $img = $('<img src="images/note.png" title="Ver Miembros por Lideres" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: studentData.record.NOMBRE,
											actions: {
												listAction: 'ver_mesas_miembros_informe_lideres.php?idlider=' + studentData.record.ID,
												caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
												createAction: 'ver_mesas_miembros_informe_lideres_excel.php?idlider=' + studentData.record.ID
											},
											fields: {
												ID: {
													key: true,
													create: false,
													edit: false,
													list: false
												},
												NOMBRE: {
													title: 'NOMBRE',
													width: '40%',
													create: false,
													edit: false
												},
												CEDULA: {
													title: 'CEDULA',
													width: '10%',
													create: false,
													edit: false
												},
												NOMBRE_PUESTO: {
													title: 'NOMBRE_PUESTO',
													width: '40%',
													create: false,
													edit: false
												},
												MESA: {
													title: 'MESA',
													width: '10%',
													create: false,
													edit: false
												},	
												VOTOREAL: {
													title: 'VOTOREAL',
													width: '10%',
													create: false,
													edit: false
												},
												VARIACION: {
													title: 'VARIACION',
													width: '10%',
													create: false,
													edit: false
												}
											}
																	
										}, function (data) { //opened handler
											data.childTable.jtable('load');
										});
							});
							//Return image to show on the person row
							return $img;
						}
					},
					NOMBRE: {
						title: 'NOMBRE',
						width: '40%',
						create: false,
						edit: false
					},
					CEDULA: {
						title: 'CEDULA',
						width: '20%',
						create: false,
						edit: false
					},
					NOMBRE_PUESTO: {
						title: 'NOMBRE_PUESTO',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},
					MESA: {
						title: 'MESA',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},
					MIEMBROS : {
						title: 'SIMPATIZANTES',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					}/*,
					VOTOSREALES : {
						title: 'VOTOSREALES',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},
					VARIACION : {
						title: 'VARIACION',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					}*/
				}
			});

			//Load person list from server
			//$('#PeopleTableContainer').jtable('load');
			$('#LoadRecordsButton').click(function (e) {
           		 e.preventDefault();
				$('#PeopleTableContainer').jtable('load', {
					name: $('#name').val(),
					cityId: $('#cityId').val()
				});
			});
	 
			//Load all records when page is first shown
				$('#LoadRecordsButton').click();
		});

	</script>
				
					
		  </div>
		
<?php require_once('bottom.php'); ?>	</div>		
		</header>
	 </div>	