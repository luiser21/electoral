		<form id="form2" method="POST" action="<?php echo "foro.php"."?id=".$idforo."&act=1"; ?>" enctype="multipart/form-data">
		</p>
	<!-- Termina el campo del formulario para cargar archivos -->
        <p>
			<strong>
				Re: <?php echo $titulo;?>
			</strong>
		</p>
		<p>
			<textarea rows="10" cols="60" name="contenido" class="border"></textarea><hr>
        </p>
        <p>
			<img src="img/email.png" border="0">&nbsp;Digite ac&aacute; su e-m@il de contacto<br><input name="email" type="text" id="email" class="border" size="60">
        </p>
        <p>
		<hr>
        </p>
		<input name="Enviar" type="submit" id="Enviar" value="Actualizar" />
		</form>