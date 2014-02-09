<?php require_once('topadmin.php');?> 
<?php 
//imprimir($_SESSION);

$tipo = (isset($_GET['ac']) ? $_GET['ac'] : 0); ;
?>
<style>
#crudFormLineal label {
	width: 350px;
}
.bg1 {  
	position:relative;
	top:500px;
}
</style>
<div class="main">	
<header>
		<div style=" position:absolute; top:190px; width:auto; clear:both"><br/>		
				<h4>Elecciones Congreso 2014</h4>
			
			<div id="crudFormLineal" style="width: 910px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			  <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <th scope="row"><a href="ver_pdf.php?ac=1"><img src="images/cs.png" width="325" height="171"></a></th>
                  <td><a href="ver_pdf.php?ac=2"><img src="images/cr.png" width="324" height="171"></a></td>
                </tr>
                <tr>
                  <th scope="row"><a href="ver_pdf.php?ac=3"><img src="images/te.png" width="324" height="171"></a></th>
                  <td><a href="ver_pdf.php?ac=4"><img src="images/nie.png" width="324" height="171"></a></td>
                </tr>
              </table>
			</div></div>
		</header>	
		
	 </div>
<?php require_once('bottom.php'); ?>		