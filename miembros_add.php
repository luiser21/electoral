<?php require_once('topadmin.php');
include_once "example_doc_miembros_add.php";
$add = (isset($_GET['add']) ? $_GET['add'] : 0); ;
if($add == 1){
	
    @$nombre=(isset($_POST['nombre']) ? $_POST['nombre'] : 'NULL');
    @$cedula=(isset($_POST['cedula']) ? $_POST['cedula'] : 'NULL');
    @$celular=(isset($_POST['celular']) ? $_POST['celular'] : 'NULL');
    @$email=(isset($_POST['email']) ? $_POST['email'] : 'NULL'); 
	 @$idlider=(isset($_POST['lider']) ? $_POST['lider'] : 'NULL');
	 @$ocupacion=(isset($_POST['ocupacion']) ? $_POST['ocupacion'] : 'NULL');
		
	$puestoreg=ingresar_manual_miembros($cedula,$nombre,$celular,$email,$idlider,$ocupacion);	
	//echo $puestoreg;
	if($puestoreg=='1'){
	 ?>
       	 <script language="javascript">
	       	 alert("Se ingreso el Simpatizante exitosamente"); 
	       	 window.location="miembros.php";
       	 </script>
	   <?php	
	}else{
		 ?>
       	 <script language="javascript">
	       	alert("Hubo un Problema:  <?php echo $puestoreg?> \n Se crea Registro en Historico"); 
	       	window.location="miembros_add.php";
       	 </script>
	   <?php
	}
}
?>
<style>
.bg1 {  
	position:relative;
	top:650px;
}
</style>
<script type="text/javascript">
function puesto_votacion(){
	var pagina= "Ajax_puestos.php";
	var capa = "capa_documentos_municipio";
	var cedula = document.getElementById('cedula').value;
	var valores = 'cedula=' + cedula + '&' + Math.random();
	if(cedula!=''){ 			
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