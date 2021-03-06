<?php require_once('topadmin.php');

?>
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
		<input id="cmdexport" class="cmdexport" type="button" onclick="window.location='estructura_excel.php'" value="Exportar" name="cmdexport">
	<br/><br/>
</div>
	<div id="cargar" style="width: auto;"></div>	
<div id="PeopleTableContainer" style="width: 100%;">
<table width="100%" border="0">
  <tr>
    <td><div id="piechart_3d" style="width: 400px; height:250px;margin-left:-20px;" align="center"></div></td>
    <td><div id="piechart_3d2" style="width: 630px; height:250px;margin-left:-80px;" align="center"></div></td>
  </tr>
</table>
</div>
	<?php 
	@$valores=@$_SESSION['graficos_estructura']['Records'];
//imprimir($valores);
	$VALIDOS=0;
	$INVALIDOS=0;
	$APTOS=0;
	$NOAPTOSVOTAR=0;
	$DIFERENTE=0;
	$REGISTROS=0;
	$PENDIENTE=0;
	$MUERTE=0;
	$BAJA=0;
	$DEBEINSCRIBIRSE=0;
	$DUPLICADO=0;
	$REPROCESAR=0;
	$TRASHUMANCIA=0;
	$INCORRECTO=0;
	$INDEFINIDO=0;
	$DOBLECEDULACION=0;
	$VIGENTE=0;
	$INHUMACION=0;
	$CONEXION=0;
	for($i=0; $i<count(@$valores);$i++){
		$VALIDOS=$VALIDOS+$valores[$i]['VALIDOS'];
		$DIFERENTE=$DIFERENTE+$valores[$i]['DIFERENTEMUNICIPIO'];
		$INVALIDOS=$INVALIDOS+$valores[$i]['INVALIDOS'];
		$REGISTROS=$REGISTROS+$valores[$i]['REGISTROS'];
		$APTOS=round($APTOS+$valores[$i]['APTOS'],0);
		$NOAPTOSVOTAR=$NOAPTOSVOTAR+$valores[$i]['NOAPTOS'];
		$DEBEINSCRIBIRSE=$DEBEINSCRIBIRSE+$valores[$i]['DEBEINSCRIBIRSE'];
		$BAJA=$BAJA+$valores[$i]['BAJA'];
		$MUERTE=$MUERTE+$valores[$i]['MUERTE'];
		$PENDIENTE=$PENDIENTE+$valores[$i]['PENDIENTE'];		
		$REPROCESAR=$REPROCESAR+$valores[$i]['REPROCESAR'];
		$DUPLICADO=$DUPLICADO+$valores[$i]['DUPLICADO'];
		$TRASHUMANCIA=$TRASHUMANCIA+$valores[$i]['TRASHUMANCIA'];
		$INCORRECTO=$INCORRECTO+$valores[$i]['INCORRECTO'];
		$INDEFINIDO=$INDEFINIDO+$valores[$i]['INDEFINIDO'];
		$DOBLECEDULACION=$DOBLECEDULACION+$valores[$i]['DOBLECEDULACION'];
		$VIGENTE=$VIGENTE+$valores[$i]['VIGENTE'];
		$INHUMACION=$INHUMACION+$valores[$i]['INHUMACION'];
		$CONEXION=$CONEXION+$valores[$i]['CONEXION'];
				
	}
	?>
	<script type="text/javascript">
	  google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
	  google.setOnLoadCallback(drawChart);
	
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Votos para Candidato',     <?php echo $VALIDOS?>],
          ['No validos para Candidato',    <?php echo ($NOAPTOSVOTAR+$DIFERENTE)?>]         
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
          ['Inscritos Municipo',  <?php echo round($VALIDOS)?>],
          ['No Inscritos Municipio', <?php echo round($DIFERENTE)?>],
          ['Pendiente por Solicitud en proceso', <?php echo round($PENDIENTE)?>],
          ['Baja Perdida-Suspension Derechos Politicos', <?php echo round($BAJA)?>],
          ['Cancelada por Muerte', <?php echo round($MUERTE)?>],
          ['No encontrado Censo Electoral', <?php echo round($DEBEINSCRIBIRSE)?>],
          ['Registros Duplicados', <?php echo round($DUPLICADO)?>],
		  ['Baja por Trashumancia', <?php echo round($TRASHUMANCIA)?>],
		  ['Numero de documento Incorrecto', <?php echo round($INCORRECTO)?>],
		  ['Indefinido', <?php echo round($INDEFINIDO)?>],
		  ['Cancelada por Doble Cedulacion', <?php echo round($DOBLECEDULACION)?>],
		  ['Vigente', <?php echo round($VIGENTE)?>],
		  ['Baja por Inhumacion o Necrodactilia Positiva', <?php echo round($INHUMACION)?>],
		  ['Error de Conexion', <?php echo round($CONEXION)?>],
          ['Reprocesar Registros', <?php echo round($REPROCESAR)?>]
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
						display: function (studentData2) {
							//Create an image that will be used to open child table
							var $img = $('<img src="images/note.png" title="Ver Registros" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: 'Cargas Masivas',
											actions: {
												listAction: 'ver_registros_cargados.php?id=' + studentData2.record.ID,
												caption:"Export to Excel",
												createAction: 'ver_registros_cargados.php?id=' + studentData2.record.ID
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
																		title: 'Ver Miembros',
																		paging: true,
																		pageSize: 10,
																		sorting: true,
																		defaultSorting: 'Name ASC',	
																		actions: {
																			listAction: 'ver_registros_cargados.php?idfile='+studentData2.record.ID+'&miembrosver=1&idtipo=' + studentData.record.ID,
																			caption:"Export to Excel",
																			createAction: 'ver_registros_cargados.php?ver_registros_cargados.php?idfile='+studentData2.record.ID+'&miembrosver=1&idtipo=' + studentData.record.ID
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
																				title: 'NOMBRES',
																				width: '30%',
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
												},
												PORCENTAJE: {
													title: 'PORCENTAJE',
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
					REGISTROS: {
						title: 'REGISTROS',
						width: '10%',
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
					VALIDOS: {
						title: 'VALIDOS',
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
					},
					INVALIDOS : {
						title: 'INVALIDOS',
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