<?php //PERMISOS DE INGRESO
/*if(!isset($_COOKIE['GRUPO']))
{	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = "gestion/denegado2.asp";
	header("Location: http://$host/$extra");
	exit;
	//echo "http://$host/$extra";
}
/*$ArrayGrupo = explode(', ',trim($_COOKIE['GRUPO']));
if(in_array(1,$ArrayGrupo) || in_array(24,$ArrayGrupo))
{	/*print_r($ArrayGrupo);*///}
/*else
{	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = "gestion/denegado2.asp";
	header("Location: http://$host/$extra");
	exit;
	//echo "http://$host/$extra";
}*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<title>Gestion de Visitas Tecnicas</title>
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
include_once("../include/ConfgGral.conf.php");
include_once("../include/constantes_old.inc.php");
include_once(INCLUDES."funciones.inc.php");
//include_once("../../funciones.inc.php");
$fechahora = "|".date('Y-m-d H:i')."|"."\r\n";
?>
<?php //EXTERNOS
//echo 'GALLETA';	Imprimir($_COOKIE); 
//echo 'HTTP_POST';	Imprimir($HTTP_POST_FILES); 
//echo 'POST';Imprimir($_POST); 
//echo 'GET';Imprimir($_GET);
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
		header("Location: http://$host/$extra");
		exit;
	}
}while(!$ConexionAgendamiento);

$atempRR = 0;
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
?>
<?php 
if(array_key_exists('tipo',$_GET))
{?>
        <?php	
	switch($_GET['tipo'])
	{	
		case 'vtcon': $tipo= 'VTCONJUNTOS'; $vertipo= 'Visitas tecnicas en Edificios o Conjuntos'; break;
		case 'vtrep': $tipo= 'REPLANVTCON'; $vertipo= 'Replanteamiento de Visitas Tecnicas'; break;
		case 'vtcasa': $tipo= 'VTCASA'; $vertipo= 'Visita Tecnica en Casas'; break;
		case 'vercasa': $tipo= 'REPLANVTCASA'; $vertipo= 'Verificaciones de HHPP'; break;
	}
	$QUERY = "select IDSOLICITUD,SOLICITANTE,DIRECCION,RESPUESTA,CONTACTO,TELEFONO,MOVIL from SOLICITUDES_VT where TIPO = '".$tipo."' and ESTADO = 'PENDIENTE' order by IDSOLICITUD";
	$QuerySolicitudes = OCIParse($ConexionAgendamiento,$QUERY);
	OCIExecute($QuerySolicitudes,OCI_DEFAULT);
	$Solicitudes = array();
	while (OCIFetchInto($QuerySolicitudes,$row,OCI_ASSOC+OCI_RETURN_NULLS))
	{	$Solicitudes[$row['IDSOLICITUD']] = $row;}
	//echo 'SOLICITUDES';Imprimir($Solicitudes);
	?>
        <table class="4lines" align="center">
          <tr align="left" class="txt">
            <td align="center" bgcolor="#D0E9F2" colspan="3"><strong>SOLICITUDES ACTIVAS PARA <br>
                  <?php echo strtoupper($vertipo); ?></strong> </td>
          </tr>
          <?php 
	if($Solicitudes == array())
	{?>
          <tr align="left" class="txt">
            <td align="center" colspan="3"><strong>NO EXISTEN SOLICITUDES INGRESADAS</strong></td>
          </tr>
          <?php 
	}else
	{?>
          <tr align="left" class="txt">
            <td align="center" colspan="4"><table width="100%" height="100%">
                <tr align="center">
                  <td bgcolor="#D0E9F2"><strong>#Solicitud</strong></td>
                  <td bgcolor="#D0E9F2"><strong>Solicitante</strong></td>
				   <td bgcolor="#D0E9F2"><strong>Direccion</strong></td>
				   <td bgcolor="#D0E9F2"><strong>Contacto</strong></td>
 		           <td bgcolor="#D0E9F2"><strong>Tel&eacute;fono</strong></td>
 		           <?php 
		if($tipo == 'REPLANVTCASA')
		{?>
				  
                  
                   <td bgcolor="#D0E9F2"><strong>Nodo</strong></td>
         <?php 
		}?>
				 <td>&nbsp;</td>
                </tr>
                <?php 
	foreach($Solicitudes as $id => $datos)
	{	?>
                <tr>
                  <td align="center"><?php echo $id; ?></td>
                  <td><?php echo $datos['SOLICITANTE']; ?></td>
				   <td><?php echo $datos['DIRECCION']; ?></td>
				   <td><?php echo $datos['CONTACTO']; ?></td>
		           <td><?php echo $datos['TELEFONO']; ?></td>
		           <?php 
		if($tipo == 'REPLANVTCASA')
		{?>
				  
				  
				  <td><?php echo $datos['MOVIL']; ?></td>

        <?php 
		}?>
				  <td align="center" bgcolor="#D0E9F2">
				  <input name="button" type="button" id="<?php echo $id; ?>" onClick="document.location='visitas_tecnicas_gestion.php?id=<?php echo $id; ?>'" value="GESTIONAR">				  </td>
                </tr>
                <?php 	
	}?>
            </table></td>
          </tr>
          <?php }?>
          <tr align="left" class="txt">
            <td align="center" bgcolor="#D0E9F2" colspan="3">&nbsp;</td>
          </tr>
        </table>
        <?php 
}?>
        <?php 
if(array_key_exists('id',$_GET))
{	
	$QUERY = "select * from SOLICITUDES_VT where IDSOLICITUD = ".$_GET['id'];
	$QuerySolicitud = OCIParse($ConexionAgendamiento,$QUERY);
	OCIExecute($QuerySolicitud,OCI_DEFAULT);
	$Solicitud = array();
	OCIFetchInto($QuerySolicitud,$Solicitud,OCI_ASSOC);
	//echo 'SOLICITUD';Imprimir($Solicitud);
	
	
	
	?>
        <form action="visitas_tecnicas_gestion.php" method="post" onSubmit="validachar('respuesta');MM_validateForm('respuesta','','R');return document.MM_returnValue">
          <table class="4lines" align="center">
            <tr align="left" class="txt">
              <th align="center" bgcolor="#D0E9F2" colspan="2"><strong>
                <?php if($Solicitud['TIPO'] == 'VTCONJUNTOS'){?>
                VISITA TECNICA EN EDIFICIOS O CONJUNTOS
                <?php }?>
                <?php if($Solicitud['TIPO'] == 'REPLANVTCON'){?>
                REPLANTEAMIENTO DE VISITA TECNICA ENEDIFICIOS O CONJUNTOS
                <?php }?>
                <?php if($Solicitud['TIPO'] == 'VTCASA'){?>
                VISITA TECNICA CASA
                <?php }?>
                <?php if($Solicitud['TIPO'] == 'REPLANVTCASA'){?>
               VERIFICACION CASAS
                <?php }?>
              </strong></th>
            </tr>
            <tr class="txt">
              <td align="left" bgcolor="#D0E9F2"><strong>Numero de Solicitud:</strong></td>
              <td align="center" bgcolor="#D0E9F2"><strong><?php echo $Solicitud['IDSOLICITUD']; ?></strong></td>
            </tr>
            <?php 
	if(isset($Solicitud['CUENTAMATRIZ']))
	{	
		$QueryDataEd = "SELECT STSTNM as CALLE, EDHOME AS CASA, EDTEL1 AS TELEFONO, EDNOCO AS CONTACTO, EDNODO AS NODO, EDTUNI AS UNIDADES FROM TVCABLEDTA.TCEDFF00 JOIN CABLEDTA.STRTMSTR ON STSTRÑ=EDCALL WHERE  EDCODG=".$Solicitud['CUENTAMATRIZ'];
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
              <td align="center" bgcolor="#D0E9F2" colspan="2"><table align="center">
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
              </table></td>
            </tr>
            <?php 
	}?>
            <tr align="left" class="txt">
              <td align="center" bgcolor="#D0E9F2" colspan="2"><strong>DATOS INGRESADOS</strong></td>
            </tr>
            <tr class="txt">
              <td align="left" bgcolor="#D0E9F2"><strong>Direccion Completa:</strong></td>
              <td align="center"><?php echo $Solicitud['DIRECCION']; ?></td>
            </tr>
            <tr class="txt">
              <td align="left" bgcolor="#D0E9F2"><strong>Direccion Alterna:</strong></td>
              <td align="center"><?php echo @$Solicitud['DIRECCION1']; ?></td>
            </tr>
            <?php 
	if($Solicitud['TIPO'] <> 'REPLANVTCASA')
	{?>
            <tr class="txt">
              <td align="left" bgcolor="#D0E9F2"><strong>Telefono1 :</strong></td>
              <td align="center"><?php echo $Solicitud['TELEFONO']; ?></td>
            </tr>
            <tr class="txt">
              <td align="left" bgcolor="#D0E9F2"><strong>Telefono2 :</strong></td>
              <td align="center"><?php echo @$Solicitud['TELEFONO1']; ?></td>
            </tr>
            <?php 
	}?>
            <?php 
	if($Solicitud['TIPO'] <> 'VTCASA' && $Solicitud['TIPO'] <> 'REPLANVTCASA')
	{?>
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
              <td align="center" colspan="2"><textarea readonly="readonly" cols="40" rows="3"><?php echo $Solicitud['MOTIVO']; ?></textarea></td>
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
              <td align="center" bgcolor="#D0E9F2" colspan="2"><?php 
	if(isset($Solicitud['RESPUESTA']))
	{	?>
		  <strong>RESPUESTA ANTERIOR</strong><br>
		  <textarea name="textarea" cols="40" rows="2" readonly="readonly"><?php echo $Solicitud['RESPUESTA']; ?></textarea>
		  <br>
		<?php 
	}?>
			  <strong>RESPUESTA ACTUAL</strong><br>
			  (NO se permite el uso de la '&amp;ntilde;' o caracteres especiales)<br>
			  <textarea cols="40" name="respuesta" rows="5" onBlur="validachar('respuesta');"></textarea>
			  <input type="hidden" name="idsolicitud" value="<?php echo $Solicitud['IDSOLICITUD']; ?>">
			  <input type="hidden" name="correo" value="<?php echo $Solicitud['CORREO']; ?>"><br>
			  <table width="100%" border="0">
				<tr>
				  <th class="txt" width="50%" bgcolor="#FFFFFF" onMouseOut="this.style.background='#FFFFFF'" onMouseOver="this.style.background='#00FFFF'">
				   <strong style="font-size:12px;"><a target="new" href="../selservicio.asp">Agendar esta Orden </a></strong>
				  </th>
				  <th class="txt" width="50%" bgcolor="#FFFFFF" onMouseOut="this.style.background='#FFFFFF'" onMouseOver="this.style.background='#00FFFF'">
				   <strong style="font-size:12px;"><a target="new" href="../visitas_tecnicas/consultar_documento.asp">Consultar Documentos</a></strong>
				  </th>
				</tr>
			  </table>
			 </td>
            </tr>
            <tr class="txt">
              <td width="50%" align="center" bgcolor="#D0E9F2">
			  <input type="submit" name="submitado" value="POSTPONER">
			  </td>
              <td width="50%" align="center" bgcolor="#D0E9F2">
			  <input type="submit" name="submitado" value="FINALIZAR">
			  </td>
            </tr>
          </table>
        </form>
        <form action="visitas_tecnicas_gestion.php" method="post" onSubmit="validachar('respuesta');MM_validateForm('respuesta','','R');return document.MM_returnValue">
        </form>
<?php 
}?>
<?php 

$fechamodifica = date('Y-m-d H:i');
$fechacancel = date('Y-m-d H:i');

if(array_key_exists('idsolicitud',$_POST))
{	
	if($_POST['submitado'] == 'POSTPONER')
	{	$estado = 'PENDIENTE';
	$Query = "update SOLICITUDES_VT set RESPUESTA = RESPUESTA||'".$fechahora.$_POST['respuesta']."\r\n"."', FECHAMODIFICACION='".$fechamodifica."',ESTADO = '".$estado."' where idsolicitud = ".$_POST['idsolicitud']."";
	//echo "<br>".$Query;
	}
{
	if($_POST['submitado'] == 'FINALIZAR')
	
	{	$estado = 'TERMINADO';
	$Query = "update SOLICITUDES_VT set RESPUESTA = RESPUESTA||'".$fechahora.$_POST['respuesta']."\r\n"."', FECHACANCELACION='".$fechacancel."',ESTADO = '".$estado."' where idsolicitud = ".$_POST['idsolicitud']."";
	//echo "<br>".$Query;
	}
	$QueryUpdate = OCIParse($ConexionAgendamiento,$Query);
	OCIExecute($QueryUpdate, OCI_DEFAULT);
	OCICommit($ConexionAgendamiento);

}

	////////////////////////////////////////////RUTINA DE ENVIO DE CORREO AL INTERESADO///////////////////////////////////////////////////////////////////
	$Desde = 'TVCable Visitas Tecnicas|JUANK@cable.net.co';
	$ParaQuienArray = array(str_replace('?','ñ',$_POST['correo']));
	$Titulo = "Modificacion de Visita Tecnica";
	$HTML = true;
	$CCArray = array();
	$CCOArray = array();//'juank@cable.net.co');
	$Attachment = array();
	$Cuerpo = "<strong>Atencion!</strong><br>Por medio de este correo se le informa que la <strong>solicitud de visita tecnica</strong> numero <strong>".$_POST['idsolicitud']."</strong>, ha sido modificada.<br>Puede consultar los datos y el estado de esta visita desde el modulo de gestion o autodigitacion.<br>http://agendamiento.cable.net.co/gestion/login.asp - MODULO GESTION<br>http://agendamiento.cable.net.co/gestion/login_digitacion.asp -MODULO AUTODIGITACION<br><br>Att.<br> Modulo de Gestion - Visitas Tecnicas.";
	EnviarCorreo($Desde, $ParaQuienArray, $Titulo, $Cuerpo, $HTML, $CCArray, $CCOArray, $Attachment);
	//echo $Cuerpo;
	//////////////////////////////////////FIN RUTINA DE ENVIO DE CORREO AL INTERESADO///////////////////////////////////////////////////////////////////


	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = "visitas_tecnicas_gestion.php?finalizado=".$_POST['idsolicitud'];
	header("Location: http://$host$uri/$extra");
	exit;
}?>
<?php 
if(array_key_exists('finalizado',$_GET))
{	?>
<h3 align="center">Se ha ingresado existosamente su respuesta a la solicitud con codigo  <strong>'<?php echo $_GET['finalizado']; ?>'</strong>. Se ha enviado un correo de notificacion al usuario que ingreso la solicitud.<br><a href="visitas_tecnicas_solicitud.php?origen=1">Volver al Menu</a></h3>	
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
