<?php require_once('topadmin.php');?> 
<?php 


$tipo = (isset($_GET['ac']) ? $_GET['ac'] : 0); ;
?>
<style>
#crudFormLineal label {
	width: 350px;
}
.bg1 {  
	position:relative;
	top:750px;
}
</style>
<div class="main">	
<header>
		<div style=" position:absolute; top:190px; width:auto; clear:both"><br/>
		<?php if($tipo==1){?>
				<h4>Constituci&oacute;n Nacional</h4>
				<?php }if($tipo==2){?>
				<h4>C&oacute;digo Disciplinario</h4>
					<?php }if($tipo==3){?>
					<h4>R&eacute;gimen de Bancadas</h4>
					<?php }if($tipo==4){?>
					<h4>Causales por Perdida de Investidura</h4>
					<?php }if($tipo==5){?>
					<h4>Instructivo Rendición de Cuentas</h4>
					<?php }if($tipo==6){?>
					<h4>PARAPOL&Iacute;TICA EN EL CONGRESO ELECTO PERIODO 2010-2014</h4>
					<?php }if($tipo==7){?>
					<h4>BALANCE ELECCIONES LEGISLATIVAS 2010</h4>
					<?php }if($tipo==8){?>
					<h4>Votos por Partido a la CAMARA DE LA REPÚBLICA</h4>
					<?php }if($tipo==9){?>
					<h4>Votos a la CAMARA DE LA REPÚBLICA Detallado</h4>
						<?php }if($tipo==10){?>
					<h4>Votos al SENADO DE LA REPÚBLICA Detallado</h4>
						<?php }?>
			<div id="crudFormLineal" style="width: 910px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			<?php if($tipo==1){?>			
			<embed src="documentos/Constitucioncolombia.pdf" type="application/pdf" style="width:910px; height:600px">	
				<?php }if($tipo==2){?>
				<embed src="documentos/codigo2012.pdf" type="application/pdf" style="width:910px; height:600px">	
					<?php }if($tipo==3){?>
					<embed src="documentos/guiabancadas.pdf" type="application/pdf" style="width:910px; height:600px">	
						<?php }if($tipo==4){?>
				<embed src="documentos/30.pdf" type="application/pdf" style="width:910px; height:600px">	
						<?php }if($tipo==5){?>
						<embed src="documentos/Instructivo Rendicion de cuentas.pdf" type="application/pdf" style="width:910px; height:600px">	
						<?php }if($tipo==6){?>
						<embed src="documentos/Parapolitica-senado-electo-27-abril-2012.pdf" type="application/pdf" style="width:910px; height:600px">
							<?php }if($tipo==7){?>
						<embed src="documentos/boletin-observatorio-politico-12.pdf" type="application/pdf" style="width:910px; height:600px">	
							<?php }if($tipo==8){?>
						<embed src="documentos/votacion-por-partido-camara-2010.pdf" type="application/pdf" style="width:910px; height:600px">	
						<?php }if($tipo==9){?>
						<embed src="documentos/camara-detallado-elec2010.pdf" type="application/pdf" style="width:910px; height:600px">	
						<?php }if($tipo==10){?>
						<embed src="documentos/canddidatos senado.pdf" type="application/pdf" style="width:910px; height:600px">	
						<?php }?>
			</div></div>
		</header>	
		
	 </div>
<?php require_once('bottom.php'); ?>		