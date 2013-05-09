		<form id="form2" method="POST" action="<?php echo $PHP_SELF."?u=1&a=".$_GET[a].""; ?>" enctype="multipart/form-data">
		<p>
			<strong>
				Asunto
			</strong>
		</p>
		<p>
			<input type="text" name="titulo" class="border" size="60" value="<?php echo $titulo;?>">
		</p>	
        <p>
			<strong>
				Detalles
			</strong>
		</p>
		<p>
			<textarea rows="20" cols="60" name="contenido" class="border"><?php echo $contenido;?></textarea><hr>
        </p>
		<input name="Enviar" type="submit" id="Enviar" value="Actualizar" />
		</form>