<?php //PERMISOS DE INGRESO
/*$ArrayGrupo = array();
$ArrayGrupo = explode(', ',trim(@$_COOKIE['GRUPO']));
if((in_array(1,$ArrayGrupo) || in_array(24,$ArrayGrupo)))
{	$gestionador = 'SI';}
else
{	$gestionador = 'NO';}*/
$gestionador = 'SI';
?>
<!------------------------------------------------------->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<title>Solicitud de Visitas Tecnicas</title>
<script language="javascript" type="text/javascript" src="../javascript/showhide.js"></script>
<script language="javascript" type="text/javascript">
<!--
function validachar(objeto)
{	var campo = document.getElementById(objeto).value;
	var ubicacion;
	var enter = "\n";
	var caracteres = "abcdefghijklmnopqrstuvwxyz1234567890 ABCDEFGHIJKLMNOPQRSTUVWXYZ-_/.:"+String.fromCharCode(13)+enter;
	var contador = 0;
	for (var i=0; i < campo.length; i++)
	{	ubicacion = campo.substring(i, i + 1);

		if (caracteres.indexOf(ubicacion) != -1)
		{	contador++;}
		else
		{	alert("ERROR: No se acepta el caracter   '" + ubicacion + "'.");
			document.getElementById(objeto).value = '';
			return false;
		}
		if (i==0 && ubicacion== ' ')
		{	alert("ERROR: No se acepta el caracter espacio   '" + ubicacion + "'.")
			document.getElementById(objeto).value = '';
			return false;
		}
	}
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' debe ser una direccion electronica valida.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' debe ser numerico.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
  }
  if (errors) alert('ocurrieron los siguientes errores:\n'+errors);
  document.MM_returnValue = (errors == '');
}
function togle(id)
{ if(document.getElementById(id).checked)
  { document.getElementById(id).checked=false;}
  else
  { document.getElementById(id).checked=true;}
}
function radios(id)
{ document.getElementById(id).checked=true;
  if(id == 'ver')
  {	document.getElementById('ve').style.background='#00FFFF';
  	document.getElementById('usar').style.background='#FFFFFF';
  	document.getElementById('hace').style.background='#FFFFFF';
	Show('submitando');Hide('options');
  }
  if(id == 'usar')
  {	document.getElementById('usar').style.background='#00FFFF';
  	document.getElementById('ve').style.background='#FFFFFF';
  	document.getElementById('hace').style.background='#FFFFFF';
	Show('submitando');Show('options');
  }
  if(id == 'hacer')
  {	document.getElementById('hace').style.background='#00FFFF';
  	document.getElementById('ve').style.background='#FFFFFF';
  	document.getElementById('usar').style.background='#FFFFFF';
	Show('submitando');Show('options');
  }
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../gestion.css" rel="stylesheet" type="text/css">

</head>
<body link="#003366" vlink="#003366" alink="#003366" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="760" border="0" cellpadding="0" cellspacing="0" class="4lines" align="center">
  <tr>
    <td><img src="../Template/images/modulo_top.jpg" width="760" height="85"></td>
  </tr>
  <tr>
    <td height="20"><table width="250" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td class="txt"><a href="../indexadmin.php">volver
          a la princial</a> | <a href="../logout.php">logout</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>
<!--  Formulario de datos -->
<?php //INCLUDES
//include_once("../../constantes.inc.php");
//include_once("../include/funciones_old.inc.php");
include_once("../include/constantes_old.inc.php");
include_once("../Checksession.php");
//include_once(INCLUDES."Ajax.class.php");
//include_once(INCLUDES."funciones.inc.php");
//include_once(INCLUDES."RR.class.php");
$Permisos = AtenticacionUsuario();
/*
echo "<pre>";
print_r($Permisos);
echo "<pre>";
*/
echo "<font color='#FFFFFF'>.</font>";
?>
<?php //CONEXIONES
$atempAg = 0;
do{	$ConexionAgendamiento = OCILogon(UsuarioAgendamiento, PasswordAgendamiento, NombreDSNAgendamiento);
//do{	$ConexionAgendamiento = OCILogon('gestionnew', 'oracle', 'gestion');
	$atempAg++;
	if($atempAg > 90)
	{	// Redireccionar a una pagina diferente en el directorio actual de la peticion
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'gestion/problemas_conexion.php?bdgestion=1';
		//header("Location: http://$host/$extra");
		//exit;
	}
}while(!$ConexionAgendamiento);


$atempRR = 0;
do{	$ConexionAS400 = odbc_connect(NombreDSNAS400, "STORR77492", "SIW25283E2");
	$atempRR++;
	if($atempRR > 90)
	{	// Redireccionar a una pagina diferente en el directorio actual de la peticion
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'gestion/problemas_conexion.php?as400=1';
		//header("Location: http://$host/$extra");
		//exit;
	}
}while(!$ConexionAS400);
?>
<?php //EXTERNOS
//echo 'GALLETA';	Imprimir($_COOKIE);
//echo 'HTTP_POST';	Imprimir($HTTP_POST_FILES);
//echo 'POST';	Imprimir($_POST);
#echo 'GET';	Imprimir($_GET);
?>
<?php
if(array_key_exists('origen',$_GET))
{?>
	<table width="551" align="center" >
	 <tr>
	  <td  width="591" class="txt"><strong>Solicitud de Visitas Tecnicas</strong></td>
	 </tr>
	 <tr>
	  <td>&nbsp;</td>
	 </tr>
	 <tr>
	  <td height="31" class="txt">
	  Elija el tipo de gestion que desea realizar.	  </td>
	 </tr>
	</table>

	<form action="visitas_tecnicas_solicitud.php" method="post" id="tipoconsulta">
	<input type="hidden" name="inicial" value="1">
	<table class="4lines" align="center">
	 <tr align="left" class="txt">
	  <td align="center" bgcolor="#D0E9F2" colspan="3"><strong><p>ELIJA LA ACCION DESEADA<BR />
	<?php echo date('Y/m/d H:i:s');?></p></strong></td>
	 </tr>

	 <tr align="left" class="txt" style="display:none;" <?PHP if(time() < strtotime('2008/08/30 22:30:00')){ 
		echo "style='display:none;'"; } ?> >
	  <td width="10%" bgcolor="#D0E9F2">&nbsp;</td>
	  <td id="hace" style="cursor:pointer;" onClick="radios('hacer');">
	   <input style="display:none;" type="radio" name="action" id="hacer" value="solicita">
	   <strong>-Solicitar Visita Tecnica</strong>	  </td>
	  <td width="10%" bgcolor="#D0E9F2">&nbsp;</td>
	 </tr>
	<?php
	if($_GET['origen']==2 || $gestionador=='NO')
	{	$disp = 'style="display:none;"';
		$state = 'disabled="disabled"';
	}else
	{	$disp = '';
		$state = '';
	}
	?>
	<?php
	if(ValRolInterno('VTVI17')){
		$disp = '';
		$state = '';
	}else{
		$disp = 'style="display:none;"';
		$state = 'disabled="disabled"';
	}
	?>
	 <tr align="left" class="txt">
		  <td <?php echo $disp; ?> width="10%" bgcolor="#D0E9F2">&nbsp;</td>
		  <td <?php echo $disp; ?> id="usa" style="cursor:pointer;" onClick="radios('usar');">
		   <input <?php echo $state; ?> style="display:none;" type="radio" name="action" id="usar" value="gestiona">
		   <strong>-Gestionar Visita Tecnica</strong>		  </td>
		  <td <?php echo $disp; ?> width="10%" bgcolor="#D0E9F2">&nbsp;</td>
		 </tr>


	 <tr align="left" class="txt">
	  <td width="10%" bgcolor="#D0E9F2">&nbsp;</td>
	  <td id="ve" style="cursor:pointer;" onClick="radios('ver');">
	   <input style="display:none;" type="radio" name="action" id="ver" value="visualiza">
	   <strong>-Estado de la Solicitud</strong>	  </td>
	  <td width="10%" bgcolor="#D0E9F2">&nbsp;</td>
	 </tr>
	 <tr align="left" class="txt">
	  <td align="center" bgcolor="#D0E9F2" colspan="3">&nbsp;
	   <table  class="4lines" id="options" style="display:none;" bgcolor="#FFFFFF">
		<tr align="right">
		 <td style="cursor:pointer;" onClick="document.getElementById('vtcon').checked=true;" onMouseOut="this.style.background='#FFFFFF'" onMouseOver="this.style.background='#00FFFF'">
		  <strong>Visita Tecnica Edificio o Conjunto</strong>
		  <input checked="checked" type="radio" name="subaction" id="vtcon" value="vtcon">		 </td>
		</tr>
		<tr align="right">
		 <td style="cursor:pointer;" onClick="document.getElementById('vtrep').checked=true;" onMouseOut="this.style.background='#FFFFFF'" onMouseOver="this.style.background='#00FFFF'">
		  <strong>Visita Tecnica Replanteamiento</strong>
		  <input type="radio" name="subaction" id="vtrep" value="vtrep">		 </td>
		</tr>
		<tr align="right">
		 <td style="cursor:pointer;" onClick="document.getElementById('vtcasa').checked=true;" onMouseOut="this.style.background='#FFFFFF'" onMouseOver="this.style.background='#00FFFF'">
		  <strong>Visita Tecnica en Casas</strong>
		  <input type="radio" name="subaction" id="vtcasa" value="vtcasa">		 </td>
		</tr>
		<tr align="right" >
		 <td style="cursor:pointer;" onClick="document.getElementById('vercasa').checked=true;" onMouseOut="this.style.background='#FFFFFF'" onMouseOver="this.style.background='#00FFFF'">
		  <strong>Verificaciones Casas</strong>
		  <input type="radio" name="subaction" id="vercasa" value="vercasa">		 </td>
		</tr>
	   </table>	  </td>
	 </tr>

	 <tr style="display:none;" id="submitando" align="left" class="txt">
	  <td align="center" bgcolor="#D0E9F2" colspan="3">
	  <input type="submit" value="Realizar Accion">	  </td>
	</tr>
	</table>
	</form>
<?php
}?>

<?php
if(array_key_exists('inicial',$_POST) && $_POST['action'] == 'solicita')
{?>
	<form action="visitas_tecnicas_solicitud.php" method="post" onSubmit="MM_validateForm('nodoesp','','R','calle','','R','casa','','R','apto','','R','cuentamatriz','','RisNum','direccion','','R','telefono','','RisNum','contacto','','R','telcontacto','','RisNum','solicitante','','R','correo','','RisEmail','contacto1','','R','telcontacto1','','RisNum','motivo','','R');return document.MM_returnValue">
	  <table align="center" class="4lines">
        <?php
	if($_POST['subaction'] == 'vtcon')
	{	?>
        <input type="hidden" name="tiposolicitud" value="VTCONJUNTOS">
        <tr align="left" class="txt">
          <th colspan="2" align="center" bgcolor="#D0E9F2">SOLICITUD DE VISITA TECNICA PARA NUEVOS EDIFICIOS </th>
        </tr>
        <tr align="left" class="txt">
          <td width="416" bgcolor="#D0E9F2"><strong>Cuenta Matriz del Edificio:</strong>
              <input name="cuentamatriz" type="text" onBlur="MM_validateForm('cuentamatriz','','RisNum');return document.MM_returnValue" id="cuentamatriz2" size="10" maxlength="10">          </td>
        <td width="385" bgcolor="#D0E9F2"><table width="100%" height="100%">
            <tr>
			<? $fechaingreso = date('Y-m-d H:i'); ?>
              <th width="37%" class="txt"><strong>Fecha Creacion:</strong> </th>
              <th width="63%" class="txt">
                <input name="fechaingreso" type="text"  value="<? echo $fechaingreso ?>" id="fechaingreso" size="15" maxlength="15" readonly="readonly" >
              </th>
            </tr>
          </table></td>
        </tr>
        <?php
	}?>
        <?php
	if($_POST['subaction'] == 'vtrep')
	{	?>
        <input type="hidden" name="tiposolicitud" value="REPLANVTCON">
        <tr align="left" class="txt">
          <th colspan="2" align="center" bgcolor="#D0E9F2">SOLICITUD REPLANTEAMIENTO  DE VISITA TECNICA</th>
        </tr>
        <tr align="left" class="txt">

          <td bgcolor="#D0E9F2"><strong>Cuenta Matriz del Edificio:</strong>
          <input name="cuentamatriz" type="text" id="cuentamatriz" size="10" maxlength="10" onBlur="MM_validateForm('cuentamatriz','','RisNum');return document.MM_returnValue"> <table width="100%" height="100%">
            <tr>
              <? $fechaingreso = date('Y-m-d H:i'); ?>
             <td width="30%"><strong>Fecha Creacion:</strong></td>

                <td width="70%"><input name="fechaingreso" type="text"  value="<? echo $fechaingreso ?>" id="fechaingreso" size="15" maxlength="15" readonly="readonly" ></td>

            </tr>
          </table> </td>

		  <td align="center" bgcolor="#D0E9F2" class="txt">Movil:
            <input name="movil" type="text" id="movil" size="10" maxlength="10">
            &nbsp;
            Supervisor:
            <input name="supervisor" type="text" id="supervisor" size="30" maxlength="30">          </td>
        </tr>
        <?php
	}?>
        <?php
	if($_POST['subaction'] == 'vtrep' || $_POST['subaction'] == 'vtcon')
	{	?>
        <tr align="left" class="txt">
          <td bgcolor="#D0E9F2" class="txt"><strong>Direccion Completa:</strong>
              <input name="direccion" type="text" id="direccion" size="40" maxlength="40" onBlur="MM_validateForm('direccion','','R');return document.MM_returnValue">          </td>
          <td bgcolor="#D0E9F2"><table width="100%" height="100%">
              <tr>
                <th width="37%" class="txt">Telefono1: </th>
                <th width="63%" class="txt"> <input name="telefono" type="text" id="telefono" size="30" maxlength="30" onBlur="MM_validateForm('telefono','','RisNum');return document.MM_returnValue">                </th>
              </tr>
          </table></td>
        </tr>
        <tr align="left" class="txt">
          <td bgcolor="#D0E9F2"><strong>Direccion Alterna: </strong>
              <input name="direccion1" type="text" id="direccion1" size="40" maxlength="40">          </td>
          <td bgcolor="#D0E9F2"><table width="100%" height="100%">
              <tr>
                <th width="37%" class="txt">Telefono2:</th>
                <th width="63%" class="txt"> <input name="telefono1" type="text" id="telefono1" size="30" maxlength="30">                </th>
              </tr>
          </table></td>
        </tr>
        <tr align="left" class="txt">
          <td colspan="2" bgcolor="#D0E9F2"><table width="100%" height="100%">
              <tr>
                <th width="15%" class="txt"><strong>Administrador:</strong></th>
                <th width="30%" class="txt"> <input name="contacto1" type="text" id="contacto1" size="40" maxlength="40" onBlur="MM_validateForm('contacto1','','R');return document.MM_returnValue">                </th>
                <th width="26%" class="txt">Telefono Administrador:</th>
                <th width="29%" class="txt"> <input name="telcontacto1" type="text" id="telcontacto1" size="30" maxlength="30" onBlur="MM_validateForm('telcontacto1','','RisNum');return document.MM_returnValue">                </th>
              </tr>
          </table></td>
        </tr>
        <?php
	}?>
        <?php
	if($_POST['subaction'] == 'vtcasa')
	{	?>
        <input type="hidden" name="tiposolicitud" value="VTCASA">
        <tr align="left" class="txt">
          <th colspan="2" align="center" bgcolor="#D0E9F2">SOLICITUD  VISITA TECNICA EN CASA </th>
        </tr>
        <tr align="left" class="txt">
          <td bgcolor="#D0E9F2"><strong>Direccion Completa:</strong>
              <input name="direccion" type="text" id="direccion" size="40" maxlength="40" onBlur="MM_validateForm('direccion','','R');return document.MM_returnValue"> <table width="100%" height="100%">
                <tr>
                  <? $fechaingreso = date('Y-m-d H:i'); ?>
                  <td width="30%"><strong>Fecha Creacion:</strong></td>

                <td width="70%"> <input name="fechaingreso" type="text"  value="<? echo $fechaingreso ?>" id="fechaingreso" size="15" maxlength="15" readonly="readonly" ></td>
                 </tr>

              </table></td>
          <td align="center" bgcolor="#D0E9F2"><table width="100%" height="100%">
              <tr>
                <th class="txt">Telefono1: </th>
                <th class="txt"> <input name="telefono" type="text" id="telefono" size="30" maxlength="30"onblur="MM_validateForm('telefono','','RisNum');return document.MM_returnValue">                </th>
              </tr>
          </table></td>
        </tr>
        <tr align="left" class="txt">
          <td bgcolor="#D0E9F2"><strong>Direccion Alterna1:</strong>
              <input name="direccion1" type="text" id="direccion1" size="40" maxlength="40">          </td>
          <td bgcolor="#D0E9F2"><table width="100%" height="100%">
              <tr>
                <th class="txt">Telefono2:</th>
                <th class="txt"> <input name="telefono1" type="text" id="telefono1" size="30" maxlength="30">                </th>
              </tr>
          </table></td>
        </tr>
        <?php
	}?>
        <?php
	if($_POST['subaction'] == 'vercasa')
	{?>
        <input type="hidden" name="tiposolicitud" value="REPLANVTCASA">
        <tr align="left" class="txt">
          <th colspan="2" align="center" bgcolor="#D0E9F2">SOLICITUD DE VERIFICACION CASAS </th>
        </tr>
        <tr align="left" class="txt">
         <td bgcolor="#D0E9F2"><input style="display:none;" type="radio" name="action" id="radio7" value="solicita">
		 <table width="100%" height="100%" >
		  <tr>
		   <th width="33%" class="txt"><strong>Direccion Completa:</strong></th>
		   <th width="67%" class="txt"><input name="calle" type="text" id="calle" size="10" maxlength="15" onBlur="MM_validateForm('calle','','R');return document.MM_returnValue">&nbsp;<input name="casa" type="text" id="casa" size="10" maxlength="15" onBlur="MM_validateForm('casa','','R');return document.MM_returnValue">&nbsp;<input name="apto" type="text" id="apto" size="10" maxlength="15" onBlur="MM_validateForm('apto','','R');return document.MM_returnValue">
		   </th>
		  </tr>
		 </table>
		 </td>
		 <td bgcolor="#D0E9F2"><strong>Nodo:</strong> <input name="nodoesp" type="text" id="nodoesp" size="6" maxlength="6" onBlur="MM_validateForm('nodoesp','','R');return document.MM_returnValue">
		   <table width="66%" height="100%">
             <tr>
               <? $fechaingreso = date('Y-m-d H:i'); ?>
               <th><strong>Fecha Creacion:</strong></th>
                   <th><input name="fechaingreso" type="text"  value="<? echo $fechaingreso ?>" id="fechaingreso" size="15" maxlength="15" readonly="readonly" >               </th>
             </tr>
           </table>
		   <div><strong>Direccion Alterna:<input name="direccion1" type="text" id="direccion1" size="40" maxlength="40"></strong></div>
		 </strong></td>
        </tr>
        <?php
	}?>
        <tr align="left" class="txt">
          <td colspan="2" bgcolor="#D0E9F2"><table width="100%" height="100%" >
              <tr>
                <th width="15%" class="txt">Contacto:</th>
                <th width="30%" class="txt"><input name="contacto" type="text" id="contacto" size="40" maxlength="40" onBlur="MM_validateForm('contacto','','R');return document.MM_returnValue">                </th>
                <th width="26%" class="txt">Telefono Contacto:</th>
                <th width="29%" class="txt"><input name="telcontacto" type="text" id="telcontacto" size="30" onBlur="MM_validateForm('telcontacto','','RisNum');return document.MM_returnValue">                </th>
              </tr>
          </table></td>
        </tr>
        <tr align="left" class="txt">
          <td colspan="2" bgcolor="#D0E9F2"><table width="100%" height="100%" >
              <tr>
                <th width="15%" class="txt"><strong>Solicitante:</strong></th>
                <th width="30%" class="txt"> <input name="solicitante" type="text" id="solicitante" size="40" maxlength="40" onBlur="MM_validateForm('solicitante','','R');return document.MM_returnValue">                </th>
                <th width="25%" class="txt">Correo Solicitante:</th>
                <th width="30%" class="txt"> <input name="correo" type="text" id="correo" size="40" maxlength="40" onBlur="MM_validateForm('correo','','NisEmail');return document.MM_returnValue" value="@cable.net.co">                </th>
              </tr>
          </table></td>
        </tr>
        <?php
	if($_POST['subaction'] == 'vtcasa' || $_POST['subaction'] == 'vtrep' || $_POST['subaction'] == 'vtcon')
	{	?>
        <tr align="left" class="txt">
          <td colspan="2" align="center" bgcolor="#D0E9F2"><div align="center" style="cursor:pointer;" onClick="document.getElementById('motivo').value='||DOCUMENTO ANEXO|| \r\n'"> <a target="new" href="../visitas_tecnicas/ingresar_documento.asp">Ingresar Documento</a> </div></td>
        </tr>
        <tr align="left" class="txt">
          <td colspan="2" align="center" bgcolor="#D0E9F2"><strong>Motivo de la Solicitud (NO se permite el uso de la '&ntilde;' o caracteres especiales):</strong><br>
              <textarea name="motivo" cols="130" id="motivo" onBlur="validachar('motivo');"></textarea>          </td>
        </tr>
        <?php
	}?>
        <tr align="CENTER" class="txt">
          <td colspan="2" bgcolor="#FFFFFF" class="txt"></td>
        </tr><?PHP
        if(time() < strtotime('2008/08/30 22:30:00')){?>
        <tr align="left" class="txt">
          <td height="32" colspan="2" align="center" bgcolor="#D0E9F2"><input name="submit" type="submit" value="Ingresar Datos"></td>
        </tr><?PHP
        }?>
      </table>
	</form>

<?php
}?>

<?php
if(array_key_exists('submit',$_POST) && array_key_exists('solicitante',$_POST))
{	$flag = 1;
?>
	<?php
	if(@$_POST['cuentamatriz'] <> '')
	{
		$QueryDataEd = "SELECT STSTNM as CALLE, EDHOME AS CASA, EDTEL1 AS TELEFONO, EDNOCO AS CONTACTO, EDNODO AS NODO, EDTUNI AS UNIDADES FROM TVCABLEDTA.TCEDFF00 JOIN CABLEDTA.STRTMSTR ON STSTRÑ = EDCALL WHERE  EDCODG = ".$_POST['cuentamatriz']."";
		//echo "<br>".$QueryDataEd; // OBTIENE DATOS DEL EDIFICIO
		$RsDataEd = odbc_do($ConexionAS400, $QueryDataEd);
		$DataEd = array();
		$DataEd = odbc_fetch_array($RsDataEd);

		if($DataEd == array())
		{	$flag = 0;?>
			<h3 align="center">La cuenta matiz ingresada <?php echo $_POST['cuentamatriz'] ?> no retorna datos en la base de datos de edificios, por favor ingrese una cuenta matriz valida.<br><a href="visitas_tecnicas_solicitud.php?origen=2">Volver al Menu</a></h3>
			<?php
		}else
		{	$flag = 1;}
	}?>
	<?php
	if($flag == 1)
	{	if(array_key_exists('casa',$_POST))
		{	$direccion = $_POST['calle']." ".$_POST['casa']." ".$_POST['apto'];}
		else
		{	$direccion = $_POST['direccion'];}

		if(array_key_exists('nodoesp',$_POST))
		{	$movil = $_POST['nodoesp'];}
		else
		{	$movil = @$_POST['movil'];}

		$fechaing=explode(' ',$_POST['fechaingreso']);
		$fechaing[1]=substr($fechaing[1],0,2).':00:00';
		$fechaing=implode(' ',$fechaing);

		$Query = "insert into SOLICITUDES_VT (IDSOLICITUD,TIPO,ESTADO ,CUENTAMATRIZ ,DIRECCION ,TELEFONO ,DIRECCION1 ,TELEFONO1 ,CONTACTO ,TELCONTACTO ,CONTACTO1 ,TELCONTACTO1 ,SOLICITANTE ,CORREO ,MOVIL ,SUPERVISOR ,MOTIVO,FECHAINGRESO) values(solicitudes_vt_seq.nextval,'".@$_POST['tiposolicitud']."' ,'PENDIENTE' ,'".@$_POST['cuentamatriz']."' ,'".$direccion."' ,'".@$_POST['telefono']."' ,'".@$_POST['direccion1']."' ,'".@$_POST['telefono1']."' ,'".@$_POST['contacto']."' ,'".@$_POST['telcontacto']."' ,'".@$_POST['contacto1']."' ,'".@$_POST['telcontacto1']."' ,'".@$_POST['solicitante']."' ,'".@$_POST['correo']."' ,'".$movil."' ,'".@$_POST['supervisor']."' ,'".@$_POST['motivo']."',TO_DATE('".$fechaing."','YYYY/MM/DD HH24:MI:SS'))";
		echo "<br>".$Query;
		$QueryInsert = OCIParse($ConexionAgendamiento,$Query);
		OCIExecute($QueryInsert, OCI_DEFAULT);

		$Query2 = "select solicitudes_vt_seq.currval from dual";
		$QueryIdSolicitud = OCIParse($ConexionAgendamiento,$Query2);
		OCIExecute($QueryIdSolicitud, OCI_DEFAULT);
		OCIFetchInto($QueryIdSolicitud,$row,OCI_ASSOC);
		$IdSolicitud = $row['CURRVAL'];
		OCICommit($ConexionAgendamiento);


	////////////////////////////////////////////RUTINA DE ENVIO DE CORREO AL INTERESADO///////////////////////////////////////////////////////////////////
	$Desde = 'TVCable Visitas Tecnicas|JUANK@cable.net.co';
	$ParaQuienArray = array(str_replace('?','ñ',$_POST['correo']));
	$Titulo = "Visita Tecnica Ingresada";
	$HTML = true;
	$CCArray = array();
	$CCOArray = array();//'juank@cable.net.co');
	$Attachment = array();
	$Cuerpo = "<strong>Atencion!</strong><br>Por medio de este correo se le informa que la <strong>solicitud de visita tecnica</strong> numero <strong>-'".$IdSolicitud."'-</strong>, ha sido ingresada.<br>Puede consultar los datos y el estado de esta visita desde el modulo correspondiente.<br>http://agendamiento.cable.net.co/gestion/login.asp - MODULO GESTION<br>http://agendamiento.cable.net.co/gestion/login_digitacion.asp - MODULO AUTODIGITACION<br><br>Att.<br> Modulo de Gestion - Visitas Tecnicas.";
	EnviarCorreo($Desde, $ParaQuienArray, $Titulo, $Cuerpo, $HTML, $CCArray, $CCOArray, $Attachment);
	echo $Cuerpo;
	//////////////////////////////////////FIN RUTINA DE ENVIO DE CORREO AL INTERESADO///////////////////////////////////////////////////////////////////


		//echo "<br>La solicitud es: ".$IdSolicitud;
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "visitas_tecnicas_solicitud.php?finalizado=".$IdSolicitud;
//		$extra = "visitas_tecnicas_solicitud.php?finalizado=".$Query;
//		Imprimir($QueryInsert);
//		Imprimir($QueryIdSolicitud);
//		Imprimir($IdSolicitud);
		//header("Location: http://$host$uri/$extra");
		echo "<script language='JavaScript1.2'>";
		echo "document.location='http://".$host.$uri."/".$extra."'";
		echo "</script>";
		exit;
	}

}?>
<?php
if(array_key_exists('inicial',$_POST) && $_POST['action'] == 'gestiona')
{	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = "visitas_tecnicas_gestion.php?tipo=".$_POST['subaction'];
//	header("Location: http://$host$uri/$extra");
	echo "<script language='JavaScript1.2'>";
	echo "document.location='http://".$host.$uri."/".$extra."'";
	echo "</script>";
	exit;
}?>
<?php
if(array_key_exists('inicial',$_POST) && $_POST['action'] == 'visualiza')
{	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = "visitas_tecnicas_buscar.php?tipo=".$_POST['subaction'];
	//header("Location: http://$host$uri/$extra");
	echo "<script language='JavaScript1.2'>";
	echo "document.location='http://".$host.$uri."/".$extra."'";
	echo "</script>";
	exit;
}?>
<?php
if(array_key_exists('finalizado',$_GET))
{	?>
	<table width="551" align="center" >
	 <tr>
	  <td  width="591" class="txt"><strong>Solicitud Exitosamente Ingresada</strong></td>
	 </tr>
	 <tr>
	  <td height="30">&nbsp;</td>
	 </tr>
	 <tr>
	  <td height="31" class="txt">
	  La solicitud realizada se encuentra ahora en el sistema. Por favor tome nota del numero de solicitud para visualizar los datos ingresados.	  </td>
	 </tr>
	</table> <br>
	<table class="4lines" align="center">
	 <tr>
	  <td bgcolor="#D0E9F2" class="txt">
	  <table width="100%" height="100%">
	   <tr>
		<td bgcolor="#D0E9F2" class="txt"><strong>Numero Solicitud:</strong></td>
	   </tr>
	   <tr>
		<td bgcolor="#FFFFFF" align="center"><strong><?php echo $_GET['finalizado']; ?></strong></td>
	   </tr>
	  </table>	  </td>

	 </tr>
	</table>
	<br>
	<h3 align="center"><a href="visitas_tecnicas_solicitud.php?origen=2">Volver al Menu</a></h3>
<?php
}?>

<?php
OCILogOff($ConexionAgendamiento);
odbc_close_all();
?>
</td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td bgcolor="#333333" class="txt">
<div align="center"><font color="#FFFFFF">Copyright &copy; 2003 TV Cable S.A.
        - Todos los Derechos Reservados</font></div></td>
  </tr>
</table>
<p align="center">&nbsp; </p>
<p>&nbsp;</p>
</body>

</html>

