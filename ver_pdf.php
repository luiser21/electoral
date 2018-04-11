<?php require_once('top.php');?> 
<?php 


$tipo = (isset($_GET['ac']) ? $_GET['ac'] : 0); ;
$ruta = (isset($_GET['ruta']) ? $_GET['ruta'] : 0); ;
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
				<h4>Candidatos a Senado de la Rep&uacute;blica</h4>
				<?php }if($tipo==2){?>
				<h4>Candidatos a C&aacute;mara de Representantes</h4>
					<?php }if($tipo==3){?>
					<h4>Conoce el Tarjeton Electoral</h4>
					<?php }if($tipo==4){?>
					<h4>Movilizacion y Seguimiento</h4>
						<?php }if($tipo==4){?>
					<h4>Seguimiento</h4>
						<?php }?>
						
			<div id="crudFormLineal" style="width: 910px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			<?php if($tipo==1){?>			
			<embed src="documentos/SENADO_<?php echo $_SESSION['partido']?>_candidatos.pdf" type="application/pdf" style="width:910px; height:600px">	
				<?php }if($tipo==2){?>
				<embed src="documentos/CAMARA_<?php echo $_SESSION['partido']?>_candidatos.pdf" type="application/pdf" style="width:910px; height:600px">	
					<?php }if($tipo==3){?>					
					<embed src="documentos/tarjetonelectoral.pdf" type="application/pdf" style="width:910px; height:600px">	
						<?php }if($tipo==4){?>
				<embed src="documentos/duque/mapa.output.pdf" type="application/pdf" style="width:910px; height:600px">	
				<?php }if($tipo==5){?>
				<embed src="documentos/duque/siguemovil.pdf" type="application/pdf" style="width:910px; height:600px">	
				<?php }?>
			</div></div>
		</header>	
		
	 </div>
<?php require_once('bottom.php'); ?>		