<?php require_once('topadmin.php');?>
 <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>

<script type="text/javascript">
	
function cargar(){
	var pagina= "Ajax_cargar.php";
	var capa = "cargar";	
	var valores = 'usuario=1' + Math.random();	
	FAjax (pagina,capa,valores,'POST',true)     	 
	
}
function comprueba_extension(formulario, archivo) {
   extensiones_permitidas = new Array(".xls");
   mierror = "";
   if (!archivo) {
      //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario
       mierror = "No has seleccionado ningún archivo";
   }else{
      //recupero la extensión de este nombre de archivo
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
      //alert (extension);
      //compruebo si la extensión está entre las permitidas
      permitida = false;
      for (var i = 0; i < extensiones_permitidas.length; i++) {
         if (extensiones_permitidas[i] == extension) {
         permitida = true;
         break;
         }
      }
      if (!permitida) {
         mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join();
       }else{
          //submito!
         //alert ("Todo correcto. Voy a submitir el formulario.");
         formulario.submit();
         return 1;
       }
   }
   //si estoy aqui es que no se ha podido submitir
   alert (mierror);
   return 0;
}

</script>
<div class="main">
	<header>
	<div style=" position:absolute; top:190px"><br/>
	<h4>Ingresar Simpatizantes Reporte Masivo</h4>
	
		<div id="crudFormLineal" style="width: 910px; height: auto; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			<h2>Reportes Cargados</h2>
<div class="filtering">
    
        Nombre: <input type="text" name="name" id="name" />
     
        <button type="submit" id="LoadRecordsButton">Buscar</button>
		<button type="button" onclick="cargar()">Cargar_Excel</button>
	<br/><br/>
</div>
	<div id="cargar" style="width: auto;"></div>	
<div id="PeopleTableContainer" style="width: 100%;">
<table width="100%" border="0">
  <tr>
    <td><div id="piechart_3d" style="width: 400px; height:250px;" align="center"></div></td>
    <td><div id="piechart_3d2" style="width: 400px; height:250px;" align="center"></div></td>
  </tr>
</table>
</div>
	<?php 
	
	@$valores=@$_SESSION['graficos_estructura']['Records'];
	$validos=0;
	$INVALIDOS=0;
	$APTOS=0;
	$NOAPTOSVOTAR=0;
	for($i=0; $i<count(@$valores);$i++){
		$validos=$validos+$valores[$i]['VALIDOS'];
		$INVALIDOS=$INVALIDOS+$valores[$i]['INVALIDOS'];
		$APTOS=$APTOS+$valores[$i]['APTOS'];
		$NOAPTOSVOTAR=$NOAPTOSVOTAR+$valores[$i]['NOAPTOS'];
	}
	?>
	<script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
	  google.setOnLoadCallback(drawChart2);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Validos',     <?php echo $validos?>],
          ['Invalidos',    <?php echo $INVALIDOS?>]         
        ]);

        var options = {
          title: 'Total Registros',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
	  function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Aptos Votar',  <?php echo $APTOS?>],
          ['No Aptos Votar', <?php echo $NOAPTOSVOTAR?>]
        ]);

        var options = {
          title: 'Total Registros',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
        chart.draw(data, options);
      }
    </script>
	</script>
						
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Informe Cargas',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'Name ASC',
				actions: {
					listAction: 'cargar.php?action=list'
					//createAction: 'PersonActionsPagedSorted.php?action=create',
					//updateAction: 'PersonActionsPagedSorted.php?action=update',
					//deleteAction: 'PersonActionsPagedSorted.php?action=delete'
				},
				fields: {
					ID: {
						key: true,
						create: false,
						edit: false,
						list: false,
						width: '5%'
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
							var $img = $('<img src="images/note.png" title="Ver Registros" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: studentData.record.NOMBRE,
											actions: {
												listAction: 'ver_registros_cargados.php?id=' + studentData.record.ID,
												caption:"Export to Excel",
												createAction: 'ver_registros_cargados.php?id=' + studentData.record.ID
											},
											fields: {
												ID: {
													key: true,
													create: false,
													edit: false,
													list: false
												},
												Phones: {
													title: '',
													width: '5%',
													sorting: false,
													edit: false,
													create: false,
													display: function (studentData) {
														//Create an image that will be used to open child table
														var $img = $('<img src="images/note.png" title="Ver Registros" />');
														//Open child table when user clicks the image
														$img.click(function () {
															$('#PeopleTableContainer').jtable('openChildTable',
																	$img.closest('tr'),
																	{
																		title: studentData.record.NOMBRE,
																		actions: {
																			listAction: 'ver_registros_cargados.php?idtipo=' + studentData.record.ID,
																			caption:"Export to Excel",
																			createAction: 'ver_registros_cargados.php?idtipo=' + studentData.record.ID
																		},
																		fields: {
																			ID: {
																				key: true,
																				create: false,
																				edit: false,
																				list: false
																			},
																			CEDULA: {
																				title: 'CEDULA',
																				width: '10%',
																				create: false,
																				edit: false
																			},
																			NOMBRES: {
																				title: 'MIEMBROS',
																				width: '30%',
																				create: false,
																				edit: false
																			},
																			TELEFONO: {
																				title: 'TELEFONO',
																				width: '10%',
																				create: false,
																				edit: false
																			},
																			LIDER: {
																				title: 'LIDER',
																				width: '30%',
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
												DETALLE: {
													title: 'CATEGORIAS',
													width: '40%',
													create: false,
													edit: false
												},
												MUERTE: {
													title: 'REGISTROS',
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
					FILES: {
						title: 'FILES',
						width: '30%',
						create: false,
						edit: false
					},
					REGISTRADO: {
						title: 'REGISTRADO',
						width: '10%',
						create: false,
						edit: false
					},
					VALIDOS: {
						title: 'VALIDOS',
						width: '10%',
						//type: 'date',
						create: false,
						edit: false
					},
					INVALIDOS : {
						title: 'INVALIDOS',
						width: '10%',
						//type: 'date',
						create: false,
						edit: false
					},
					APTOS: {
						title: 'APTOS',
						width: '10%',
						//type: 'date',
						create: false,
						edit: false
					},
					NOAPTOS: {
						title: 'NOAPTOS',
						width: '10%',
						//type: 'date',
						create: false,
						edit: false
					}
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