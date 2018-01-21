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
      <h4 align="left">Puesto de Votaci&oacute;n que Requieren Coordinador</h4></td>
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

    </form>
</div>
<div style="position:absolute; left: 588px; top: 150px;">
<table width="350" border="1" align="center">
  <tr align="center">
    <th scope="col">PUESTOS </th>
    <th scope="col">MESAS </th>
	 <th scope="col">VOTOS_PRE </th>
	  <th scope="col">VOTOS_REAL </th>
  </tr>
  <?php 
  //imprimir($_SESSION);
  $sql="";
if($_SESSION["username"]!='alcaldia'){	
	$sql="SELECT count(ID) as PUESTOS, SUM(MESAS) AS MESAS, SUM(VOTOSPREV) AS VOTOSPREV, SUM(VOTOSREALES) AS VOTOSREALES FROM (SELECT
					p.IDPUESTO AS ID,
					p.MESAS AS MESAS,
					COUNT(miembros.ID) as VOTOSPREV,
					(SELECT
				SUM(mesas.votoreal) AS VOTOSREALES
				FROM
				puestos_votacion
				INNER JOIN mesas ON mesas.IDPUESTO = puestos_votacion.IDPUESTO
				where 
				puestos_votacion.IDPUESTO=p.IDPUESTO
				GROUP BY puestos_votacion.IDPUESTO
				) AS VOTOSREALES
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					LEFT JOIN miembros ON miembros.IDPUESTOSVOTACION = p.IDPUESTO
					left JOIN lideres ON lideres.ID = miembros.IDLIDER
					left JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					LEFT JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."' ";
				if($_SESSION["tipocandidato"]=="ALCALDIA"){
					$sql.=" and municipios.NOMBRE='".$_SESSION["municipio"]."' ";
				}					
				$sql.=" GROUP BY p.IDPUESTO HAVING COUNT(miembros.id)>=60) AS TABLA";

}else{

  $sql="SELECT
				count(p.codigo) as PUESTOS,
				SUM(p.mesas) AS MESAS,
				SUM((SELECT
				count(miembros_2010.codigo) as VOTOS
				FROM
				miembros_2010
				INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
				INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
				INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.codigo=p.codigo)) as VOTOSPREV,
				SUM((SELECT
				SUM(mesas_2010.votoreal) AS VOTOSREALES
				FROM
				puesto_2010
				INNER JOIN mesas_2010 ON mesas_2010.puesto = puesto_2010.codigo
				where puesto_2010.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."') and puesto_2010.codigo=p.codigo
				GROUP BY puesto_2010.codigo
				)) AS VOTOSREALES				
				FROM
				puesto_2010 p
				where p.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."') 
			";
	}
	$DBGestion->ConsultaArray($sql);				
$datos=$DBGestion->datos;	


  ?>
  
  <tr align="center">
    <td style="font-size:22px"><img src="images/voting-box-hi.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['PUESTOS']?></strong></td>
    <td style="font-size:22px"><img src="images/voting-box-hi.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['MESAS']?></strong></td>
	 <td style="font-size:22px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['VOTOSPREV']?></strong></td>
 <td style="font-size:22px"><img src="images/votaciones.png" width="25" height="25" /><strong><?php echo '    '.@$datos[0]['VOTOSREALES']?></strong></td>

 </tr>
</table></div>
<p></p>
<div id="PeopleTableContainer" style="width: auto;"><?php 
	@$valores=@$_SESSION['graficos']['Records'];
	$conta='';
	for($i=0; $i<count(@$valores);$i++){
		if($i<8 && @$valores[$i]['VOTOSPREV']>=10){
			$conta.="['".@$valores[$i]['NOMBRE']."', ".@$valores[$i]['VOTOSPREV']."],";			
		}if($i==8 && @$valores[$i]['VOTOSPREV']>=10){
			$conta.="['".@$valores[$i]['NOMBRE']."', ".@$valores[$i]['VOTOSPREV']."]";			
		}
	}
	//imprimir($conta);
	//imprimir($_SESSION['graficos']['Records']);
	?>
	
	<script type="text/javascript">

		$(document).ready(function () {
		
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Informe por Puestos de Votacion',
				paging: true,
				pageSize: 20,
				sorting: false,
				
				actions: {
					listAction: 'PersonActionsPagedSorted_Informe_mesas_reqcoordinador.php?action=list'
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
							var $img = $('<img src="images/note.png" title="Ver Mesas por Miembros" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: studentData.record.NOMBRE,
											actions: {
												listAction: 'ver_mesas_miembros.php?idpuesto=' + studentData.record.ID,
												caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
												createAction: 'ver_mesas_miembros_excel.php?idpuesto=' + studentData.record.ID
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
													title: 'VOTOS PREVISTOS',
													width: '12%',
													create: false,
													edit: false
												},
												VOTOREAL: {
													title: 'VOTOS REALES',
													width: '10%',
													create: false,
													edit: false
												},
												VARIACION: {
													title: 'VARIACION',
													width: '5%',
													create: false,
													edit: false
												},
												SIMPATIZANTES: {
													title: 'SIMPATIZANTES',
													width: '40%',
													create: false,
													edit: false
												},
												Phone: {
													title: '',
													width: '2%',
													sorting: false,
													edit: false,
													create: false,
													display: function (studentData) {
														//Create an image that will be used to open child table
														var $img = $('<img src="images/note.png" title="Ver Lideres por Miembros" />');
														//Open child table when user clicks the image
														$img.click(function () {
															$('#PeopleTableContainer').jtable('openChildTable',
																	$img.closest('tr'),
																	{
																		title: studentData.record.MESAS,
																		actions: {
																			listAction: 'ver_mesas_miembros_lideres.php?idmesa=' + studentData.record.CODIGO,
																			caption:"Export to Excel",
																			//deleteAction: '/Demo/DeletePhone',
																			//updateAction: '/Demo/UpdatePhone',
																			createAction: 'ver_mesas_miembros_lideres_excel.php?idmesa=' + studentData.record.CODIGO
																		},
																		fields: {
																			ID: {
																				type: 'hidden',
																				defaultValue: studentData.record.CODIGO
																			},
																			CODIGO: {
																				key: true,
																				create: false,
																				edit: false,
																				list: false
																			},
																			LIDER: {
																				title: 'LIDER',
																				width: '25%',
																				create: false,
																				edit: false
																			},
																			TELEFONO: {
																				title: 'TELEFONO',
																				width: '10%',
																				create: false,
																				edit: false
																			},
																			SIMPATIZANTES: {
																				title: 'SIMPATIZANTES',
																				width: '25%',
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
										}, function (data) { //opened handler
											data.childTable.jtable('load');
										});
							});
							//Return image to show on the person row
							return $img;
						}
					},
					NOMBRE: {
						title: 'PUESTO DE VOTACION',
						width: '30%',
						create: false,
						edit: false
					},
					MUNICIPIO: {
						title: 'MUNICIPIO',
						width: '25%',
						create: false,
						edit: false
					},
					DEPARTAMENTO: {
						title: 'DEPARTAMENTO',
						width: '25%',
						//type: 'date',
						create: false,
						edit: false
					},
					VOTOSPREV : {
						title: 'VOTO_PRE',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},
					MESAS: {
						title: 'MESAS',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},		
					VOTOSREALES: {
						title: 'VOTO_REAL',
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