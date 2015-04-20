
<?php require_once('topadmin.php');?>
 <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
<style>
.bg1 {  
	position:relative;
	top:650px;
}
</style>
<script type="text/javascript">
	
function municipios(){
	var pagina= "Ajax_municipio.php";
	var capa = "capa_documentos";
	var departamento = document.getElementById('departamento').value;
	var valores = 'departamento=' + departamento + '&' + Math.random();
	if(departamento!=''){ 			
	    FAjax (pagina,capa,valores,'POST',true)     	 
	}
}
function municipiospuestos(){
	var pagina= "Ajax_municipio.php";
	var capa = "capa_documentos_municipio";
	var departamento = document.getElementById('departamento_puestos').value;
	var valores = 'valor=1&departamento=' + departamento + '&' + Math.random();
	if(departamento!=''){ 			
	    FAjax (pagina,capa,valores,'POST',true)     	 
	}
}
function puesto(){
	var pagina= "Ajax_puestos_votacion.php";
	var capa = "capa_puestos";
	var municipio = document.getElementById('municipios_puestos').value;
	var valores = 'municipio=' + municipio + '&' + Math.random();
	if(municipio!=''){ 			
	    FAjax (pagina,capa,valores,'POST',true)     	 
	}
}
function edad(){
	var pagina= "Ajax_edad.php";
	var capa = "capa_edad";
	var fecha = $('#inputField').val();	
	fecha = $('#inputField').val();	
	var valores = 'fecha=' + fecha + '&' + Math.random();
	if(fecha!=''){ 			
	    FAjax (pagina,capa,valores,'POST',true)     	 
	}
}

function mesa(){
	var pagina= "Ajax_mesa_votacion.php";
	var capa = "capa_mesas";
	var puesto = document.getElementById('puestos').value;
	var valores = 'puesto=' + puesto + '&' + Math.random();
	if(puesto!=''){ 			
	    FAjax (pagina,capa,valores,'POST',true)     	 
	}
}
</script>
<div class="main">
	<header>
	<div style=" position:absolute; top:190px"><br/>
	<h4>Ingresar Simpatizantes Masivo</h4>
	
		<div id="crudFormLineal" style="width: 910px; height: 510px; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			<h2>Archivos Cargados</h2><br/>
			<br/>
<div class="filtering">
    <form>
        Nombre: <input type="text" name="name" id="name" />
     
        <button type="submit" id="LoadRecordsButton">Buscar</button>
		<button type="submit" id="LoadRecordsButton">Cargar Excel</button>
		
    </form>
	<p></p>
</div>
	<div id="PeopleTableContainer" style="width: auto;"></div>						
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Informe Cargas',
				paging: true,
				pageSize: 20,
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
						list: false
					},
						 //CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
					FILES: {
						title: 'FILES',
						width: '40%',
						create: false,
						edit: false
					},
					TRANSFER: {
						title: 'TRANSFER',
						width: '5%',
						create: false,
						edit: false
					},
					INVALIDAR: {
						title: 'INVALIDAR',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},
					VALIDOS: {
						title: 'VALIDOS',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},
					INVALIDOS : {
						title: 'INVALIDOS',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},
					APTOS: {
						title: 'APTOS',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},
					NOAPTOS: {
						title: 'NOAPTOS',
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
<div>
<?php require_once('bottom.php'); ?>	
</div>