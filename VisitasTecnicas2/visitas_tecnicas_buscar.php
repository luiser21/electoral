<?php //PERMISOS DE INGRESO
/* 
if(!isset($_COOKIE['GRUPO']))
{	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = "gestion/denegado2.asp";
	header("Location: http://$host/$extra");
	exit;
	//echo "http://$host/$extra";
}
$ArrayGrupo = explode(', ',trim($_COOKIE['GRUPO']));
if(in_array(1,$ArrayGrupo) || in_array(8,$ArrayGrupo) || in_array(18,$ArrayGrupo))
{	//print_r($ArrayGrupo);}
else
{	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = "gestion/denegado2.asp";
	header("Location: http://$host/$extra");
	exit;
	//echo "http://$host/$extra";
}
 */
?>
<!------------------------------------------------------->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<title>Busqueda de las Visitas Tecnicas</title>
<script language="javascript" type="text/javascript" src="../javascript/showhide.js"></script>
<script language="javascript" type="text/javascript">
<!--
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
  	document.getElementById('usa').style.background='#FFFFFF';
  	document.getElementById('hace').style.background='#FFFFFF';
	Show('submitando');Show('options');
  }
  if(id == 'usar')
  {	document.getElementById('usa').style.background='#00FFFF';
  	document.getElementById('ve').style.background='#FFFFFF';
  	document.getElementById('hace').style.background='#FFFFFF';
	Show('submitando');Show('options');
  }
  if(id == 'hacer')
  {	document.getElementById('hace').style.background='#00FFFF';
  	document.getElementById('ve').style.background='#FFFFFF';
  	document.getElementById('usa').style.background='#FFFFFF';
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
include_once("../includes/constantes_old.inc.php");
include_once("../includes/gestion.new.class.php");
$Dbgestion= new GestionBD('AGENDAMIENTO');

//include_once("../../funciones.inc.php");
?>
<?php //CONEXIONES
/*$atempAg = 0;
do{	$ConexionAgendamiento = OCILogon(UsuarioAgendamiento, PasswordAgendamiento, NombreDSNAgendamiento);
//do{	$ConexionAgendamiento = OCILogon('gestionnew', 'oracle', 'gestion');
	$atempAg++;
	if($atempAg > 90)
	{	// Redireccionar a una pagina diferente en el directorio actual de la peticion
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'gestion/problemas_conexion.php?bdgestion=1';
		header("Location: http://$host/$extra");
		exit;
	}
}while(!$ConexionAgendamiento);
*/
/*$atempRR = 0;
do{	$ConexionAS400 = odbc_connect(NombreDSNAS400, UsuarioAS400, PasswordAS400);
	$atempRR++;
	if($atempRR > 90)
	{	// Redireccionar a una pagina diferente en el directorio actual de la peticion
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'gestion/problemas_conexion.php?as400=1';
		header("Location: http://$host/$extra");
		exit;
	}
}while(!$ConexionAS400);
*/
?>
<?php //EXTERNOS
//echo 'GALLETA';	Imprimir($_COOKIE); 
//echo 'HTTP_POST';	Imprimir($HTTP_POST_FILES); 
//echo 'POST';	Imprimir($_POST); 
//echo 'GET';	Imprimir($_GET);
$fechahora = date('Y-m-d H:i');
$fecha = date('Y-m-d');
?>

<?php 
if(array_key_exists('tipo',$_GET))
{?>
	<table width="551" align="center" >
	 <tr>
	  <td  width="591" class="txt"><strong>B&uacute;squeda de la Solicitud</strong></td>
	 </tr>
	 <tr>
	  <td>&nbsp;</td>
	 </tr>
	 <tr>
	  <td height="31" class="txt">
	  Ingrese el n&uacute;mero de la solicitud. Este es el n&uacute;mero que se muestra desp&uacute;es del ingreso, y en caso de contestaci&oacute;n aparece en el correo de confirmaci&oacute;n recibido por el interesado.
	  </td>
	 </tr>
	</table> 
	
	<form action="visitas_tecnicas_buscar.php" method="post" onSubmit="MM_validateForm('idsolicitud','','RisNum');return document.MM_returnValue;">
	<table align="center" class="4lines">
	 <tr align="left" class="txt">
	  <th height="28" align="center" bgcolor="#D0E9F2">NUMERO DE SOLICITUD</th>
	 </tr>
	 <tr align="left" class="txt">
	  <th align="center" bgcolor="#D0E9F2">
	  <input type="text" size="3" name="idsolicitud" onBlur="MM_validateForm('idsolicitud','','RisNum');return document.MM_returnValue">
	  </th>
	 </tr>
	 <tr align="left" class="txt">
	  <th align="center" bgcolor="#D0E9F2"><input type="submit" value="Buscar"></th>
	 </tr>
	</table>
	</form>
<?php 
}?>
<?php 
$_POST["idsolicitud"]='4';

if(array_key_exists('idsolicitud',$_POST))
{	//$QUERY = "select * from SOLICITUDES_VT where IDSOLICITUD = ".$_POST['idsolicitud'];
	//$QuerySolicitud = OCIParse($ConexionAgendamiento,$QUERY);
	//OCIExecute($QuerySolicitud,OCI_DEFAULT);
	$sql="SELECT * from candidato where TIPOCANDIDATO=".$_POST["idsolicitud"]."";
	
	$Solicitud = array();
	$Dbgestion->ConsultaArray($sql);
	$consulta=$Dbgestion->datos;
	foreach ($consulta as $Solicitud){
		$Solicitud=$Solicitud;
	}
	//OCIFetchInto($QuerySolicitud,$Solicitud,OCI_ASSOC);
	//echo 'SOLICITUD: ';Imprimir($Solicitud);
	imprimir($Solicitud);

	if($Solicitud == array())
	{	?>
	
		<h3 align="center">
		El codigo de solicitud <?php echo $_POST['idsolicitud']; ?>, no corresponde con ninguna solicitud presente en la base de datos.<br>
		<a href="visitas_tecnicas_buscar.php?tipo=1">Ingresar otro Codigo</a>
		</h3>
		<?php 
	}else
	{	?>
		<table class="4lines" align="center">
		 <tr align="left" class="txt">
		  <th align="center" bgcolor="#D0E9F2" colspan="2"><strong>
		<?php if($Solicitud['ID'] == 'VTCONJUNTOS'){?>VISITA TECNICA EN CONJUNTO<?php }?>
		<?php if($Solicitud['ID'] == 'REPLANVTCON'){?>REPLANTEAMIENTO DE VISITA TECNICA EN CONJUNTO<?php }?>
		<?php if($Solicitud['ID'] == 'VTCASA'){?>VISITA TECNICA CASA<?php }?>
		<?php if($Solicitud['ID'] == 'REPLANVTCASA'){?>REPLANTEAMIENTO DE VISITA TECNICA CASA<?php }?>
		  </strong></th>
		 </tr>
		 <tr class="txt">
		  <td align="left" bgcolor="#D0E9F2"><strong>Numero de Solicitud:</strong></td>
		  <td align="center" bgcolor="#D0E9F2"><strong style="font-size:14px;"><?php echo $Solicitud['ID']; ?></strong></td>
		 </tr>
		 <tr class="txt">
		  <td align="left" bgcolor="#D0E9F2"><strong>Estado de la Solicitud:</strong></td>
		  <td align="center" bgcolor="#D0E9F2"><strong style="font-size:14px;"><?php echo $Solicitud['NOMBRES']; ?></strong></td>
		 </tr>
		<?php
		
		if(isset($Solicitud['CUENTAMATRIZ']))
		{	$QueryDataEd = "SELECT STSTNM as CALLE, EDHOME AS CASA, EDTEL1 AS TELEFONO, EDNOCO AS CONTACTO, EDNODO AS NODO, EDTUNI AS UNIDADES FROM TVCABLEDTA.TCEDFF00 JOIN CABLEDTA.STRTMSTR ON STSTRÑ=EDCALL WHERE  EDCODG=".$Solicitud['CUENTAMATRIZ'];
			//echo "<br>".$QueryDataEd; // OBTIENE DATOS DEL EDIFICIO
			$RsDataEd = odbc_do($ConexionAS400, $QueryDataEd);
			$DataEd = array();
			$DataEd = odbc_fetch_array($RsDataEd);
	
			$QuerySubEd = "SELECT COUNT(SENOMB) AS TORRES FROM TVCABLEDTA.TCSEDF00 WHERE SECODG = ".$Solicitud['CUENTAMATRIZ']."";
			//echo "<br>".$QuerySubEd; // OBTIENE EL LISTADO DE LOS NOMBRES DE LOS SUBEDIFICIOS
			$RsSubEd = odbc_do($ConexionAS400, $QuerySubEd);
			$DataEd['TORRES'] = odbc_result($RsSubEd,"TORRES");
		
			$QueryProducto = "SELECT TPNOMB AS PRODUCTO FROM  TVCABLEDTA.TCEDFL00 JOIN TVCABLEDTA.TCTPDL00 ON EDCOF6=TPCODG WHERE EDCODG=".$Solicitud['CUENTAMATRIZ']."";
			//echo "<br>".$QueryProducto; // OBTIENE EL LISTADO DE LOS NOMBRES DE LOS SUBEDIFICIOS
			$RsProducto = odbc_do($ConexionAS400, $QueryProducto);
			$DataEd['PRODUCTO'] = odbc_result($RsProducto,"PRODUCTO");
			//echo "<br>Datos del edificio:";Imprimir(@$DataEd);
			?>
			 <tr align="center" class="txt">
			  <td align="center" bgcolor="#D0E9F2" colspan="2">
			  <table align="center">
			   <tr>
				<td align="center" bgcolor="#D0E9F2" colspan="2"><strong>Datos del Edificio</strong></td>
			   </tr>
                  <tr>
                    <td colspan="2" align="left" bgcolor="#D0E9F2"><table width="100%" border="0">
                      <tr>
                        <th width="25%"><strong>CuentaMatriz:</strong></th>
                        <th width="25%" bgcolor="#FFFFFF"><strong><?php echo $Solicitud['CUENTAMATRIZ']; ?></strong></th>
                        <th width="25%"><strong>Nodo:</strong></th>
                        <th width="25%" bgcolor="#FFFFFF"><strong><?php echo $DataEd['NODO']; ?></strong></th>
                      </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td colspan="2" align="left" bgcolor="#D0E9F2"><table width="100%" border="0">
                      <tr>
                        <th width="25%"><strong>Unidades:</strong></th>
                        <th width="25%" bgcolor="#FFFFFF"><strong><?php echo $DataEd['UNIDADES']; ?></strong></th>
                        <th width="25%"><strong>Torres:</strong></th>
                        <th width="25%" bgcolor="#FFFFFF"><strong><?php echo $DataEd['TORRES']; ?></strong></th>
                      </tr>
                    </table></td>
                    </tr>
			   <tr>
				<td align="left" bgcolor="#D0E9F2"><strong>Producto:</strong></td>
				<td align="center" bgcolor="#FFFFFF"><?php echo $DataEd['PRODUCTO']; ?></td>
			   </tr>
			   <tr>
				<td align="left" bgcolor="#D0E9F2"><strong>Telefono:</strong></td>
				<td align="center" bgcolor="#FFFFFF"><?php echo $DataEd['TELEFONO']; ?></td>
			   </tr>
			   <tr>
				<td align="left" bgcolor="#D0E9F2"><strong>Direccion:</strong></td>
				<td align="center" bgcolor="#FFFFFF"><?php echo $DataEd['CALLE']." ".$DataEd['CASA']; ?></td>
			   </tr>
			   <tr>
				<td align="left" bgcolor="#D0E9F2"><strong>Contacto:</strong></td>
				<td align="center" bgcolor="#FFFFFF"><?php echo $DataEd['CONTACTO']; ?></td>
			   </tr>
			  </table>			  </td>
			 </tr>
			<?php 
		}?>
		 <tr align="left" class="txt">
		  <td align="center" bgcolor="#D0E9F2" colspan="2"><strong>DATOS INGRESADOS</strong></td>
		 </tr>
		 <tr class="txt">
		  <td align="left" bgcolor="#D0E9F2"><strong>Direccion Completa:</strong></td>
		  <td align="center"><?php echo @$Solicitud['DIRECCION']; ?></td>
		 </tr>
		<?php 
		if($Solicitud['TIPO'] <> 'VTCASA')
		{?>
			 <tr class="txt">
			  <td align="left" bgcolor="#D0E9F2"><strong>Telefono1 :</strong></td>
			  <td align="center"><?php echo @$Solicitud['TELEFONO']; ?></td>
			 </tr>
			 <tr class="txt">
			  <td align="left" bgcolor="#D0E9F2"><strong>Direccion Alterna:</strong></td>
			  <td align="center"><?php echo @$Solicitud['DIRECCION1']; ?></td>
			 </tr>
		<?php 
		}?> 
		<?php 
		if($Solicitud['TIPO'] <> 'VTCASA' && $Solicitud['TIPO'] <> 'REPLANVTCASA')
		{?>
			 <tr class="txt">
			  <td align="left" bgcolor="#D0E9F2"><strong>Telefono2 :</strong></td>
			  <td align="center"><?php echo @$Solicitud['TELEFONO1']; ?></td>
			 </tr>
			 <tr class="txt">
			  <td align="left" bgcolor="#D0E9F2"><strong>Administrador:</strong></td>
			  <td align="center"><?php echo $Solicitud['CONTACTO1']; ?></td>
			 </tr>
			 <tr class="txt">
			  <td align="left" bgcolor="#D0E9F2"><strong>Telefono Administrador:</strong></td>
			  <td align="center"><?php echo $Solicitud['TELCONTACTO1']; ?></td>
			 </tr>
		<?php 
		}?> 
		 <tr class="txt">
		  <td align="left" bgcolor="#D0E9F2"><strong>Contacto:</strong></td>
		  <td align="center"><?php echo $Solicitud['CONTACTO']; ?></td>
		 </tr>
		 <tr class="txt">
		  <td align="left" bgcolor="#D0E9F2"><strong>Telefono del Contacto:</strong></td>
		  <td align="center"><?php echo $Solicitud['TELCONTACTO']; ?></td>
		 </tr>
		<?php 
		if($Solicitud['TIPO'] == 'REPLANVTCON')
		{?>
			 <tr bgcolor="#D0E9F2" class="txt">
			  <td align="left"><strong>Supervisor:&nbsp;<?php echo @$Solicitud['SUPERVISOR']; ?></strong></td>
			  <td align="left"><strong>Movil:&nbsp;<?php echo @$Solicitud['MOVIL']; ?></strong></td>
			 </tr>
		<?php 
		}?> 

		<?php 
		if($Solicitud['TIPO'] == 'REPLANVTCASA')
		{?>
			 <tr class="txt">
			  <td bgcolor="#D0E9F2" align="left"><strong>Nodo Registrado:</strong></td>
			  <td align="center"><strong><?php echo @$Solicitud['MOVIL']; ?></strong></td>
			 </tr>
		<?php 
		}?> 

		<?php 
		if($Solicitud['TIPO'] == 'REPLANVTCON' || $Solicitud['TIPO'] == 'VTCASA' || $Solicitud['TIPO'] == 'VTCONJUNTOS')
		{?>
			 <tr class="txt">
			  <td align="center" bgcolor="#D0E9F2" colspan="2"><strong>Motivo:</strong></td>
			 </tr>
			 <tr class="txt">
			  <td align="center" colspan="2">
			  <textarea readonly="readonly" cols="40" rows="3"><?php echo $Solicitud['MOTIVO']; ?></textarea>
			  </td>
			 </tr>
		<?php 
		}?> 
		 <tr class="txt">
		  <td align="left" bgcolor="#D0E9F2"><strong>Solicitante:</strong></td>
		  <td align="center"><?php echo $Solicitud['SOLICITANTE']; ?></td>
		 </tr>
		 <tr class="txt">
		  <td align="left" bgcolor="#D0E9F2"><strong>Correo del Solicitante:</strong></td>
		  <td align="center"><?php echo $Solicitud['CORREO']; ?></td>
		 </tr>
		 <tr align="left" class="txt">
		  <td align="center" bgcolor="#D0E9F2" colspan="2">
		<?php 
		if(isset($Solicitud['RESPUESTA']))
		{	?>
			<strong>RESPUESTA</strong><br>
			<textarea readonly="readonly" cols="40" rows="5"><?php echo $Solicitud['RESPUESTA']; ?></textarea>
		   <?php 
		}?>
		  </td>
		 </tr>
		 <tr class="txt">
		  <td colspan="2" align="center" bgcolor="#D0E9F2"><input type="button" value="TERMINAR" onClick="document.location='visitas_tecnicas_buscar.php?tipo=1';"></td>
		 </tr>
		</table>	
		<?php
	} 
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
