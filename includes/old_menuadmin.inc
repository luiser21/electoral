   <div class="float-right" id="contenido-columna02">
  <div class="float-right" id="noticias-caja">
    <h3>Contenidos</h3>
		<?php
		$sql="SELECT * FROM tblcategorias WHERE idcategoria <5";
		$categorias = mysql_query($sql) or die("<br>No se cargaron las secciones 1 a 4.");
		for ($i=0; $i<4 && $registro_categorias = mysql_fetch_array($categorias); $i++)
				{
					$categoria = $registro_categorias["Categoria"];
					$idcategoria = $registro_categorias["IdCategoria"];
					echo "<h4>".$categoria."</h4>";
					$sql="SELECT IdArticulo, Titulo FROM tblarticulos WHERE idcategoria =".$idcategoria;
					$articulos = mysql_query($sql) or die("<br>No se cargaron los articulos de la seccion".$idcategoria.".");
					echo "<ul>";
					for ($j=0; $j<10 && $registro_articulos = mysql_fetch_array($articulos); $j++)
					{
						$articulo = $registro_articulos["Titulo"];
						$idarticulo = $registro_articulos["IdArticulo"];
						echo "<li><a href=\"".$PHP_SELF."?e=20040902&c=".$idcategoria."&a=".$idarticulo."\">".$articulo."<span class=\"style1\">»</span> </a></li>";
					}
					echo "</ul>";
				}
		?>
        </div>
          
    </div>