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
      <h4 align="left">Consolidado por Departamento</h4></td>
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
<div id="loadImg" align="center"><div><img src="images/cargando-es.gif" width="150" height="60" /></div></div>
<iframe border=0 name=iframe src="resultados2018/resultados/99SE/BXXXX/DSE25999.php" width="650" height="420" scrolling="no" noresize frameborder="0" onload="document.getElementById('loadImg').style.display='none';" align="center" style="margin-left:100px;"></iframe>
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
					listAction: 'PersonActionsPagedSorted_Informe_departamento_gerente.php?action=list'
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
											pageSize: 30,
											sorting: true,
											defaultSorting: 'Name ASC',
											actions: {
												listAction: 'ver_departamento_por_puesto_gerente.php?departamento=' + studentData.record.ID
												//caption:"Export to Excel",
												//deleteAction: '/Demo/DeletePhone',
												//updateAction: '/Demo/UpdatePhone',
											},
											fields: {
												ID: {
													key: true,
													create: false,
													edit: false,
													list: false
												},
												MUNICIPIO: {
													title: 'MUNICIPIOS',
													width: '30%',
													create: false,
													edit: false
												},
												C21: {
													title: 'C21',
													width: '6%',
													//type: 'date',
													create: false,
													edit: false
												},
												U6: {
													title: 'U6',
													width: '6%',
													//type: 'date',
													create: false,
													edit: false
												},
												U24 : {
													title: 'U24',
													width: '6%',
													//type: 'date',
													create: false,
													edit: false
												},
												TOTAL: {
													title: 'TOTAL',
													width: '6%',
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
					C21: {
						title: 'C21',
						width: '6%',
						//type: 'date',
						create: false,
						edit: false
					},					
					U6: {
						title: 'U6',
						width: '6%',
						//type: 'date',
						create: false,
						edit: false
					},
					U24 : {
						title: 'U24',
						width: '6%',
						//type: 'date',
						create: false,
						edit: false
					},
					TOTAL : {
						title: 'TOTAL',
						width: '6%',
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