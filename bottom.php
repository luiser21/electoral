	<div class="bg1">
		    <div class="main2">
              <!--content end-->
              <!--footer -->
			  
              <footer><table width="100%" border="0">
  <tr>
    <th width="19%" scope="row"><a href="http://www.cne.gov.co/CNE/" target="_blank"><img src="images/100px-Consejo_Nacional_Electoral.png" width="74" height="67" /></a></th>
    <td width="16%"><a href="http://www.registraduria.gov.co/" target="_blank"><img src="images/Logo-regis-trasnparente-ver.png" width="109" height="71" /></a></td>
    <td width="17%">
	<?php if($_SESSION['partido']=='Partido de la U'){?>
			<a href="http://www.partidodelau.com/" target="_blank"><img src="images/<?php echo $_SESSION['partido']?>.png" width="85" height="64"/></a>
	<?php }elseif($_SESSION['partido']=='Partido Liberal'){?>
			<a href="http://www.partidoliberalcolombiano.info/" target="_blank"><img src="images/<?php echo $_SESSION['partido']?>.png" width="85" height="64"/></a>
	<?php }?>
	</td>
    <td width="22%"><a href="http://www.camara.gov.co/portal2011/" target="_blank"><img src="images/logo congreso.png" width="156" height="48" /></a></td>
    <td width="26%"><a href="http://www.senado.gov.co/" target="_blank"><img src="images/LOGO SENADO.jpg" width="156" height="48" /></a></td>
  </tr>
</table>

           <!-- {%FOOTER_LINK} -->
              </footer>
			
              <!--footer end-->
           
			<div style="left:200px" align="center"> 
<table width="935" border="0" style="font-size:12px" align="center" style="border: 1px solid black; border-top-color:#FFFFFF">
  <tr style="border: 1px solid black; border-top-color:#FFFFFF">
    <th width="158">T&eacute;rminos de Uso &nbsp;&nbsp;&nbsp;&nbsp; | </th>
    <td width="404" >&nbsp;&nbsp;&nbsp;&nbsp;Declaraci&oacute;n de Privacidad &nbsp;&nbsp;&nbsp;&nbsp; | </td>
    <td width="359" align="right" >&copy;2010 SIGE. Todos los Derechos Reservados</td>
  </tr>
</table></div>
		
	</body>
</html>