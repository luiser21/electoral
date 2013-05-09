<form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<img style="position:absolute; left: 320px; top: 200px;" src="img/login.png" width="587" height="357">
<DIV style="position:absolute; left: 630px; top: 270px; width: 176px; font-size:14px; font-weight:bold">SISTEMA DE GESTION</DIV>
<div style="position:absolute; left: 600px; top: 300px; font-size:12px; font-weight:bold">Usuario :</div>
<div id="camp1" style="position:absolute; left: 600px; top: 320px; background-color:#d52b1e"> 
<table width="178" border="0">
 <tr id="cam1" style="border-color:#d52b1e">
  <td><input name="login" type="text" id= "login" size="30" autocomplete="off" title="Usuario" onChange="quitar()"  /></td>
 </tr>
</table>
</div>

<div id="error1" style="position:absolute; left: 820px; top: 310px; width: 123px; height: 26px; visibility:hidden">
<table border="0">
  <tr>
     <td><div align="center"><img src="../images/error.png" width="23" height="22"></div></td>
	 <td bgcolor="#d52b1e" bordercolor="#d52b1e"><div align="center"><span class="Estilo5">Por Favor Ingrese su usuario</span></div></td>
  </tr>
</table>
</span></div>




<div style="position:absolute; left: 600px; top: 350px; font-size:12px; font-weight:bold">Contrase&ntilde;a : </div>

<div id="cam2" style="position:absolute; left: 600px; top: 370px; background-color:#d52b1e">
<table width="140" border="0">
 <tr bgcolor="#d52b1e">
  <td><input name="password" type="password" id="password" title="Contraseña" onChange="quitar1()" /></td>
 </tr>
</table>
</div>

<div id="error2" style="position:absolute; left: 760px; top: 365px; width: 123px; height: 26px; visibility:hidden">
<table border="0">
  <tr>
     <td><div align="center"><img src="../images/error.png" width="23" height="22"></div></td>
	 <td bgcolor="#d52b1e" bordercolor="#d52b1e"><div align="center"><span class="Estilo5">Por Favor Ingrese su Contraseña</span></div></td>
  </tr>
</table>
</span></div>




<div style="position:absolute; left: 630px; top: 420px;">
  <input type="button" name="Submit" value="Aceptar" onClick="verif()">
</div>
<div style="position:absolute; left: 710px; top: 420px;">
  <input type="button" name="Submit" value="Volver" onClick="cancel()">
</div>
</form>