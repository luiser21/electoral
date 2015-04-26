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
	<h4>Ingresar Simpatizantes Masivo</h4>
	
		<div id="crudFormLineal" style="width: 910px; height: auto; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			<h2>Archivos Cargados</h2>
<div class="filtering">
    
        Nombre: <input type="text" name="name" id="name" />
     
        <button type="submit" id="LoadRecordsButton">Buscar</button>
		<button type="button" onclick="cargar()">Cargar_Excel</button>
	<br/><br/>
</div>
	<div id="cargar" style="width: auto;"></div>	
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
			
		  </div>
		
<?php require_once('bottom.php'); ?>	</div>		
		</header>
	 </div>