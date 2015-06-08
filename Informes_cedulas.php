<?php require_once('topadmin.php');?> 

  <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>


<style>
#logo3 {  position:absolute; float: left; margin-left: 375px; top:258px;z-index: 1; background:url(<?php echo $_SESSION["logo2"]?>) 0px 0px no-repeat;width:500px;height:90px}

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
      <h4 align="left">Consolidado por Simpatizantes Aptos para Votar</h4></td>
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

						<br/>
<div class="filtering">
    <form>
       <input type="text" name="name" id="name" />
        <button type="submit" id="LoadRecordsButton">Buscar</button>

    </form>
</div>
<div style="position:absolute; left: 30px; top: 230px;" style="font-size:12px">
<table width="900" border="1" align="center" style="font-size:12px">
  <tr align="center">
    <th scope="col">TOTAL CC REPORTADAS </th>
    <th scope="col"><strong>CRUZARON </strong></th>
	 <th scope="col">CRUZE ALCALDIA </th>
	  <th scope="col"><strong>FIRMAS ALCALDIA </strong></th>
	    <th scope="col">NO FIRMADAS ALCALDIA </th>
	   <th scope="col"><strong>CRUZE CONCEJO </strong></th>
	    <th scope="col">FIRMAS CONCEJO </th>
		<th scope="col"><strong>NO FIRMADAS CONCEJO</strong> </th>
		<th scope="col">ALCALDIA-CONCEJO </th>
		<th scope="col"><strong>SIN FIRMAS</strong> </th>
  </tr>
  <?php 
  
  $sql="";
if($_SESSION["username"]!='alcaldia'){	
	$sql="SELECT
	(SELECT COUNT(1) FROM recoleccion_cedulas) AS CEDULAS_TOTAL,
	count(recoleccion_cedulas.cedulas) as CEDULAS_CRUCE,
	(Select count(r.cedulas) from recoleccion_cedulas r where R.IDPUESTO IS NULL) as NOCRUZAN	,
	(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where  R.TIPOELECCION1=3 AND R.IDPUESTO IS NOT NULL) as ALCALDIA_CRUCE,
	(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where  R.TIPOELECCION1=3) as ALCALDIA,
	(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where  R.TIPOELECCION1=0) as NOALCALDIA,	
	(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where  R.TIPOELECCION2=4 AND R.IDPUESTO IS NULL) as NOCONCEJO_CRUCE,  
	(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where  R.TIPOELECCION1=0 AND R.IDPUESTO IS NOT NULL) as NOALCALDIA_CRUCE_FALT,
	(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where  R.TIPOELECCION2=0 AND R.IDPUESTO IS NOT NULL) as NOCONCEJO_CRUCE_FALT,
	(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where  R.TIPOELECCION1=3 AND R.IDPUESTO IS NULL) as NOALCALDIA_CRUCE,
	(Select count(r.TIPOELECCION2) from recoleccion_cedulas r where  R.TIPOELECCION2=4 AND R.IDPUESTO IS NOT NULL) as CONCEJO_CRUCE,
	(Select count(r.TIPOELECCION2) from recoleccion_cedulas r where  R.TIPOELECCION2=4) as CONCEJO,
	(Select count(r.TIPOELECCION2) from recoleccion_cedulas r where  R.TIPOELECCION2=0) as NOCONCEJO,
	(Select count(r.TIPOELECCION2) from recoleccion_cedulas r where  R.TIPOELECCION1=3 AND R.TIPOELECCION2=4) as ALCON,
	(Select count(r.cedulas) from recoleccion_cedulas r where R.TIPOELECCION1=0 and R.TIPOELECCION2=0) as SINFIRMAS	
	FROM
	puestos_votacion
	INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
	INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
	INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
	where usuario.USUARIO='".$_SESSION["username"]."' ";

}
$DBGestion->ConsultaArray($sql);				
$datos=$DBGestion->datos;	


  ?>
  
  <tr align="center">
 <td style="font-size:20px"><img src="images/voting-box-hi.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['CEDULAS_TOTAL']?></strong></td>
 <td style="font-size:20px"><img src="images/voting-box-hi.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['CEDULAS_CRUCE']?></strong></td>
 <td style="font-size:20px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['ALCALDIA_CRUCE']?></strong></td>
 <td style="font-size:20px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['ALCALDIA']?></strong></td>
  <td style="font-size:20px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['NOALCALDIA']?></strong></td>
  <td style="font-size:20px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['CONCEJO_CRUCE']?></strong></td>
 <td style="font-size:20px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['CONCEJO']?></strong></td>
 <td style="font-size:20px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['NOCONCEJO']?></strong></td>
 <td style="font-size:20px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['ALCON']?></strong></td>
 <td style="font-size:20px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['SINFIRMAS']?></strong></td>

 </tr>
</table></div>
<p></p>
<div id="PeopleTableContainer" style="width: 100%;padding-top: 120px;;">
<table width="100%" border="0">
  <tr>
    <td><div id="piechart_3d" style="width: 300px; height:250px;" align="center"></div></td>
    <td><div id="piechart_3d2" style="width: 300px; height:250px;" align="center"></div></td>
	<td><div id="piechart_3d3" style="width: 300px; height:250px;" align="center"></div></td>
  </tr>
</table>

<script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
	  google.setOnLoadCallback(drawChart2);
	  google.setOnLoadCallback(drawChart3);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],         
          ['Cruzaron',    <?php echo $datos[0]['CEDULAS_CRUCE']?>],
		  ['No_Cruzaron',     <?php echo $datos[0]['NOCRUZAN']?>],		  
        ]);

        var options = {
          title: 'Total Cedulas Reportadas',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
	  function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Alcaldia Cruzaron',  <?php echo $datos[0]['ALCALDIA_CRUCE']?>],
          ['No Cruzaron Alcaldia', <?php echo $datos[0]['NOALCALDIA_CRUCE']?>]
        ]);

        var options = {
          title: 'Total Cedulas Reportadas x Alcaldia',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
        chart.draw(data, options);
      }
	  function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Concejo Cruzaron',  <?php echo $datos[0]['CONCEJO_CRUCE']?>],
          ['No Cruzaron Concejo', <?php echo $datos[0]['NOCONCEJO_CRUCE']?>]
        ]);

        var options = {
          title: 'Total Cedulas Reportadas x Concejo',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d3'));
        chart.draw(data, options);
      }
    </script>
	<script type="text/javascript">

		$(document).ready(function () {		
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Informe por Puestos de Votacion',
				paging: true,
				pageSize: 20,
				sorting: true,
				defaultSorting: 'Name ASC',
				actions: {
					listAction: 'PersonActionsPagedSorted_Informe_puestos_cedulas.php?action=list'
				},
				fields: {
					ID: {
						key: true,
						create: false,
						edit: false,
						list: false
					},					
					NOMBRE: {
						title: 'PUESTO DE VOTACION',
						width: '40%',
						create: false,
						edit: false
					},
					CEDULAS: {
						title: 'CEDULAS',
						width: '15%',
						create: false,
						edit: false
					},
					ALCALDIA: {
						title: 'ALCALDIA',						
						width: '10%',
						//type: 'date',
						create: false,
						edit: false,						
					},
					Phones: {
						title: '',
						width: '3%',
						sorting: false,
						edit: false,
						create: false,
						display: function (studentData) {
							//Create an image that will be used to open child table
							var $img = $('<img src="images/note.png" title="Ver Miembros x Lider" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: 'PUESTO DE VOTACION = '+studentData.record.ALCALDIA,
											actions: {
												listAction: 'ver_cedulas_alcaldia.php?con=3&idpuesto=' + studentData.record.ID,
												caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
												createAction: 'ver_miembros_lider_excel.php?con=3&idlider=' + studentData.record.ID
											},
											fields: {
												ID: {
													key: true,
													create: false,
													edit: false,
													list: false
												},
												CEDULAS_RECOGIDAS1: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},
												CEDULAS_RECOGIDAS2: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},
												CEDULAS_RECOGIDAS3: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS4: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS5: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS6: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
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
					CONCEJO: {
						title: 'CONCEJO',
						width: '10%',
						//type: 'date',
						create: false,
						edit: false
					},
					Phoness: {
						title: '',
						width: '3%',
						sorting: false,
						edit: false,
						create: false,
						display: function (studentData) {
							//Create an image that will be used to open child table
							var $img = $('<img src="images/note.png" title="Ver Miembros x Lider" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: 'PUESTO DE VOTACION = '+studentData.record.CONSEJO,
											actions: {
												listAction: 'ver_cedulas_alcaldia.php?con=4&idpuesto=' + studentData.record.ID,
												caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
												createAction: 'ver_miembros_lider_excel.php?con=4&idpuesto=' + studentData.record.ID
											},
											fields: {
												ID: {
													key: true,
													create: false,
													edit: false,
													list: false
												},
												CEDULAS_RECOGIDAS1: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},
												CEDULAS_RECOGIDAS2: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},
												CEDULAS_RECOGIDAS3: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS4: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS5: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS6: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
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
					SINFIRMAS: {
						title: 'SINFIRMAS',
						width: '10%',
						//type: 'date',
						create: false,
						edit: false
					},
					Phonesss: {
						title: '',
						width: '3%',
						sorting: false,
						edit: false,
						create: false,
						display: function (studentData) {
							//Create an image that will be used to open child table
							var $img = $('<img src="images/note.png" title="Ver Miembros x Lider" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: 'PUESTO DE VOTACION = '+studentData.record.CONSEJO,
											actions: {
												listAction: 'ver_cedulas_alcaldia.php?con=5&idpuesto=' + studentData.record.ID,
												caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
												createAction: 'ver_miembros_lider_excel.php?con=5&idpuesto=' + studentData.record.ID
											},
											fields: {
												ID: {
													key: true,
													create: false,
													edit: false,
													list: false
												},
												CEDULAS_RECOGIDAS1: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},
												CEDULAS_RECOGIDAS2: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},
												CEDULAS_RECOGIDAS3: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS4: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS5: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
													create: false,
													edit: false
												},CEDULAS_RECOGIDAS6: {
													title: 'CEDULAS_REPORTADAS',
													width: '15%',
													//type: 'date',
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