<?php require_once('topadmin.php');

$add = (isset($_GET['add']) ? $_GET['add'] : 0); ;
if($add == 1){
	
    @$nombre=(isset($_POST['nombre']) ? $_POST['nombre'] : 'NULL');
    @$cedula=(isset($_POST['cedula']) ? $_POST['cedula'] : 'NULL');
    @$departamento=(isset($_POST['departamento']) ?  : 'NULL');
    @$celular=(isset($_POST['celular']) ? $_POST['celular'] : 'NULL');
  //  $fecha=(isset($_POST['fecha']) ? $_POST['fecha'] : 'NULL');

    @$departamento_puestos=(isset($_POST['departamento_puestos']) ? $_POST['departamento_puestos'] : 'NULL');
	@$puestos=(isset($_POST['puestos']) ? $_POST['puestos'] : 'NULL');
   
   // @$apellido=(isset($_POST['apellido']) ? $_POST['apellido'] : 'NULL');
    //@$direccion=(isset($_POST['direccion']) ? $_POST['direccion'] : 'NULL');
    @$municipio=(isset($_POST['municipio']) ? $_POST['municipio'] : 'NULL');
    @$email=(isset($_POST['email']) ? $_POST['email'] : 'NULL');
   
    @$municipios_puestos=(isset($_POST['municipios_puestos']) ? $_POST['municipios_puestos'] : 'NULL');
    @$mesas=(isset($_POST['mesas']) ? $_POST['mesas'] : 'NULL');
	
	 @$idlider=(isset($_POST['lider']) ? $_POST['lider'] : 'NULL');
	 @$ocupacion=(isset($_POST['ocupacion']) ? $_POST['ocupacion'] : 'NULL');
	
	//Consultar si ya existe el  simpatizante en otro lider
	$sql="SELECT * FROM MIEMBROS WHERE CEDULA";
	
	$sql="INSERT INTO MIEMBROS (NOMBRES CEDULA, MUNICIPIO, TELEFONO, EMAIL, IDPUESTOSVOTACION, IDLIDER, OCUPACION) VALUES ('".strtoupper(trim($nombre))."',".trim($cedula).",".$municipio.",".trim($celular).",'".trim($email)."',".$puestos.",'".$idlider."','".$ocupacion."')";	
	
	$DBGestion->Consulta($sql);
	
	$rs = mysql_query("SELECT @@identity AS id");
	if ($row = mysql_fetch_row($rs)) {
		$idmiembro = trim($row[0]);
	}
	
	$sql="INSERT INTO MESA_PUESTO_MIEMBRO (IDMESA, MIEMBRO) VALUES (".$mesas.",".$idmiembro.")";	
	$DBGestion->Consulta($sql);
	
	 ?>
       	 <script language="javascript">
	       	 alert("Se ingreso el Simpatizante exitosamente"); 
	       	 window.location="miembros.php";
       	 </script>
	   <?php	
	
}
?>
<style>
.bg1 {  
	position:relative;
	top:650px;
}
</style>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%d-%m-%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
function municipios(){
	var pagina= "Ajax_municipio.php";
	var capa = "capa_documentos";
	var departamento = document.getElementById('departamento').value;
	var valores = 'departamento=' + departamento + '&' + Math.random();
	if(departamento!=''){ 			
	    FAjax (pagina,capa,valores,'POST',true)     	 
	}
}
function puesto_votacion(){
	var pagina= "Ajax_puestos.php";
	var capa = "capa_documentos_municipio";
	var cedula = document.getElementById('cedula').value;
	var valores = 'cedula=' + cedula + '&' + Math.random();
	if(cedula!=''){ 			
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


</script>
<div class="main">
	<header>
	<form name="form2" method="post"  class="formular" action="miembros_add.php?add=1"  id="form2">
	<div style=" position:absolute; top:190px"><br/>
	<h4>Ingresar Simpatizantes</h4>
	
		<div id="crudFormLineal" style="width: 910px; height: 520px; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			<h2>Informaci&oacute;n de Contacto</h2><br/>
			<div  style="width: 510px; height: 220px; background-color:#FFFFFF" >
			<ol>
				<li>
				 </li>
				 <li>
				 </li>
				<li>
					<label for="nombres">
						<span class="textRequired"> * </span>
							Nombres
					</label>
						<input id="nombre" type="text" value="" name="nombre" class="validate[required]">
				</li>
				<li>
					<label for="cedula">
						<span class="textRequired"> * </span>
							Cedula
					</label>
						<input id="cedula" type="text" value="" name="cedula"  class="validate[required,custom[integer]] " style="width: 150px;">&nbsp;&nbsp;&nbsp;<a  class='iframe' href="#"  onclick="puesto_votacion()"><span style=" font-size:11px;">Donde Votar??<img src="images/padrones-2013-donde-votar.png" id="inputField"  style="cursor:pointer" width="40px" height="31px"></span></a>
				</li>
				
				
				<li>
					<label for="celular">
						<span class="textRequired"> * </span>
						Telefono / Celular
					</label>
						<input id="celular" type="text" name="celular" class="validate[required,custom[integer],maxSize[10]] ">
				</li>	
				
			<div id='capa_documentos_municipio'>
					<h2>Puesto de Votacion</h2>
			
				
		</div>
				
			</ol>
			</div>
			
				<div  style="background-color: #FFFFFF;
  
    float: right;
    height: 280px;  
    margin-left: 487px;  
    position: absolute;
    top:165px;
    width: 400px;" >
			<ol>
				<li>
				 </li>
				 <li>
				 </li>				
				
				<li>
					<label for="email" style="width: 100px;">
						<span class="textRequired"> * </span>
						Email
					</label>
						<input id="email" type="text" name="email" class="validate[required,custom[email]]">
				</li>
			
				 <li>
					<label for="email" style="width: 100px;">						
						Ocupacion
					</label>
						<input id="ocupacion" type="text" name="ocupacion" >
				</li>
				<li>
					<label for="lider" style="width: 100px;">
						<span class="textRequired"> * </span>
						Lider
					</label>
						<select name="lider" id="lider"  class="validate[required]">
                        	<?php 
				$sql="SELECT ID, CONCAT(NOMBRES,' ',APELLIDOS) AS NOMBRES FROM LIDERES WHERE IDCANDIDATO='".$_SESSION["idcandidato"]."'";
				$DBGestion->ConsultaArray($sql);
				$lideres=$DBGestion->datos;
		
		?>
						<option value="">Seleccione....</option>
                        <?php
						foreach ($lideres as $datos){
							 $id = $datos['ID'];
							 $nombre = $datos['NOMBRES'];
							 
							  			 
				?>
						<option value="<?php echo $id?>"><?php echo $nombre?></option>
						<?php } ?>
                        </select>
				</li>				
				 <li>
					<label for="email" style="width: 100px;">						
					
					</label>
						
				</li>
				
			</ol>
			</div><br/>
			<br/>	<br/>	<br/>	<br/>	<br/>		
				<p class="textRequired"> * Campos Requeridos</p>				
				<div id="tableButtons">	
				<input id="cmdatras" type="button" onclick="history.go(-1);" value="Atras" name="cmdatras">	
				<input id="btnSave" class="submit" type="submit" value="Guardar" style="width: 100px;"/>			
				
					
		  </div>
		</div>
		</div>
		</form>
		</header>
</div>
<div>
<?php require_once('bottom.php'); ?>	
</div>