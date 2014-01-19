<?php require_once('topadmin.php');

$add = (isset($_GET['add']) ? $_GET['add'] : 0); ;
if($add == 1){
	
    $nombre=(isset($_POST['nombre']) ? $_POST['nombre'] : 'NULL');
    $cedula=(isset($_POST['cedula']) ? $_POST['cedula'] : 'NULL');
    $departamento=(isset($_POST['departamento']) ?  : 'NULL');
    $celular=(isset($_POST['celular']) ? $_POST['celular'] : 'NULL');
    $fecha=(isset($_POST['fecha']) ? $_POST['fecha'] : 'NULL');

    $departamento_puestos=(isset($_POST['departamento_puestos']) ? $_POST['departamento_puestos'] : 'NULL');
	$puestos=(isset($_POST['puestos']) ? $_POST['puestos'] : 'NULL');
   
    $apellido=(isset($_POST['apellido']) ? $_POST['apellido'] : 'NULL');
    $direccion=(isset($_POST['direccion']) ? $_POST['direccion'] : 'NULL');
    $municipio=(isset($_POST['municipio']) ? $_POST['municipio'] : 'NULL');
    $email=(isset($_POST['email']) ? $_POST['email'] : 'NULL');
   
    $municipios_puestos=(isset($_POST['municipios_puestos']) ? $_POST['municipios_puestos'] : 'NULL');
    $mesas=(isset($_POST['mesas']) ? $_POST['mesas'] : 'NULL');
	
	 $idlider=(isset($_POST['lider']) ? $_POST['lider'] : 'NULL');
	 $ocupacion=(isset($_POST['ocupacion']) ? $_POST['ocupacion'] : 'NULL');
	
	//Consultar si ya existe el  simpatizante en otro lider
	$sql="SELECT * FROM MIEMBROS WHERE CEDULA"
	
	$sql="INSERT INTO MIEMBROS (NOMBRES, APELLIDOS, CEDULA, DIRECCION, MUNICIPIO, TELEFONO, EMAIL, FECHANACIMIENTO, IDPUESTOSVOTACION, IDLIDER, OCUPACION) VALUES ('".strtoupper(trim($nombre))."','".strtoupper(trim($apellido))."',".trim($cedula).",'".trim($direccion)."',".$municipio.",".trim($celular).",'".trim($email)."','".$fecha."',".$puestos.",'".$idlider."','".$ocupacion."')";	
	
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
	top:750px;
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
	<form name="form2" method="post"  class="formular" action="miembros_add.php?add=1"  id="form2">
	<div style=" position:absolute; top:190px"><br/>
	<h4>Ingresar Simpatizantes</h4>
	
		<div id="crudFormLineal" style="width: 910px; height: 590px; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
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
						<input id="cedula" type="text" value="" name="cedula" class="validate[required,custom[integer]] " style="width: 150px;">&nbsp;&nbsp;&nbsp;<a  class='iframe' href="consulta.php" ><span style=" font-size:11px;">Donde Votar??<img src="images/padrones-2013-donde-votar.png" id="inputField"  style="cursor:pointer" width="40px" height="31px"></span></a>
				</li>
				<li>
					<label for="departamento">
						<span class="textRequired"> * </span>
						Departamento
					</label>
						<select name="departamento" id="departamento" onclick="municipios()" class="validate[required]">
                        	<?php 
		$sql="SELECT * FROM DEPARTAMENTOS";
				$DBGestion->ConsultaArray($sql);
				$partidos=$DBGestion->datos;
		
		?>
						<option value="">Seleccione....</option>
                        <?php
						foreach ($partidos as $datos){
							 $id = $datos['IDDEPARTAMENTO'];
							 $nombre = $datos['NOMBRE'];
							 
							  			 
				?>
						<option value="<?php echo $id?>"><?php echo $nombre?></option>
						<?php } ?>
                        </select>
						
				</li>
				<li>
					<label for="celular">
						<span class="textRequired"> * </span>
						Telefono / Celular
					</label>
						<input id="celular" type="text" name="celular" class="validate[required,custom[integer],maxSize[10]] ">
				</li>
				
				
				<li>
					<label for="fecha">
						<span class="textRequired"> * </span>
						Fecha de Nacimiento
					</label>
						  <input type="text" size="12" id="inputField"  name="fecha"  class="validate[required]"   onblur="edad()" style="width:200px" value=""/> &nbsp;&nbsp;&nbsp;&nbsp;<img src="images/x-office-calendar.png" id="inputField"  style="cursor:pointer">
				</li>
				<li>
					<label for="formulario">
						<span class="textRequired"> * </span>
						Formulario
					</label>
						 <input id="formulario" type="text" name="formulario" class="validate[required]] ">
				</li>
				<li>
					<label for="lider">
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
				
					<h2>Puesto de Votacion</h2>
				<br/>
				<li>
					<label for="departamento_puesto">
						<span class="textRequired"> * </span>
						Departamento
					</label>
						<select name="departamento_puestos" id="departamento_puestos" onclick="municipiospuestos()" class="validate[required]">
                        	<?php 
		$sql="SELECT * FROM DEPARTAMENTOS";
				$DBGestion->ConsultaArray($sql);
				$partidos=$DBGestion->datos;
		
		?>
						<option value="">Seleccione....</option>
                        <?php
						foreach ($partidos as $datos){
							 $id = $datos['IDDEPARTAMENTO'];
							 $nombre = $datos['NOMBRE'];
							 
							  			 
				?>
						<option value="<?php echo $id?>"><?php echo $nombre?></option>
						<?php } ?>
                        </select>
				</li>
					<li>
					<label for="puesto" >
						<span class="textRequired"> * </span>
						Puesto de Votacion
					</label>
						<span id="capa_puestos" >
						<select name="puestos" id="puestos" >
						<option value="">Seleccione....</option>
						</select>
						</span>
				</li>		
				
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
					<label for="apellidos" style="width: 100px;">
						<span class="textRequired"> * </span>
							Apellidos
					</label>
					<input id="apellido" type="text" value="" name="apellido" class="validate[required]">
							</li>
							<li >
					<label for="direccion" style="width: 100px;">
						<span class="textRequired"> * </span>
						Direccion
					</label>
						<input id="direccion" type="text" name="direccion" class="validate[required]">
				</li>
				<li>
					<label for="municipio" style="width: 100px;">
						<span class="textRequired"> * </span>
						Municipio
					</label>
					<span id="capa_documentos" >
						<select name="municipio" id="municipio" class="validate[required]">
						<option value="">Seleccione....</option>
						</select>
						</span>
				</li>
				<li>
					<label for="email" style="width: 100px;">
						<span class="textRequired"> * </span>
						Email
					</label>
						<input id="email" type="text" name="email" class="validate[required,custom[email]]">
				</li>
				<li>
					<label for="edad" style="width: 100px;">
						<span class="textRequired">  </span>
							Edad
					</label>
					<span id="capa_edad">
						0 a&ntilde;os
						</span>
				</li>				
				 <li>
					<label for="email" style="width: 100px;">						
						Ocupacion
					</label>
						<input id="ocupacion" type="text" name="ocupacion" >
				</li>
				</li>				
				 <li>
					<label for="email" style="width: 100px;">						
					
					</label>
						
				</li>
				<li>&nbsp;</li>	
				<br/>	<br/>
					<li>
					<label for="muncipio2" style="width: 100px;">
							<span class="textRequired"> * </span>
							Municipio
					</label>
					<span id="capa_documentos_municipio" >
						<select name="municipios_puestos" id="municipios_puestos">
						<option value="">Seleccione....</option>
						</select>
						</span>
							</li>
							<li>
					<label for="password" style="width: 100px;">
						<span class="textRequired"> * </span>
						Mesa
					</label>
						<span id="capa_mesas" >
						<select name="mesas" id="mesas" >
						<option value="">Seleccione....</option>
						</select>
						</span>
				</li>
			</ol>
			</div><br/>
			<br/>	<br/>	<br/>	<br/>	<br/>	<br/>	<br/>	<br/>	
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