<!--
<script type="text/javascript" >
$(document).ready(function() {				
				$(".iframe").colorbox({
					iframe:true, 
					width:"750px", 
					height:"340px"
				});		
				$(".iframe2").colorbox({
					iframe:true, 
					width:"750px", 
					height:"440px"
				});		
			} );

</script>
-->
<ul id="nav">
	<li class="current"><a href="adetom.php">Inicio</a></li>
	<li><a href="calendario.php"  >Calendario Electoral</a></li> 		
		<ul>			
			<li ><a href="#" >Proyectos de Ley</a></li>
		</ul>
		
	</li>
	<li class="top"><a href="#">Marco Legal</a>		
		<ul > <?php if($_SESSION['consulta']=='0'){ ?>
			<li ><a href="causales.php?ac=1">Constituci&oacute;n</a></li>
			<li ><a href="#">LEYES</a></li>
			<li ><a href="#">DECRETOS</a></li>
			<li ><a href="#">RESOLUCIONES</a></li>
			<li ><a href="#">CIRCULARES</a></li>
			<?php } ?>
		</ul>
	</li>
	<li ><a href="#" >Datos Historicos</a>		
		<ul > <?php if($_SESSION['consulta']=='0'){ ?>
			<li ><a href="#">Elecciones Locales 2015</a>
				<ul>
					<li ><a target="_blank" href="https://elecciones.registraduria.gov.co:81/esc_elec_2015/99AL/DAL15218ZZZZZZZZZZZZ_L1.htm">Alcaldia</a>
						
					</li>
					<li ><a target="_blank" href="https://elecciones.registraduria.gov.co:81/esc_elec_2015/99GO/DGO15218ZZZZZZZZZZZZ_L1.htm">Gobernacion</a>
						
					</li>
					
				</ul>
			</li>
			<li ><a href="#">Elecciones Locales 2011</a>
				<ul>
					<li ><a target="_blank" href="https://w3.registraduria.gov.co/escrutinio/resultados?accion=cambiar_municipio&dep_activo=15&mun_activo=218&corp_activo=alcaldia">Alcaldia</a>
						
					</li>
					<li ><a target="_blank" href="https://elecciones.registraduria.gov.co:81/esc_elec_2015/99GO/DGO15218ZZZZZZZZZZZZ_L1.htm">Gobernacion</a>
						
					</li>
					
				</ul>
			</li>
			<li ><a href="#">Elecciones Locales 2007</a>
				<ul>
					<li ><a target="_blank" href="https://www.colombia.com/especiales/elecciones_2007/resultados/resultados.asp?T=A&D=15&M=218">Alcaldia</a>
						
					</li>
					
					
				</ul>
			</li>
			<li ><a href="#">Elecciones Locales 2003</a>
				<ul>
					<li ><a target="_blank" href="https://www.colombia.com/especiales/elecciones_2007/resultados/resultados.asp?T=A&D=15&M=218">Alcaldia</a>
						
					</li>
					
					
				</ul>
			</li>
			<li ><a href="#">Elecciones Congreso 2018</a>
				<ul>
					<li ><a href="https://elecciones.registraduria.gov.co:81/elec20180311/resultados/99SE/BXXXX/DSE15218.htm">Senado</a>
						
					</li>
					<li ><a href="https://elecciones.registraduria.gov.co:81/elec20180311/resultados/99CA/BXXXX/DCA15218.htm">Camara</a>
						
					</li>
					
				</ul>
			</li>
			<li ><a href="#">Elecciones Congreso 2010</a>
				<ul>
					<li ><a href="#">Senado</a>
						<ul>
							<li ><a href="causales.php?ac=2">Votacion por Candidatos</a></li>
							<li ><a href="causales.php?ac=3">Votacion por Partidos</a></li>
							<li ><a href="causales.php?ac=4">Curules por Partidos</a></li>
							<li ><a href="causales.php?ac=5">Elegidos Detallado</a></li>
						</ul>
					</li>
					<li ><a href="#">Camara</a>
						<ul>
							<li ><a href="causales.php?ac=6">Votacion por Partidos</a></li>
							<li ><a href="causales.php?ac=7">Curules por Partido</a></li>
							<li ><a href="causales.php?ac=8">Curules por Departamento</a></li>
							<li ><a href="causales.php?ac=9">Elegidos Detallado</a></li>
						</ul>
					</li>
					
				</ul>
			</li>
			<li ><a href="http://w3.registraduria.gov.co/escrutinio/resultados" target="_blank">Elecciones 2011</a></li>	
			<li ><a href="#">Elecciones Congreso 2014</a>
				<ul >
					<li><a href="causales.php?ac=11">Elegidos Senado</a></li>
					<li ><a href="causales.php?ac=12">Elegidos Camara</a></li>
					<li ><a href="causales.php?ac=13">Curules Senado-Camara</a></li>
					<li ><a href="http://www3.registraduria.gov.co/congreso2014/preconteo/99SE/DSE9999999_L2.htm" target="_blank">Resultados por Departamento</a></li>
				</ul>
			</li>
			<?php } ?>
		</ul>	
	</li>
	<li ><a href="#" >Administraci&oacute;n de la Campa&a</a>		
		<ul>
			
			<li ><a href="miembros.php" >Simpatizantes</a></li>
			<li ><a href="lideres.php" >Lideres</a></li>
			<?php if($_SESSION['consulta']=='0'){ ?>
				<li ><a href="estructura.php" >Estructura</a></li>			
				<li ><a href="#" >Finanzas</a></li>
				<li ><a href="#" >Logistica</a></li>
				<li ><a href="#" >Comunicaciones</a></li>
				<li ><a href="#" >Seguimiento Estadistico</a></li>		
			<?php } ?>
		</ul>		
	</li>
	<li><a href="#"  >Informes</a>
		<ul> 
			<?php if($_SESSION['consulta']=='0'){ ?>
			<!-- <li ><a href="Informe_lideres.php">Seguimiento por Lideres</a></li>-
			<li ><a href="Informes.php">Seguimiento por Puesto de Votaci&oacute;n</a></li>
			<!--<li ><a href="Informes_municipios.php">Seguimiento por Municipios</a></li>
			<li ><a href="Informes_departamento.php">Seguimiento por Departamentos</a></li>
			<li ><a href="Informes_municipios.php">Seguimiento por Municipios</a></li>
			<li ><a href="Informes_lideres.php">Seguimiento por Lideres</a></li>
			<li ><a href="Informes_diferente_puestos.php"><?php if($_SESSION['tipocandidato']=='CONSEJO' || $_SESSION['tipocandidato']=='ALCALDIA'){ echo "Seguimiento por Simpatizantes No Inscritos en el Municipio"; } ?>
			<?php if($_SESSION['tipocandidato']=='CAMARA' || $_SESSION['tipocandidato']=='GOBERNACION'){ echo "Seguimiento por Simpatizantes No Inscritos en el Departamento"; } ?></a></li>
			<li ><a href="Informes_miembros_duplicados.php">Seguimiento por Simpatizantes Duplicados por Lider</a></li>
			<li ><a href="Informes_miembros_datos.php">Seguimiento por Simpatizantes con datos Incompletos</a></li>
			<?php //if($_SESSION['username']=='duvanpineda'){?>-->			
			<li ><a href="#">Fase Pre Electoral</a>
				<ul>
					<li ><a href="reporte.php">Vista Fase Pre Electoral</a></li>
							<?php if($_SESSION["username"]=='celispabon'){?>
					<li ><a href="Informes_cedulas.php">Proceso Recoleccion Firmas</a></li>
					<?php } ?>
					<?php if($_SESSION['tipocandidato']!='CONSEJO' && $_SESSION['tipocandidato']!='ALCALDIA'){?>
							<?php if($_SESSION['tipocandidato']!='GOBERNACION'){?>
							<!--<li ><a href="Informes_departamento.php">Por Departamentos</a></li>-->
							<li ><a href="Informes_municipios.php">Por Municipios</a></li>
							<?php }?>
							<!--<li ><a href="Informes_municipios.php">Por Municipios</a></li>-->
					
					<?php } ?>
					<?php if($_SESSION['tipocandidato']=='SENADO'){?>
							<li ><a href="Informes_departamento.php">Por Departamentos</a></li>					
					<?php } ?>
					<!-- <li ><a href="Informe_lideres.php">Seguimiento por Lideres</a></li>-->
					<li ><a href="Informes.php">Por Puesto de Votaci&oacute;n</a></li>
					<li ><a href="Informes_reqcoordinador.php">Por Puesto de Votaci&oacute;n que Requiere Coordinador</a></li>
					<li ><a href="Informes_mesas_testigos.php">Por Mesas que Requieren Testigos Electoral</a></li>
					<!--<li ><a href="Informes_municipios.php">Seguimiento por Municipios</a></li>-->
					<li ><a href="Informes_lideres.php">Por Lideres</a></li>			
					<?php if($_SESSION['tipocandidato']=='CONSEJO' || $_SESSION['tipocandidato']=='ALCALDIA'){ ?>
					<li ><a href="Informes_diferente_puestos.php"><?php
					echo "Por Simpatizantes No Inscritos en el Municipio"; } ?>
					<?php if($_SESSION['tipocandidato']=='CAMARA' || $_SESSION['tipocandidato']=='GOBERNACION'){ echo "Por Simpatizantes No Inscritos en el Departamento"; } ?></a></li>
					<li ><a href="Informes_miembros_duplicados.php">Por Simpatizantes Duplicados por Lider</a></li>
					<li ><a href="Informes_miembros_datos.php">Por Simpatizantes con datos Incompletos</a></li>
					<?php //if($_SESSION['username']=='duvanpineda'){?>
					
					<li ><a href="#">Consolidado Lideres - Simpatizantes</a></li>
					<!--<li ><a href="compromisos.php">Compromisos</a></li>
					<li ><a href="seguimiento_simpatizantes_movilizados.php">Seguimiento Simpatizantes Movilizados</a></li>
					<li ><a href="informe_movilizados.php">Informe Comparativo Compromisos - Movilizados - Votos Reales</a></li>-->
					<?php //} ?>
				</ul>
			</li>
			<li ><a href="porpuestovotacion.php">Por Puesto de Votacion</a></li>
			<li ><a href="reporte2.php">Dia Electoral</a></li>
			<li ><a href="reporte3.php">Dia Post Electoral</a></li>
			<li ><a href="consolidado.php">Consolidado Electoral</a></li>			
			<li ><a href="consolidado3.php">Analisis de Resultados</a></li>
			<li ><a href="#">Gerente Nacional</a>
				<ul>			
					<li ><a href="reportegerentenacional.php" >Nacional</a></li>
					<li ><a href="reportegerentedepartamental.php" >Departamental</a></li>					
				</ul>
			</li>
			<!--<li ><a href="movilizados.php">Movilizados</a></li>
			<li ><a href="compromisos.php">Compromisos</a></li>
			<li ><a href="seguimiento_simpatizantes_movilizados.php">Seguimiento Simpatizantes Movilizados</a></li>
			<li ><a href="informe_movilizados.php">Informe Comparativo Compromisos - Movilizados - Votos Reales</a></li>-->
			<?php } ?>
		</ul>
	</li>
	<li><a href="#"  >Formatos</a>
		<ul> <?php  if($_SESSION['username']=='yesid'){ ?>
			<li ><a href="/electoral/documentos/TARJETON_DIDACTICO_RICAURTE.pdf" download="TarjetonelectoralDidactico2019.pdf">Tarjeton Electoral Didactico PDF </a></li>
			<li ><a href="/electoral/documentos/TARJETON_DIDACTICO_RICAURTE.pptx" download="TarjetonelectoralDidactico2019.pptx">Tarjeton Electoral Didactico PPTX</a></li>
			<li ><a href="/electoral/documentos/TARJETON CONSEJO RICAURTE.pdf" download="TARJETON_CONSEJO_RICAURTE.pdf">Tarjeton Electoral Consejo PDF</a></li>
			<li ><a href="/electoral/documentos/CONSEJO1.pptx" download="TARJETON_CONSEJO_RICAURTE.pptx">Tarjeton Electoral Consejo PPTX</a></li>
			<li ><a href="/electoral/documentos/1564869199246_plantilla 3.pptx" download="PLANTILLAPRESENTACION_1.pptx">Plantilla Presentacion 1</a></li>
			<li ><a href="/electoral/documentos/plantilla 2.pptx" download="PLANTILLAPRESENTACION_2.pptx">Plantilla Presentacion 2</a></li>
			<li ><a href="/electoral/documentos/plantilla 3.pptx" download="PLANTILLAPRESENTACION_3.pptx">Plantilla Presentacion 3</a></li>
			<li ><a href="/electoral/documentos/plantilla.pptx" download="PLANTILLAPRESENTACION_4.pptx">Plantilla Presentacion 4</a></li>
			<li ><a href="http://solumarsas.com.co/electoral/documentos/videocampanaricaurte.mp4" target="_blank">Video Campa�a Alcaldia</a></li>
			<li ><a href="http://solumarsas.com.co/electoral/documentos/videocampanaricaurte_consejo.mp4" target="_blank">Video Campa�a Consejo</a></li>
			
			<?php } if($_SESSION['consulta']=='0'){ ?>
			<!-- <li ><a href="Informe_lideres.php">Seguimiento por Lideres</a></li>-
			<li ><a href="Informes.php">Seguimiento por Puesto de Votaci&oacute;n</a></li>
			<!--<li ><a href="Informes_municipios.php">Seguimiento por Municipios</a></li>
			<li ><a href="Informes_departamento.php">Seguimiento por Departamentos</a></li>
			<li ><a href="Informes_municipios.php">Seguimiento por Municipios</a></li>
			<li ><a href="Informes_lideres.php">Seguimiento por Lideres</a></li>
			<li ><a href="Informes_diferente_puestos.php"><?php if($_SESSION['tipocandidato']=='CONSEJO' || $_SESSION['tipocandidato']=='ALCALDIA'){ echo "Seguimiento por Simpatizantes No Inscritos en el Municipio"; } ?>
			<?php if($_SESSION['tipocandidato']=='CAMARA' || $_SESSION['tipocandidato']=='GOBERNACION'){ echo "Seguimiento por Simpatizantes No Inscritos en el Departamento"; } ?></a></li>
			<li ><a href="Informes_miembros_duplicados.php">Seguimiento por Simpatizantes Duplicados por Lider</a></li>
			<li ><a href="Informes_miembros_datos.php">Seguimiento por Simpatizantes con datos Incompletos</a></li>
			<?php //if($_SESSION['username']=='duvanpineda'){?>-->			
			
				<?php } ?>
		</ul>
	</li>	
</ul>