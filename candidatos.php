<?php require_once('topadmin.php');

$add = (isset($_GET['add']) ? $_GET['add'] : 0); ;
if($add == 1){
	imprimir($_POST);

    $nombre=(isset($_POST['nombre']) ? $_POST['nombre'] : '');
    $cedula=(isset($_POST['cedula']) ? $_POST['cedula'] : '');
    $departamento=(isset($_POST['departamento']) ?  : '');
    $celular=(isset($_POST['celular']) ? $_POST['celular'] : '');
    $fecha=(isset($_POST['fecha']) ? $_POST['fecha'] : '');
    $tipo=(isset($_POST['tipo']) ? $_POST['tipo'] : '');
    $partido=(isset($_POST['partido']) ? $_POST['partido'] : '');
    $departamento_puestos=(isset($_POST['departamento_puestos']) ? $_POST['departamento_puestos'] : '');
    $usuario=(isset($_POST['usuario']) ? $_POST['usuario'] : '');
    $password=(isset($_POST['password']) ? $_POST['password'] : '');
    $apellido=(isset($_POST['apellido']) ? $_POST['apellido'] : '');
    $direccion=(isset($_POST['direccion']) ? $_POST['direccion'] : '');
    $municipio=(isset($_POST['municipio']) ? $_POST['municipio'] : '');
    $email=(isset($_POST['email']) ? $_POST['email'] : '');
    $numero=(isset($_POST['numero']) ? $_POST['numero'] : '');
    $municipios_puestos=(isset($_POST['municipios_puestos']) ? $_POST['municipios_puestos'] : '');
    $mesas=(isset($_POST['mesas']) ? $_POST['mesas'] : '');

	exit;
}
?>
<style>
.bg1 {  
	position:relative;
	top:916px;
}
</style>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%d-%M-%Y"
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
	<form name="form2" method="post"  class="formular" action="candidatos.php?add=1" enctype="multipart/form-data" id="form2">
	<div style=" position:absolute; top:190px"><br/>
	<h4>Ingresar Candidato</h4>
	
		<div id="crudFormLineal" style="width: 910px; height: 780px; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			<h2>Informaci&oacute;n de Contacto</h2><br/>
			<div  style="width: 510px; height: 425px; background-color:#FFFFFF" >
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
						<input id="cedula" type="text" value="" name="cedula" class="validate[required,custom[integer]] ">
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
						  <input type="text" size="12" id="inputField"  name="fecha"  class="validate[required]" style="width:200px"/> &nbsp;&nbsp;&nbsp;&nbsp;<img src="images/x-office-calendar.png" id="inputField"  style="cursor:pointer">
				</li>
				<li>
					<label for="tipo">
						<span class="textRequired"> * </span>
						Tipo de Candidato
					</label>
						<select name="tipo" id="tipo" class="validate[required]">
						<option value="">Seleccione....</option>
                        	<?php 
		$sql="SELECT * FROM tipo_eleccion";
				$DBGestion->ConsultaArray($sql);
				$partidos=$DBGestion->datos;
					foreach ($partidos as $datos){
							 $id = $datos['IDTIPO'];
							 $nombre = $datos['NOMBRE'];
							 
		?>	<option value="<?php echo $id?>"><?php echo $nombre?></option>
						<?php } ?>
						</select>
				</li>
				<li>
					<label for="partido">
						<span class="textRequired"> * </span>
						Partido Polit&iacute;co
					</label>
						<select name="partido" id="partido" class="validate[required]">
						<option value="">Seleccione....</option>
                        <?php 
		$sql="SELECT * FROM PARTIDOS_POLITICOS";
				$DBGestion->ConsultaArray($sql);
				$partidos=$DBGestion->datos;
					foreach ($partidos as $datos){
							 $id = $datos['IDPARTIDO'];
							 $nombre = $datos['NOMBRE'];
							 
		?>	<option value="<?php echo $id?>"><?php echo $nombre?></option>
						<?php } ?>
						</select>
				</li>
				
					<h2>Puesto de Votacion</h2>
				<br/>
				<li>
					<label for="usuario">
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
					<label for="password" >
						<span class="textRequired"> * </span>
						Puesto de Votacion
					</label>
						<span id="capa_puestos" >
						<select name="puestos" id="puestos" >
						<option value="">Seleccione....</option>
						</select>
						</span>
				</li>
				
				<h2>Informaci&oacute;n de Acceso</h2>
				<br/>
				<li>
					<label for="usuario">
						<span class="textRequired"> * </span>
						Usuario
					</label>
						<input id="usuario" type="text" name="usuario" class="validate[required]">
				</li>
				<li>
					<label for="password" >
						<span class="textRequired"> * </span>
						Contrase&ntilde;a
					</label>
						<input id="password"  type="password" name="password" class="validate[required]">
				</li>
			</ol>
			</div>
			
				<div  style="background-color: #FFFFFF;
  
    float: right;
    height: 480px;  
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
						<input id="email" type="text" name="email" class="validate[required,custom[url]]">
				</li>
				<li>
					<label for="edad" style="width: 100px;">
						<span class="textRequired">  </span>
							Edad
					</label>
					0 a&ntilde;os
				</li>
				<li>
					<label for="numero" style="width: 100px;">
						<span class="textRequired">  </span>
							N&deg; Tarjeton
					</label>
					<input id="numero" type="text" value="" name="numero" class="validate[required,custom[integer]] ">
							</li>
				<li>
					<label for="foto" style="width: 100px;">
						<span class="textRequired">  </span>
							Foto
					</label>
						<input name="foto" type="file" size="30" >						
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
			<br/>	<br/>	<br/>	<br/>	<br/>	<br/>	<br/>	
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