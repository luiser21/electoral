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
		
	$sql="SELECT SUM(TOTAL) AS TOTAL FROM (SELECT
					count(miembros.ID) as TOTAL
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
				$sql.=" GROUP BY p.IDPUESTO) AS TABLA";
				//echo $sql;exit;
	 $sql2="SELECT
				capitanes.IDCAPITAN,
				NOMBRE_CAPITAN NOMBRE				
				FROM
				lideres
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO				
				INNER JOIN capitanes ON capitanes.IDCAPITAN=lideres.IDCAPITAN
			  where usuario.usuario='".$_SESSION["username"]."'
				group by IDCAPITAN
ORDER BY 2  ";
			
			
			$DBGestion->ConsultaArray($sql2);				
			$lideres=$DBGestion->datos;
	
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
<script  type="text/javascript">
function redireccionar() {
	
	var cedula = document.getElementById('idlider').value;
	document.location = 'ver_mesas_miembros_informe_lideres_excel.php?idlider='+cedula ;
	
}
</script>
<div class="filtering">
    <form>
        Nombre: <input type="text" name="name" id="name" />  <button type="submit" id="LoadRecordsButton">Buscar</button>
       ExportExcel:
        <select id="idlider" name="idlider" onchange="redireccionar();">
            <option selected="selected" value="0">Capitanes Export</option>
			<? for($i=0; $i<count($lideres);$i++){
				
				 ?>
            <option value="<? echo $lideres[$i]['IDCAPITAN'] ?>"><? ECHO $lideres[$i]['NOMBRE'] ?></option>
            <? } ?>
        </select>
      

    </form>
</div><p></p>
					<div id="PeopleTableContainer" style="width: auto;"></div>
	<script type="text/javascript">
		
		
	
		$(document).ready(function () {
			
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: "Tabla de Lideres - Total Simpatizantes: <?php echo ($totales[0]['TOTAL']>0)?$totales[0]['TOTAL']:'0'?>",
				paging: true,
				pageSize: 20,
				sorting: false,
				
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
						sorting: true,
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
											paging: true,
											pageSize: 20,
											sorting: true,
											defaultSorting: 'Name ASC',
											actions: {
												listAction: 'ver_mesas_miembros_informe_lideres.php?idlider=' + studentData.record.ID
												//caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
												//createAction: 'ver_mesas_miembros_informe_lideres_excel.php?idlider=' + studentData.record.ID
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
					CAPITAN: {
						title: 'CAPITAN',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},
					NOMBRE: {
						title: 'NOMBRE',
						width: '30%',
						create: false,
						edit: false
					},
					CEDULA: {
						title: 'CEDULA',
						width: '20%',
						create: false,
						edit: false
					},
					/*
					MUNICIPIO: {
						title: 'DOMICILIO',
						width: '40%',
						//type: 'date',
						create: false,
						edit: false
					},
					NOMBRE_PUESTO: {
						title: '# PUESTOS VOTACION',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},
					MESA: {
						title: 'MESAS',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},*/
					MIEMBROS : {
						title: 'SIMPATIZANTES',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},
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