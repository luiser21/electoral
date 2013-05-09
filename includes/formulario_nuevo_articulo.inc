		<form id="form2" method="POST" action="<?php echo $_SERVER['PHP_SELF']."?nn=1"; ?>" enctype="multipart/form-data">
		<p>
			Titulo:
			<input type="text" name="titulo" class="border" size="60">
		<br>
			Secci&oacute;n:
                <select name="idcategoria">
			    <?PHP
				        $sql="SELECT * FROM tblcategorias Where IdCategoria < '6'";
						$DBGestion->ConsultaArray($sql);
						$cate=$DBGestion->datos;
						foreach ($cate as $registro_resultados){					   
				          $categoria = $registro_resultados["CATEGORIA"];
						  $id = $registro_resultados["IDCATEGORIA"];
						  ?>
						     <option value="<?echo $id?>"><?echo $categoria?></option> 
						  <?
					   }
				?>				
					
				</select>
		<br>
                Tipo: <select name="vinculo" OnChange="cambio()">
                    <option value="">...</option>
                    <option value="1">Noticia</option>
                    <option value="2">Vinculo</option>
                </select>  
                <br>
                <div id="capa_resultado"></div>
                <hr>              
		<input name="Enviar" type="submit" id="Enviar" value="Crear" />
		</form>