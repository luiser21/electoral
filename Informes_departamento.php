<?php require_once('topadmin.php');?> 
  <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>

<style>

#crudFormLineal label {
	width: 350px;
}
.bg1 {  
	position:relative;
	top:600px;
}
h4{

 color: #006600;
    font-family: 'GothamLight',arial,serif;
    font-size: 28px;
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
			
			<table width="auto" border="0">
  <tr>
    <th width="227" rowspan="7" scope="row"><?php if($_SESSION['foto']!=""){?>
						<img src="<?php echo $_SESSION['foto']?>" width="120" height="154" style="border:3px solid #CCCCCC;">
			<?php }else{ ?>		
				<img src="fotos/images.jpg" width="131" height="150" style="border:3px solid #CCCCCC;">
			<?php } ?>	</th>
    <td width="575"><h4 align="left">Consolidado por Departamentos</h4></td>
  </tr>
  <tr>
    <td>

      <h4 align="left" style="font-size: 18px; color: #999999"><?php echo $_SESSION['nombre']?></h4></td>
  </tr>

    <td><h4 align="left" style="font-size: 18px">Candidato 
	<?php if($_SESSION["tipocandidato"]=='SENADO'){ echo 'Al '.$_SESSION['tipocandidato'].'</h4></td></tr><tr><td><h4 align="left" style="font-size: 18px; color: #999999"> De la República'; 
		}else if($_SESSION["tipocandidato"]=='ALCALDIA' || $_SESSION["tipocandidato"]=='CONSEJO'){ echo 'Al '.$_SESSION['tipocandidato'].'</h4></td>
  </tr>
    <tr><td><h4 align="left" style="font-size: 18px; color: #999999"> Por '.ucwords(strtolower($_SESSION['municipio'])); 
		}else if($_SESSION["tipocandidato"]=='CAMARA' || $_SESSION["tipocandidato"]=='GOBERNACION'){ echo 'A la '.$_SESSION['tipocandidato'].'</h4></td>
  </tr>
    <tr><td><h4 align="left" style="font-size: 18px; color: #999999"> Por '.ucwords(strtolower($_SESSION['departamento'])); }?>

	
		</h4></td></tr>
  <tr>
  <tr>
    <td><h4 align="left" style="font-size: 18px"><?php echo $_SESSION['partido']?> </h4></td>
  </tr>
  <tr>
    <td><h4 align="left" style="font-size: 18px; color: #999999">Tarjeton # <?php echo $_SESSION['ntarjeton']?></h4> </td>
  </tr>
 
</table>
<?php 

$sql="
SELECT SUM(VOTOS) AS TOTAL FROM (SELECT SUM(VOTOS) AS VOTOS   FROM (SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE as DEPARTAMENTO,
					municipios.NOMBRE as MUNICIPIOS,
					p.NOMBRE_PUESTO AS PUESTO,
					COUNT(mesa_puesto_miembro.MIEMBRO) AS VOTOS,
					SUM(mesas.VOTOREAL) AS VOTOSREALES,
					COUNT(MESAS) AS MESAS 
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					INNER JOIN mesas ON mesas.IDPUESTO = p.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID
					INNER JOIN miembros ON miembros.ID = mesa_puesto_miembro.MIEMBRO
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION['username']."'
					GROUP BY p.IDPUESTO
					ORDER BY p.NOMBRE_PUESTO,departamentos.NOMBRE, municipios.NOMBRE) DEPARTAMENTOS
					GROUP BY VOTOS
ORDER BY departamento, municipios) VOTOS";
$DBGestion->ConsultaArray($sql);				
$totales=$DBGestion->datos;	
//imprimir($totales[0]['TOTAL']);

$sql="SELECT DEPARTAMENTO, SUM(VOTOS) AS VOTOS FROM (
					SELECT IDDEPARTAMENTO,DEPARTAMENTO,MUNICIPIOS,COUNT(PUESTO) AS PUESTO ,SUM(VOTOS) AS VOTOS,SUM(VOTOSREALES) AS VOTOSREALES,COUNT(MESAS) AS MESAS   FROM (SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE as DEPARTAMENTO,
					municipios.NOMBRE as MUNICIPIOS,
					p.NOMBRE_PUESTO AS PUESTO,
					COUNT(mesa_puesto_miembro.MIEMBRO) AS VOTOS,
					SUM(mesas.VOTOREAL) AS VOTOSREALES,
					COUNT(MESAS) AS MESAS 
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					INNER JOIN mesas ON mesas.IDPUESTO = p.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID
					INNER JOIN miembros ON miembros.ID = mesa_puesto_miembro.MIEMBRO
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."'
					GROUP BY p.IDPUESTO
					ORDER BY p.NOMBRE_PUESTO,departamentos.NOMBRE, municipios.NOMBRE) DEPARTAMENTOS
					GROUP BY municipios)  CONSULTA 
GROUP BY DEPARTAMENTO
					ORDER BY DEPARTAMENTO ";
$DBGestion->ConsultaArray($sql);				
$departamentos=$DBGestion->datos;	

$arrDepartamento=array();
$i=0;
$arrDepartamento="";
foreach($departamentos as $Depto=>$Val){
$i++;
	if($i<count($departamentos)){
		if($i==5){
			$arrDepartamento.= "{name:'".$Val['DEPARTAMENTO']."',y:".round(($Val['VOTOS']*100)/$totales[0]['TOTAL'], 2).",sliced: true,selected: true },";
		}else{
			$arrDepartamento.= "['".$Val['DEPARTAMENTO']."',".round(($Val['VOTOS']*100)/$totales[0]['TOTAL'], 2)."],";
		}
	}else{
		$arrDepartamento.= "['".$Val['DEPARTAMENTO']."',".round(($Val['VOTOS']*100)/$totales[0]['TOTAL'], 2)."]";
	}
}
?>
						<br/>
							<script type="text/javascript">
$(function () {
    	
    	// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		
		// Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
						//alert(this.percentage);
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
				data:[<?php echo $arrDepartamento?>]
                /*data: [
                    ['Firefox',   45.0],
                    ['IE',       26.8],
                    {
                        name: 'Chrome',
                        y: 12.8,
                        sliced: true,
                        selected: true
                    },
                    ['Safari',    8.5],
                    ['Opera',     6.2],
                    ['Others',   0.7]
                ]*/
            }]
        });
    });
    
		</script>
			<script src="js/js/highcharts.js"></script>
<script src="js/js/modules/exporting.js"></script>

<div id="container" style="min-width: 160px; height: 250px; margin: 0 auto"></div>
			
						<br/>
<div class="filtering">
    <form>
        Municipio: <input type="text" name="name" id="name" />
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
<input id="cmdexport" class="cmdexport" type="button" onclick="window.location='miembros_exportar.php'" value="Exportar" name="cmdexport">

    </form>
</div><p></p>
					<div id="PeopleTableContainer" style="width: auto;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Tabla de Municipios - TOTAL VOTOS: <?php echo $totales[0]['TOTAL']?>',
				paging: true,
				pageSize: 20,
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
																			MESAS: {
																				title: 'MESAS',
																				width: '7%',
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
					MUNICIPIOS: {
						title: 'MUNICIPIOS',
						width: '15%',
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
					MESAS: {
						title: 'MESAS',
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
					},
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
				
				
		  </div></div>
		</header>	
		
	 </div>
<?php //require_once('bottom.php'); ?>		