<link rel="stylesheet" href="css/master.css" type="text/css" media="all">
<script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%d-%M-%Y"
		});
	};
</script>

		<div id="crudFormLineal" style="width: 860px; height: 400px; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium; font:14px Arial, Helvetica, sans-serif;color:#808080; " >
			<h2>Informaci&oacute;n de Contacto</h2>
			<div  style="width: 510px; height: 345px; background-color:#FFFFFF" >
			<ol>
				
				<li>
					<label for="nombres">
						<span class="textRequired"> * </span>
							Nombres
					</label>
						<input id="nombre" type="text" value="" name="nombre">
				</li>
				<li>
					<label for="cedula">
						<span class="textRequired"> * </span>
							Cedula
					</label>
						<input id="cedula" type="text" value="" name="cedula">
				</li>
				<li>
					<label for="departamento">
						<span class="textRequired"> * </span>
						Departamento
					</label>
						<select name="departamento" id="departamento">
						<option value="">Seleccione....</option>
						</select>
				</li>
				<li>
					<label for="celular">
						<span class="textRequired"> * </span>
						Telefono / Celular
					</label>
						<input id="celular" type="text" name="celular">
				</li>
				
				
				<li>
					<label for="fecha">
						<span class="textRequired"> * </span>
						Fecha de Nacimiento
					</label>
						  <input type="text" size="12" id="inputField"  name="fecha"  style="width:200px"/> &nbsp;&nbsp;&nbsp;&nbsp;<img src="images/x-office-calendar.png" id="inputField"  style="cursor:pointer">
				</li>
				<li>
					<label for="tipo">
						<span class="textRequired"> * </span>
						Tipo de Candidato
					</label>
						<select name="tipo" id="tipo">
						<option value="">Seleccione....</option>
						</select>
				</li>
				<li>
					<label for="partido">
						<span class="textRequired"> * </span>
						Partido Polit&iacute;co
					</label>
						<select name="partido" id="partido">
						<option value="">Seleccione....</option>
						</select>
				</li>
				<h2>Informaci&oacute;n de Acceso</h2>
				
				<li>
					<label for="usuario">
						<span class="textRequired"> * </span>
						Usuario
					</label>
						<input id="usuario" type="text" name="usuario">
				</li>
				<li>
					<label for="password" >
						<span class="textRequired"> * </span>
						Contrase&ntilde;a
					</label>
						<input id="password"  type="password" name="password">
				</li>
			</ol>
			</div>
			
				<div  style="background-color: #FFFFFF;
  
    float: right;
    height: 300px;  
    margin-left: 487px;  
    position: absolute;
    top:48px;
    width: 390px;" >
			<ol>
				 	<li>
					<label for="apellidos" style="width: 100px;">
						<span class="textRequired"> * </span>
							Apellidos
					</label>
					<input id="apellido" type="text" value="" name="apellido">
							</li>
							<li >
					<label for="direccion" style="width: 100px;">
						<span class="textRequired"> * </span>
						Direccion
					</label>
						<input id="direccion" type="text" name="direccion">
				</li>
				<li>
					<label for="municipio" style="width: 100px;">
						<span class="textRequired"> * </span>
						Municipio
					</label>
						<select name="municipio" id="municipio">
						<option value="">Seleccione....</option>
						</select>
				</li>
				<li>
					<label for="email" style="width: 100px;">
						<span class="textRequired"> * </span>
						Email
					</label>
						<input id="email" type="text" name="email">
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
					<input id="numero" type="text" value="" name="numero">
							</li>
				<li>
					<label for="foto" style="width: 100px;">
						<span class="textRequired">  </span>
							Foto
					</label>
						<input name="foto" type="file" size="30" >						
				</li>	
			</ol>
			</div>
					
				<div id="tableButtons" style=" margin-top: -23px; padding-bottom: 0;">		
				<p class="textRequired"> * Campos Requeridos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<input id="btnSave" class="button" type="button"  name="btnSave" value="Guardar" style="width: 100px;"></p>	
					
				
		  </div>
		</div>
		</div>
		