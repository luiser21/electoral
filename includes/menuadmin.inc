				<h3>Panel administrativo&nbsp;&nbsp;</h3>
				<h4><a href="administrador.php"><img src="img/home.png"> Inicio del administrador</a></h4>
				<h4><a href="nuevanota.php"><img src="img/nueva_nota.png"> Insertar una nota nueva</a></h4>
				<br>
            <h4><img src="img/Icono_Lapiz.png"> Dise&ntilde;o</h4>
			<ul>
			    <li><a href="diseno.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Administrar Titulos</a></li>
				<li><a href="editarimagen.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Administrar Imagenes</a></li>
				<li><a href="editarBanner.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Administrar Banner</a></li>
			</ul>
			<h4><img src="img/news.png"> Noticias</h4>
            <ul>
			<?php
				$sql="SELECT IdCategoria, Categoria FROM tblcategorias";
				$DBGestion->ConsultaArray($sql);
                $categoria=$DBGestion->datos;
				$i=0;
                foreach ($categoria as $registro_categorias){
				  if($i < 3){
					$categoria = $registro_categorias["CATEGORIA"];
					$idcategoria = $registro_categorias["IDCATEGORIA"];
					echo "<li><a href=\"panel.php?pan=".$idcategoria."\"><span class=\"style1\">&nbsp;&nbsp;&nbsp;&nbsp;</span> <strong>Panel ".($i+1)."</strong> (".$categoria.") </a></li>";//"<h4>".$categoria."</h4>";
				  }
				  $i++;	
				}
			?>
			</ul>
			<h4><img src="img/video.png"> Video</h4>
			<ul>
				<li><a href="advideos.php"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;</span> Cambiar video</a></li>
			</ul>
				<h4><img src="img/articulos.png"> Art&iacute;culos</h4>
			<ul>
			<?php
				$sql="SELECT IdCategoria, Categoria FROM tblcategorias WHERE IdCategoria = '4' OR IdCategoria = '5'";
				$DBGestion->ConsultaArray($sql);
                $categoria=$DBGestion->datos;
				$i=0;
                foreach ($categoria as $registro_categorias){
				  if($i < 2){					
					$categoria = $registro_categorias["CATEGORIA"];
					$idcategoria = $registro_categorias["IDCATEGORIA"];
					if($idcategoria == 5){
					   $categoria = "Articulo Destacados";
					}
					echo "<li><a href=\"panel.php?pan=".$idcategoria."\"><span class=\"style1\">&nbsp;&nbsp;&nbsp;&nbsp;</span> ".$categoria."</a></li>";//"<h4>".$categoria."</h4>";
				  }	
				}
			?>
			</ul>
				<h4><img src="img/calendar.png"> Calendario de actividades</h4>
			<ul>
				<li><a href="admincalendario.php"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;</span> Administraci&oacute;n de calendarios </a></li>
			</ul>
				<h4><img src="img/chart.png"> Indicadores de desempe&ntilde;o</h4>
			<ul>
				<li><a href="indicadores.php"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;</span> Ingresar Indicador Nuevo</a></li>
				<li><a href="indicadoreslink.php"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;</span> Ingresar Indicador con Link</a></li>
				<li><a href="eliminar_indicador.php"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;</span> Eliminar Indicador</a></li>
			</ul>
				<h4><img src="img/foros.png"> Foros de opini&oacute;n</h4>
			<ul>
				<li><a href="adminforos.php"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;</span> Administraci&oacute;n</a></li>
			</ul>
				<h4><img src="img/carpeta.png"> Archivos</h4>
			<ul>
				<li><a href="editar_etom.php"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;</span> E-tom</a></li>
				<li><a href="adetom.php"><span class="style1">&nbsp;&nbsp;&nbsp;&nbsp;</span> Configuracion</a></li>
			</ul>
		