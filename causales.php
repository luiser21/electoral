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
				<?php }?>
			</div></div>
		</header>	
		
	 </div>
<?php require_once('bottom.php'); ?>		