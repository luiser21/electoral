		Imagen actual:<br><br>
		   <?
		   if(@$fotoactual != ""){
		   ?>
		    <img src="img/<?php echo $fotoactual;?>">
		   <?
		   }else{
		       echo "&nbsp;&nbsp;&nbsp;&nbsp;<strong>Esta Noticia no tiene imagen</strong>";
		   }
		   ?>	
		<br><br>
		<form id="form2" method="POST" action="<?php echo $_SERVER['PHP_SELF']."?pan=".$pancat."&u=1&a=".$idarticulo.""; ?>" enctype="multipart/form-data">
		<p>
			Titulo:
			<input type="text" name="titulo" class="border" size="60" value="<?php echo $titulo;?>">
			<input type="hidden" name="imagen" class="border" size="60" value="<?php echo $fotoactual;?>">
		<br>
	<!-- Inicia el campo del formulario para cargar archivos -->
		<label for="file">Seleccione la imagen:</label>
		<input type="file" name="file" id="file" /> 
		<br />
			Secci&oacute;n:
                <select name="idcategoria">
			    <?PHP
				       $sql="SELECT * FROM tblcategorias Where IdCategoria < '6'";
				       $resultados = mysql_query($sql) or die(mysql_error());//"No se pudo leer la categoria.");
				       while ($registro_resultados = mysql_fetch_array($resultados))
				       {
				          $categoria = $registro_resultados["Categoria"];
						  $id = $registro_resultados["IdCategoria"];
						  ?>
						     <option value="<?echo $id?>"><?echo $categoria?></option> 
						  <?
					   }
				?>				
					
				</select>
		</p>
	<!-- Termina el campo del formulario para cargar archivos -->
        <p>
			<strong>
				Contenido
			</strong>
		</p>
		<p>
			<textarea rows="20" cols="60" name="contenido" class="border"><?php echo $contenido;?></textarea><hr>
        </p>
        <p>
				<?php echo $status;?><hr>
        </p>
		<input name="Enviar" type="submit" id="Enviar" value="Actualizar" />
		</form>