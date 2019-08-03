<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
	require_once('topadmin.php');?> 
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
    <h4 align="left"><h4 align="left">Consolidado por Lideres</h4></td>
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
  <td><h4 align="left" style="font-size: 14px; color: #999999"><?php echo ucwords(strtolower($_SESSION['municipio']))?> - <?php echo ucwords(strtolower($_SESSION['departamento']))?></h4></td></tr>
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
	
	<?php 
		$sql="select SUM(MIEMBROS) AS MIEMBROS from (select (SELECT count(*)AS miembros FROM miembros_2010 m WHERE lider.codigo  = m.lider) as MIEMBROS 
			  FROM lider_2010 lider
			  INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
		 	  INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
			  where usuario_2010.usuario='".$_SESSION["username"]."') as CANTIDADMIEMBROS  ";
			 $DBGestion->ConsultaArray($sql);				
			$totales=$DBGestion->datos;
			$row=array();		
			for($i=0; $i<count($totales);$i++){
				$row[$i]['MIEMBROS']=$totales[$i]['MIEMBROS'];
			}	
			$miembros=$row[0]['MIEMBROS'];
			//imprimir($miembros);
			// $DBGestion->close();
	?>
</div>	<br/>	
					<div id="PeopleTableContainer" style="width: auto;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Tabla de Lideres   <?php echo ' - Total de Simpatizantes: '.$miembros.' Miembros'?>',
				paging: true,
				pageSize: 20,
				sorting: true,
				defaultSorting: 'Name ASC',
				actions: {
					listAction: 'PersonActionsPagedSorted_lideres.php?action=list',
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
							var $img = $('<img src="images/note.png" title="Ver Miembros x Lider" />');
							//Open child table when user clicks the image
							$img.click(function () {
								$('#PeopleTableContainer').jtable('openChildTable',
										$img.closest('tr'),
										{
											title: 'SIMPATIZANTES DEL LIDER '+studentData.record.NOMBRE,
											actions: {
												listAction: 'ver_miembros_lider.php?idlider=' + studentData.record.ID,
												caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
												createAction: 'ver_miembros_lider_excel.php?idlider=' + studentData.record.ID
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
													width: '30%',
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
													width: '25%',
													//type: 'date',
													create: false,
													edit: false
												},
												MESA: {
													title: 'MESA',
													width: '5%',
													//type: 'date',
													create: false,
													edit: false
												},
												LIDER : {
													title: 'LIDER',
													width: '30%',
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
					PROFESION: {
						title: 'PROFESION',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},
					MUNICIPIO: {
						title: 'DOMICILIO',
						width: '30%',
						//type: 'date',
						create: false,
						edit: false
					},/*
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
						title: 'MIEMBROS',
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