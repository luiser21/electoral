<?php require_once('topadmin.php');?> 
<link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>

<style>
#logo6 {  position:absolute; float: left; margin-left: 375px; top:258px;z-index: 1; background:url(<?php echo $_SESSION["logo2"]?>) 0px 0px no-repeat;width:500px;height:90px}

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
      <h4 align="left">Consolidado por Departamentos</h4></td>
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
		echo 'a la '.$_SESSION['tipocandidato'].' de ';	
	}elseif($_SESSION['tipocandidato']=='CONSEJO'){
		echo 'al '.$_SESSION['tipocandidato'].' de ';	
	}elseif($_SESSION['tipocandidato']=='SENADO'){
		echo 'al '.$_SESSION['tipocandidato'].' de la Rep&uacute;blica';	
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
		echo ucwords(strtolower($_SESSION['municipio'])).' - '.ucwords(strtolower($_SESSION['departamento'])); 
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
    <td><h4 align="left" style="font-size: 14px; color: #999999">Tarjeton # <?php echo $_SESSION['ntarjeton']?></h4> </td>
  </tr>
 
</table>

						<br/>
<div class="filtering">
    <form>
        Departamento: <input type="text" name="name" id="name" />
     
        <button type="submit" id="LoadRecordsButton" accesskey="1">Buscar</button>
<input id="cmdexport" class="cmdexport" type="button" onclick="window.location='miembros_exportar.php'" value="Exportar" name="cmdexport">

    </form>
</div>
<style>
#loadImg{position:absolute;z-index:999;}
#loadImg div{display:table-cell;width:auto;height:auto;background:#fff;text-align:center;vertical-align:middle;}
</style>
<div id="loadImg"><div><img src="images/cargando-es.gif" width="350" height="120" /></div></div>
<iframe border=0 name=iframe src="mapas2.php" width="850" height="420" scrolling="no" noresize frameborder="0" onload="document.getElementById('loadImg').style.display='none';" align="center"></iframe>
<p></p>
					<div id="PeopleTableContainer" style="width: auto;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Tabla por Departamentos',
				paging: true,
				pageSize: 50,
				sorting: true,
				defaultSorting: 'Name ASC',
				actions: {
					listAction: 'PersonActionsPagedSorted_Informe_departamento.php?action=list'
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
						width: '2%',
						sorting: false,
						edit: false,
						create: false,
						display: function (studentData) {
							//Create an image that will be used to open child table
							var $img = $('<img src="images/note.png" title="Detallado por Puesto de Votacion" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: studentData.record.DEPARTAMENTO,
											paging: true,
											pageSize: 20,
											sorting: true,
											defaultSorting: 'Name ASC',
											actions: {
												listAction: 'ver_departamento_por_puesto.php?departamento=' + studentData.record.ID,
												caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
												createAction: 'ver_departamento_por_puesto_excel.php?departamento=' + studentData.record.ID
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
														var $img = $('<img src="images/note.png" title="Ver Puestos por Departamento" />');
														//Open child table when user clicks the image
														$img.click(function () {
															$('#PeopleTableContainer').jtable('openChildTable',
																	$img.closest('tr'),
																	{
																		title: studentData.record.MUNICIPIOS,
																		actions: {
																			listAction: 'ver_puestos_deptarmaentos.php?idmunicipio=' + studentData.record.ID,
																			caption:"Export to Excel",
																			//deleteAction: '/Demo/DeletePhone',
																			//updateAction: '/Demo/UpdatePhone',
																			createAction:'ver_puestos_deptarmaentos_excel.php?idmunicipio=' + studentData.record.ID
																		},
																		fields: {
																			ID: {
																				type: 'hidden',
																				defaultValue: studentData.record.ID
																			},
																			IDPUESTO: {
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
																					var $img = $('<img src="images/note.png" title="Ver Puestos por Departamento" />');
																					//Open child table when user clicks the image
																					$img.click(function () {
																						$('#PeopleTableContainer').jtable('openChildTable',
																								$img.closest('tr'),
																								{
																									title: studentData.record.PUESTO,
																									actions: {
																										listAction: 'ver_mesas_departamento.php?idpuesto=' + studentData.record.IDPUESTO,
																										caption:"Export to Excel",
																										//deleteAction: '/Demo/DeletePhone',
																										//updateAction: '/Demo/UpdatePhone',
																										createAction:'ver_mesas_departamento_excel.php?idpuesto=' + studentData.record.IDPUESTO
																									},
																									fields: {
																										ID: {
																											type: 'hidden',
																											defaultValue: studentData.record.ID
																										},
																										CODIGO: {
																											key: true,
																											create: false,
																											edit: false,
																											list: false
																										},
																										MESAS: {
																											title: 'MESAS',
																											width: '7%',
																											create: false,
																											edit: false
																										},
																										VOTOSPREVISTOS: {
																											title: 'VOTOSPREVISTOS',
																											width: '6%',
																											create: false,
																											edit: false
																										},
																										VOTOREAL: {
																											title: 'VOTOREAL',
																											width: '6%',
																											create: false,
																											edit: false
																										},
																										VARIACION: {
																											title: 'VARIACION',
																											width: '6%',
																											create: false,
																											edit: false
																										},
																										SIMPATIZANTES: {
																											title: 'SIMPATIZANTES',
																											width: '26%',
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
																			PUESTO: {
																				title: 'PUESTO',
																				width: '37%',
																				create: false,
																				edit: false
																			},
																			VOTOS: {
																				title: 'VOTOS',
																				width: '6%',
																				create: false,
																				edit: false
																			},
																			VOTOSREALES: {
																				title: 'VOTOSREALES',
																				width: '6%',
																				create: false,
																				edit: false
																			},
																			VARIACION: {
																				title: 'VARIACION',
																				width: '6%',
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
												MUNICIPIOS: {
													title: 'MUNICIPIOS',
													width: '30%',
													create: false,
													edit: false
												},
												PUESTO: {
													title: 'PUESTO',
													width: '25%',
													create: false,
													edit: false
												},
												MESAS: {
													title: 'MESAS',
													width: '25%',
													//type: 'date',
													create: false,
													edit: false
												},
												VOTOS: {
													title: 'VOTOS',
													width: '5%',
													//type: 'date',
													create: false,
													edit: false
												},
												VOTOSREALES : {
													title: 'VOTOSREALES',
													width: '5%',
													//type: 'date',
													create: false,
													edit: false
												},
												VARIACION: {
													title: 'VARIACION',
													width: '5%',
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
					DEPARTAMENTO: {
						title: 'DEPARTAMENTO',
						width: '35%',
						//type: 'date',
						create: false,
						edit: false
					},						
					PUESTOS: {
						title: 'PUESTOS',
						width: '6%',
						//type: 'date',
						create: false,
						edit: false
					},					
					VOTOS: {
						title: 'VOTOS',
						width: '6%',
						//type: 'date',
						create: false,
						edit: false
					}/*,
					VOTOSREALES : {
						title: 'VOTOSREALES',
						width: '6%',
						//type: 'date',
						create: false,
						edit: false
					},
					VARIACION : {
						title: 'VARIACION',
						width: '5%',
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