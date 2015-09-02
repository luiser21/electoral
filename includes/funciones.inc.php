<?php

function getDescripcion($id,$campoid,$campodescripcion,$tabla){
	if(!ValidaConexion(@$DBGestion)){	
		$DBGestion = new GestionBD("AGENDAMIENTO");
	}
	$Query = "SELECT $campodescripcion FROM $tabla WHERE $campoid = '$id'";
	$DBGestion->ConsultaArray($Query);
	if ($DBGestion->datos){
		return $DBGestion->TraeCampo(0,$campodescripcion);
	}else {
		return "SIN DESCRIPCION";
	}
}

function InCSV($file,$destino,$conname=0){
	if(is_array(@$_FILES[$file])){
		if($_FILES[$file]['error'] == 0){
			if(strtolower(substr($_FILES[$file]['name'],-4)) == ".csv"){
				if(is_uploaded_file(@$_FILES[$file]['tmp_name'])){
					if($conname){
						$name = $_FILES[$file]['name'];
					}else{
						$name = "CSVFile.csv";
					}
					move_uploaded_file($_FILES[$file]['tmp_name'], $destino.$name);
					$result = array('IN'=>$_FILES[$file]['name'],'STORED'=>$name);
					return $result;
				}
			}else{
				return "El archivo ingresado debe tener extencion [.CSV] (separado por comas).";
			}
		}else{
			return "Este archivo presento un problema en el almacenamiento. Revise los datos ingresados";
		}
	}else{
		return "No se encontro ninguan archivo en el anterior formulario.";
	}
}

function file2Array($filedir){
	$fileArray = array();
	$handle = fopen($filedir, "r");
	while (( $row = fgetcsv($handle, 1000,";")) !== FALSE){	
		$fileArray[] = array_map('FixQuery',array_map('strtoupper',$row));
	}
	fclose($handle);
	return $fileArray;
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function RestrictPerfil(){//INICIO FUNCION QUE RETORNA LAS LIMITANTES DEBIDAS AL PERFIL Y ROLES DE USUARIO //////////////////
	$LAlys = $LCitys = $LJobs = array();
	$Permisos = AtenticacionUsuario();//Imprimir($Permisos);
	if($Permisos['ALIADO']<>''){
		$LAlys += array($Permisos['ALIADO']);
	}
	if($Permisos['ALIADOS']<>''){
		$LAlys += explode('/',$Permisos['ALIADOS']);
	}
	if($Permisos['CIUDADES']<>''){
		$LCitys += explode('/',$Permisos['CIUDADES']);
	}
	if($Permisos['TIPOSTRABAJO']<>''){
		$LJobs += explode('/',$Permisos['TIPOSTRABAJO']);
	}
	$Result['ALY'] = array_unique($LAlys);
	$Result['CITY'] = array_unique($LCitys);
	$Result['JOB'] = array_unique($LJobs);
	return $Result;
}///////////////// FINAL FUNCION QUE RETORNA LAS LIMITANTES DEBIDAS AL PERFIL Y ROLES DE USUARIO ///////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function Null2Cero($val)
{
	if(is_null($val)){	return 0;}
	elseif($val==''){	return 0;}
	elseif($val==' '){	return 0;}
	elseif($val < 0){	return 0;}
	else{	return $val;}
}

function Num2Mes($num){
	$MesLit = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
	$MesNum = array('01','02','03','04','05','06','07','08','09','10','11','12');
	if($res = str_replace($MesNum,$MesLit,$num)){	return $res;}
	else{	return FALSE;}
}

function Num2MesSmall($num){
	$MesLit = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
	$MesNum = array('01','02','03','04','05','06','07','08','09','10','11','12');
	if($res = str_replace($MesNum,$MesLit,$num)){	return $res;}
	else{	return FALSE;}
}

function Num2Dia($num,$size=0){
	if($size){	$DiaLit = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");}
	else{	$DiaLit = array("DOM","LUN","MAR","MIE","JUE","VIE","SAB");}
	$DiaNum = array(7,1,2,3,4,5,6);
	if($res = str_replace($DiaNum,$DiaLit,$num)){	return $res;}
	else{	return FALSE;}
}

function get_rfc_date($p_time = null) {
	if(is_null($p_time)) $p_time = mktime();
	$tz = date("Z", $p_time);
	$tzs = ($tz < 0) ? "-" : "+";
	$tz = abs($tz);
	$tz = ($tz/3600)*100 + ($tz%3600)/60;
	$date = sprintf("%s %s%04d", date("D, j M Y H:i:s", $p_time), $tzs, $tz);
	return $date;
}

function clean_buffer() {
	header('Pragma: no-cache');
	header('Cache-control: private');
	header('Expires: '. get_rfc_date(mktime(0,0,0,1,1,2000)));
}

function array_combine4($llaves, $valores)
{
	$ArregloArray = array();
	for($conta=0;$conta<count($llaves);$conta++)
	{
		$ArregloArray[$llaves[$conta]] = $valores[$conta];
	}
	return($ArregloArray);
}

function FixChars($Cadena)
{
	$Cadena = trim($Cadena);
	while ($Cadena != str_replace("  "," ",$Cadena))
	{
		$Cadena = str_replace("  "," ",$Cadena);
	}
	$Cadena = str_replace(chr(10)," ",$Cadena);
	$Cadena = str_replace(chr(13)," ",$Cadena);
	$Cadena = str_replace("&","Y",$Cadena);
	$Cadena = str_replace("Ñ","N",$Cadena);
	$Cadena = str_replace("#","N",$Cadena);
	$Cadena = str_replace("Á","A",$Cadena);
	$Cadena = str_replace("É","E",$Cadena);
	$Cadena = str_replace("Í","I",$Cadena);
	$Cadena = str_replace("Ó","O",$Cadena);
	$Cadena = str_replace("Ú","U",$Cadena);
	$Cadena = str_replace("À","A",$Cadena);
	$Cadena = str_replace("È","E",$Cadena);
	$Cadena = str_replace("Ì","I",$Cadena);
	$Cadena = str_replace("Ò","O",$Cadena);
	$Cadena = str_replace("Ù","U",$Cadena);
	$Cadena = str_replace("'"," ",$Cadena);
	$Cadena = str_replace('"'," ",$Cadena);
	$Cadena = str_replace("Ç"," ",$Cadena);
	$Cadena = str_replace("*"," ",$Cadena);
	$Cadena = str_replace("/","-",$Cadena);
	$Cadena = str_replace("\\","-",$Cadena);
	$Cadena = str_replace("."," ",$Cadena);
	$Cadena = str_replace("<"," ",$Cadena);
	$Cadena = str_replace(">"," ",$Cadena);
	return $Cadena;
	}

function DelChars($Cadena)
{
	$Cadena = trim($Cadena);
	$Cadena = str_replace(chr(10)," ",$Cadena);
	$Cadena = str_replace(chr(13)," ",$Cadena);
	$Cadena = str_replace(chr(9)," ",$Cadena);
	$charsArr = array(
	'Á','É','Í','Ó','Ú','á','é','í','ó','ú','Ä','Ë','Ï','Ö','Ü','ä','ë','ï','ö','ü','Ã','Ñ','Õ','ã','ñ','õ','Ø','ø','Ð','ð',
	'ß','¼','½','¾','©','®','ª','²','³','¹','¯','µ','¶','·','°','¸','¿','×','÷','“','”','Œ','‡','À','È','Ì','Ò','Ù','à','è','ì','ò','ù','Â','Ê',
	'Î','Ô','Û','â','ê','î','ô','û','å','Å','Ç','ç','Ý','ý','ÿ','Þ','þ','Æ','æ','¡','£','¥','§','¤','¦','«','¬','­','º','´','¨','±','»','¢','€',
	'™','‰','ƒ','†','&',"'",'"','\n','\r'
	);
	$replace = array_fill(0,count($charsArr),'');
	$Cadena = str_replace($charsArr,$replace,$Cadena);
	while ($Cadena != str_replace("  "," ",$Cadena))
	{
		$Cadena = str_replace("  "," ",$Cadena);
	}
	return trim($Cadena);
}

function FixCharsED($Cadena)
{
	$Cadena = trim($Cadena);
	while ($Cadena != str_replace("  "," ",$Cadena))
	{
		$Cadena = str_replace("  "," ",$Cadena);
	}
	$Cadena = str_replace(chr(10)," ",$Cadena);
	$Cadena = str_replace(chr(13)," ",$Cadena);
	$Cadena = str_replace("&","Y",$Cadena);
	$Cadena = str_replace("#","Ñ",$Cadena);
	$Cadena = str_replace("Á","A",$Cadena);
	$Cadena = str_replace("É","E",$Cadena);
	$Cadena = str_replace("Í","I",$Cadena);
	$Cadena = str_replace("Ó","O",$Cadena);
	$Cadena = str_replace("Ú","U",$Cadena);
	$Cadena = str_replace("À","A",$Cadena);
	$Cadena = str_replace("È","E",$Cadena);
	$Cadena = str_replace("Ì","I",$Cadena);
	$Cadena = str_replace("Ò","O",$Cadena);
	$Cadena = str_replace("Ù","U",$Cadena);
	return $Cadena;
}

function Imprimir($Array)
{
	echo "<pre>";
	print_r($Array);
	echo "</pre>";
}

function LetrasRandom($length)
{
	mt_srand(time());
	$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$key="";
	for($i=0;$i<$length;$i++)
	{
		$key .= $pattern{mt_rand(0,61)};
	}
	return $key;
}

function EnviarCorreo($Desde, $ParaQuienArray, $Titulo, $Cuerpo, $HTML = false, $CCArray = array(), $CCOArray = array(), $Respuesta = "", $AttachmentArray = array())
{
	require_once("phpmailer/class.phpmailer.php");

	$mail = new PHPMailer();


	$mail->IsSMTP();                               // send via SMTP
	$mail->Host     = "192.168.18.51;"; // SMTP servers
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "sistemasweb@cable.net.co";  // SMTP username
	$mail->Password = "TelmexHogar"; // SMTP password


	if (strpos($Desde,"|")===false) {$offset = 0;} else {$offset = 1;}
	$NombreDe = substr($Desde,0,strpos($Desde,"|"));
	$De = substr($Desde,strpos($Desde,"|")+$offset);

	$mail->From     = $De;
	$mail->FromName = $NombreDe;

	foreach ($ParaQuienArray as $IdParaQuien => $ParaQuien)
	{
		if (strpos($ParaQuien,"|")===false) {$offset = 0;} else {$offset = 1;}
		$NombrePara = substr($ParaQuien,0,strpos($ParaQuien,"|"));
		$Para = substr($ParaQuien,strpos($ParaQuien,"|")+$offset);

		$mail->AddAddress($Para, $NombrePara);
	}

	$mail->WordWrap = 50;                              // set word wrap

	foreach ($CCArray as $IdCC => $CC)
	{
		if (strpos($CC,"|")===false) {$offset = 0;} else {$offset = 1;}
		$NombreCC = substr($CC,0,strpos($CC,"|"));
		$CC = substr($CC,strpos($CC,"|")+$offset);

		$mail->AddCC($CC, $NombreCC);
	}

	foreach ($CCOArray as $IdCCO => $CCO)
	{
		if (strpos($CCO,"|")===false) {$offset = 0;} else {$offset = 1;}
		$NombreCCO = substr($CCO,0,strpos($CCO,"|"));
		$CCO = substr($CCO,strpos($CCO,"|")+$offset);

		$mail->AddBCC($CCO, $NombreCCO);
	}

	foreach ($AttachmentArray as $IdAttachment => $Attachment)
	{
		$mail->AddAttachment($Attachment);      // attachment
	}

	if ($Respuesta != "")
	{
		if(!is_array($Respuesta)){
			if (strpos($Respuesta,"|")===false) {$offset = 0;} else {$offset = 1;}
			$NombreResponderA = substr($Respuesta,0,strpos($Respuesta,"|"));
			$ResponderA = substr($Respuesta,strpos($Respuesta,"|")+$offset);

			$mail->AddReplyTo($ResponderA,$NombreResponderA);
		}

	}

	$mail->IsHTML($HTML);                               // send as HTML

	$mail->Subject  =  $Titulo;
	$mail->Body     =  $Cuerpo;
	if ($HTML==true) { $mail->AltBody = HTMLToText($Cuerpo); } else { $mail->AltBody = $Cuerpo; }

	if(!$mail->Send())
	{
		echo "Correo no enviado";
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Correo enviado";
	}

//Correo
	return $mail->ErrorInfo;
}

function TextToHTML($Texto)
{
	$Texto = str_replace("\n","<br>",$Texto);
	$Texto = str_replace("á","&aacute;",$Texto);
	$Texto = str_replace("é","&eacute;",$Texto);
	$Texto = str_replace("í","&iacute;",$Texto);
	$Texto = str_replace("ó","&oacute;",$Texto);
	$Texto = str_replace("ú","&uacute;",$Texto);
	$Texto = str_replace("<","&lt;",$Texto);
	$Texto = str_replace(">","&gt;",$Texto);
	$Texto = str_replace("¿","&iquest;",$Texto);
	$Texto = str_replace("Ñ","&Ntilde;",$Texto);
	$Texto = str_replace("ñ","&ntilde;",$Texto);
	return $Texto;
}

function HTMLToText($Texto)
{
	$Texto = str_replace("\n","",$Texto);
	while (str_replace("  "," ",$Texto)!=$Texto) { $Texto = str_replace("  "," ",$Texto); }
	$Texto = str_replace("&nbsp;"," ",$Texto);
	$Texto = str_replace("<br>","\n",$Texto);
	$Texto = str_replace("&aacute;","á",$Texto);
	$Texto = str_replace("&eacute;","é",$Texto);
	$Texto = str_replace("&iacute;","í",$Texto);
	$Texto = str_replace("&oacute;","ó",$Texto);
	$Texto = str_replace("&uacute;","ú",$Texto);
	$Texto = str_replace("&lt;","<",$Texto);
	$Texto = str_replace("&gt;",">",$Texto);
	$Texto = str_replace("&iquest;","¿",$Texto);
	$Texto = str_replace("&Ntilde;","Ñ",$Texto);
	$Texto = str_replace("&ntilde;","ñ",$Texto);
	return $Texto;
}

function Array2XML ($InputArray = array())
{
	$XML = "";
	foreach ($InputArray as $Id => $Content)
	{
		if (is_array($Content))
		{
			$XML .= "<".$Id.">".Array2XML($Content)."</".$Id.">";
		} elseif ($Content == "")
		{
			$XML .= "<".$Id."/>";
		} else {
			$XML .= "<".$Id.">".$Content."</".$Id.">";
		}
	}
	return $XML;
}

function FixArray2XML($XML,$Id)
{
	set_time_limit(0);
	$i=0;
	do
	{
		$posicion = strpos($XML,"<".$i.">");
		if ($posicion===false)
		{
			break;
		} else {
			$XML = str_replace("<".$i.">","<".$Id.">",$XML);
			$XML = str_replace("</".$i.">","</".$Id.">\n",$XML);
		}
		$i++;
	} while (1);
	$Result = "<?xml version=\"1.0\" encoding=\"utf-8\"?>".$XML;
	return $Result;
	set_time_limit(30);
}

function XML2Array($XML)
{
	if ($XML)
	{
		$Array = array();
		$inicio = strpos($XML,"<")+1;
		$fin = strpos($XML,">");
		if ($inicio === false || $fin === false)
		{
			return $XML;
		}
		$id = substr($XML,$inicio,$fin-$inicio);
		if (substr($id,-1,1) == "/")
		{
			$id = substr($id,0,-1);
			$XML = str_replace("<".$id."/>","<".$id."></".$id.">",$XML);
		}
		$inicioid = strpos($XML,"<".$id.">")+strlen($id)+2;
		if ( $inicioid === false)
		{
			return trim($XML);
		}
		$finid = 0;
		do {
			$finid = strpos($XML,"</".$id.">",$finid+1);
			if ( $finid === false)
			{
				return trim($XML);
			}
			$valor = substr($XML,$inicioid,$finid-$inicioid);
		} while ((substr_count($valor,"<".$id.">")!=substr_count($valor,"</".$id.">")));

		$Array[$id] = XML2Array($valor);
		$TamanoResto = strlen("<".$id.">".$valor."</".$id.">");
		$resto = substr($XML,$TamanoResto);
		if (trim($resto) == "")
		{
			$ArrayResult = $Array;
		} else {
			foreach ($Array as $Id1 => $Res1)
			{
				set_time_limit(30);
				$ArrayResult[$Id1] = $Res1;
			}
			$ArrayResto = XML2Array(trim($resto));
			if(is_array($ArrayResto))
			{
				foreach ($ArrayResto as $Id2 => $Res2)
				{
					set_time_limit(30);
					$ArrayResult[$Id2] = $Res2;
				}
			}
		}
		return $ArrayResult;
	}
}

function FixXML2Array($XML,$id,$next = 0)
{
	$inicioprevio = strpos($XML,"<".$id.">");
	if (!$inicioprevio)
	{
		$previo = "";
	} else {
		$previo = substr($XML,0,$inicioprevio);
	}
	$inicioid = strpos($XML,"<".$id.">")+strlen($id)+2;
	if ( $inicioid === false)
		{
			return trim($XML);
		}
	if (!trim($XML))
	{
		return $XML;
	}
	$finid = 0;
	do {
		$finid = strpos($XML,"</".$id.">",$finid+1);
		if ( $finid === false)
			{
				return trim($XML);
			}
		$valor = substr($XML,$inicioid,$finid-$inicioid);
	} while ((substr_count($valor,"<".$id.">")!=substr_count($valor,"</".$id.">"))) ;
	$Fixed = "<".$next.">".FixXML2Array($valor,$id)."</".$next.">";
	$TamanoResto = strlen("<".$id.">".$valor."</".$id.">");
	$resto = substr($XML,$finid+strlen($id)+3);
	$Resultado = $previo.$Fixed.FixXML2Array($resto,$id,$next+1);
	return $Resultado;
}

function logToFile($filename, $msg)
{
	// open file
	$fd = fopen($filename, "a");
	// append date/time to message
	$str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg;
	// write string
	fwrite($fd, $str . "\n");
	// close file
	fclose($fd);
}

function Externos($g=0,$p=0,$c=0,$s=0){
	if($g<>0){echo "<br>GET:";Imprimir($_GET);}
	if($p<>0){echo "<br>POST:";Imprimir($_POST);}
	if($c<>0){echo "<br>COOKIE:";Imprimir($_COOKIE);}
	if($s<>0){echo "<br>SESSION:";Imprimir($_SESSION);}
}

function ArrayJerarquico($Array = array(), $Campo, $NombreHijo = "child")
{
	$NewArray = array();

	foreach ($Array as $Id => $ValoresArray)
	{
		if (!array_key_exists($Campo,$ValoresArray))
		{
			return $Array;
		}
		$Concat = array();
		foreach ($ValoresArray as $NomColumna => $ValoresColumna)
		{
			$Concat[$NomColumna] = $ValoresArray[$NomColumna];
			if ($NomColumna == $Campo)
			{
				break;
			}
		}
		if (array_search($Concat,$NewArray) === false)
		{
			$NewArray[] = $Concat;
		}
	}
	$Jerarquico = $NewArray;

	foreach ($Array as $Id => $ValoresArray)
	{
		$Concat = array();
		$Diferencia = array();
		foreach ($ValoresArray as $NomColumna => $ValoresColumna)
		{
			$Concat[$NomColumna] = $ValoresArray[$NomColumna];
			unset($ValoresArray[$NomColumna]);
			if ($NomColumna == $Campo)
			{
				break;
			}
		}
		$Clave = array_search($Concat,$NewArray);
		$Jerarquico[$Clave][$NombreHijo][] = $ValoresArray;
	}
	return $Jerarquico;
}

function UndoArrayJerarquico($Array = array(), $NombreHijo = "child")
{
	$NewArray = array();

	foreach ($Array as $Id => $ValoresArray)
	{
		if (!array_key_exists($NombreHijo,$ValoresArray))
		{
			return $Array;
		}
		$HijoArray = $ValoresArray[$NombreHijo];
		unset($ValoresArray[$NombreHijo]);
		foreach($HijoArray as $ValorHijoArray)
		{
			$NewArray[] = $ValoresArray + $ValorHijoArray;
		}
	}
	return $NewArray;
}



function get_url($url,$postarray = array(),$method = "GET")
{
	$url = urldecode($url);
	if ($method == "POST")
	{
		$http = new HttpRequest($url, HttpRequest::METH_POST);
		$http->setPostFields($postarray);
	} else {
		$http = new HttpRequest($url, HttpRequest::METH_GET);
		$http->addQueryData($postarray);
	}
	try {
		$http->send();
		if ($http->getResponseCode() == 200) {
			return $http->getResponseBody();
		}
	} catch (HttpException $ex) {
		echo $ex;
		return false;
	}
}

function PreCero($val){
	if(abs($val)<=9 && strlen($val)<2){	return '0'.$val;}
	else{	return $val;}
}

function InsertQuery($INSQL,$TIPO,$DBGestion){
	global $DBGestion;
	if(!ValidaConexion(@$DBGestion)){
		$DBGestion = new GestionBD("AGENDAMIENTO");
		$Cierre = true;
	} else {
		$Cierre = false;
	}
	$INSQL = str_replace('\n\r',' ',$INSQL);
	$INSQL = str_replace('\r',' ',$INSQL);
	$INSQL = str_replace('\n',' ',$INSQL);
	$INSQL = str_replace(chr(9),' ',$INSQL);//Remplaza TAB HORIZONTAL
	$INSQL = str_replace(chr(10),' ',$INSQL);//Remplazan enter
	$INSQL = str_replace(chr(13),' ',$INSQL);//
	while ($INSQL != str_replace("  "," ",$INSQL)){	$INSQL = str_replace("  "," ",$INSQL);}
	$SQL = "merge into CONSULTAS C using ".
	"(select '".$INSQL."' CONSULTA from dual) PC ".
	"on (C.CONSULTA=PC.CONSULTA) ".
	"WHEN NOT MATCHED THEN ".
	"insert(CONSULTA, TIPO) ".
	"values('".$INSQL."','".$TIPO."')";
	//"insert into CONSULTAS_AG(CONSULTA,TIPO) VALUES ('".$INSQL."','".$TIPO."')";
	//echo $SQL;
	$DBGestion->Consulta($SQL);
	$Query = "select IDCONSULTA from CONSULTAS where CONSULTA = '".$INSQL."' and TIPO = '".$TIPO."'";
	//"select CONSULTAS_AG_seq.currval from dual";
	$DBGestion->ConsultaArray($Query);
	$Resultado = $DBGestion->datos[0]['IDCONSULTA'];
	$DBGestion->Commit();
	if($Cierre){	$DBGestion->CerrarConexion();}
	return $Resultado;
}

function ObtainQuery($ID,$ValuesArray){
	global $DBGestion;
	if(!ValidaConexion(@$DBGestion)){
		$DBGestion = new GestionBD("AGENDAMIENTO");
		$Cierre = true;
	} else {
		$Cierre = false;
	}
	$Query = "select CONSULTA from CONSULTAS where IDCONSULTA = ".$ID;
	$DBGestion->ConsultaArray($Query);
	if($Cierre){	$DBGestion->CerrarConexion();}
	$consulta = $DBGestion->TraeCampo(0,'CONSULTA');
	//echo "<br> Antes".$consulta;
	foreach($ValuesArray as $key => $value){
		$consulta = str_replace('<|VAR'.$key.'|>',$value,$consulta);
	}
	return $consulta;
}

function ValidarCadenaTexto($Texto,$CadenaTexto)
{
	for ($i=0;$i<strlen($Texto);$i++)
	{
		$Posicion = strpos($CadenaTexto,$Texto{$i});
		if ($Posicion === false)
		{
			return false;
		}
	}
	return true;
}

function ValidarMAC($Texto)
{
	$Longitud = strlen($Texto);
	if ($Longitud!=12 && $Longitud!=17)
	{
		return false;
	}
	$CadenaTexto = "0123456789ABCDEFabcdef";
	if ($Longitud==12)
	{
		$CadenaTexto = "0123456789ABCDEFabcdef";
		for ($i=0;$i<strlen($Texto);$i++)
		{
			$Posicion = strpos($CadenaTexto,$Texto{$i});
			if ($Posicion === false)
			{
				return false;
			}
		}
	}
	if ($Longitud==17)
	{
		for ($i=0;$i<strlen($Texto);$i++)
		{
			if ($i%3 == 2)
			{
				$Posicion = strpos(":",$Texto{$i});
			} else {
				$Posicion = strpos($CadenaTexto,$Texto{$i});
			}
			if ($Posicion === false)
			{
				return false;
			}
		}
	}
	return true;
}

function ValidarNumTel($Texto)
{
	if (strlen($Texto)!=8)
	{
		return false;
	}
	if (!is_numeric($Texto))
	{
		return false;
	}
	return true;
}

function ValidarNumTelInternational($Texto)
{
	if (is_numeric(substr($Texto,0,2)))
	{
		return false;
	}
	if (!is_numeric(substr($Texto,2)))
	{
		return false;
	}
	return true;
}

function ValidarIP($Texto)
{
	for ($i=0; $i<3; $i++)
	{
		$Posicion = strpos($Texto,".");
		if ($Posicion === false)
		{
			return false;
		}
		$Octectos[] = substr($Texto,0,$Posicion);
		$Texto = substr($Texto,$Posicion+1);
	}
	$Octectos[] = $Texto;
	foreach ($Octectos as $Octecto)
	{
		if (!is_numeric($Octecto))
		{
			return false;
		}
		if ($Octecto > 255 || $Octecto < 0)
		{
			return false;
		}
		$CadenaTexto = "0123456789";
		for ($i=0;$i<strlen($Texto);$i++)
		{
			$Posicion = strpos($CadenaTexto,$Texto{$i});
			if ($Posicion === false)
			{
				return false;
			}
		}
	}
	return true;
}

function array_merge_recursive_unique($array0, $array1)
{
    $arrays = func_get_args();
    $remains = $arrays;

    // We walk through each arrays and put value in the results (without
    // considering previous value).
    $result = array();

    // loop available array
    foreach($arrays as $array) {

        // The first remaining array is $array. We are processing it. So
        // we remove it from remaing arrays.
        array_shift($remains);

        // We don't care non array param, like array_merge since PHP 5.0.
        if(is_array($array)) {
            // Loop values
            foreach($array as $key => $value) {
                if(is_array($value)) {
                    // we gather all remaining arrays that have such key available
                    $args = array();
                    foreach($remains as $remain) {
                        if(array_key_exists($key, $remain)) {
                            array_push($args, $remain[$key]);
                        }
                    }

                    if(count($args) > 2) {
                        // put the recursion
                        $result[$key] = call_user_func_array(__FUNCTION__, $args);
                    } else {
                        foreach($value as $vkey => $vval) {
                            $result[$key][$vkey] = $vval;
                        }
                    }
                } else {
                    // simply put the value
                    $result[$key] = $value;
                }
            }
        }
    }
    return $result;
}

function MACSolo($MAC)
{
	if (strlen(trim($MAC))==12)
	{
		return(strtolower($MAC));
	}
	if (strlen(trim($MAC))==17)
	{
		return(strtolower($MAC{0}.$MAC{1}.$MAC{3}.$MAC{4}.$MAC{6}.$MAC{7}.$MAC{9}.$MAC{10}.$MAC{12}.$MAC{13}.$MAC{15}.$MAC{16}));
	}
}

function MACDosPuntos($MAC)
{
	if (strlen(trim($MAC))==17)
	{
		return(strtolower($MAC));
	}
	if (strlen(trim($MAC))==12)
	{
		return(strtolower($MAC{0}.$MAC{1}.":".$MAC{2}.$MAC{3}.":".$MAC{4}.$MAC{5}.":".$MAC{6}.$MAC{7}.":".$MAC{8}.$MAC{9}.":".$MAC{10}.$MAC{11}));
	}
}

function LetrasRandomMinusculas($length)
	{
		mt_srand(time());
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		$key="";
		for($i=0;$i<$length;$i++)
			{
				$key .= $pattern{mt_rand(0,35)};
			}
		return $key;
	}


function CiudadPrincipal($CiudadSecundaria)
{
	if (!$CiudadSecundaria)
	{
		return "0";
	}
	global $DBGestion;
	$Cierre = false;
	if (!ValidaConexion($DBGestion))
	{
		$Cierre = true;
	}
	if ($Cierre)
	{
		$DBGestion = new GestionBD("AGENDAMIENTO");
	}
	$SQL = "select * from HOMOLOGA_CIUDADES where CIUDAD_SECUNDARIA = '".$CiudadSecundaria."'";
	$DBGestion->ConsultaArray($SQL);
	if (count($DBGestion->datos))
	{
		$Datos = current($DBGestion->datos);
		$CiudadPrincipal = $Datos["CIUDAD_PRINCIPAL"];
	} else {
		$CiudadPrincipal = $CiudadSecundaria;
	}
	if ($Cierre)
	{
		$DBGestion->CerrarConexion();
	}
	return $CiudadPrincipal;
}

function CiudadesSecundarias($CiudadPrincipal)
{
	if (!$CiudadPrincipal)
	{
		return array();
	}
	$CiudadesSecundarias = array($CiudadPrincipal);
	global $DBGestion;
	$Cierre = false;
	if (!ValidaConexion($DBGestion))
	{
		$Cierre = true;
	}
	if ($Cierre)
	{
		$DBGestion = new GestionBD("AGENDAMIENTO");
	}
	$SQL = "select * from HOMOLOGA_CIUDADES where CIUDAD_PRINCIPAL = '".$CiudadPrincipal."'";
	$DBGestion->ConsultaArray($SQL);
	if (count($DBGestion->datos))
	{
		foreach ($DBGestion->datos as $Id => $Datos)
		{
			$CiudadesSecundarias[] = $Datos["CIUDAD_SECUNDARIA"];
		}
	}
	if ($Cierre)
	{
		$DBGestion->CerrarConexion();
	}
	return $CiudadesSecundarias;
}

function FixQuery($SQL){
	$SQL = str_replace('\n\r',' ',$SQL);
	$SQL = str_replace('\r',' ',$SQL);
	$SQL = str_replace('\n',' ',$SQL);
	$SQL = str_replace(chr(10),' ',$SQL);//Remplazan enter
	$SQL = str_replace(chr(13),' ',$SQL);//
	$SQL = str_replace(chr(11),' ',$SQL);//
	$SQL = str_replace(chr(9),' ',$SQL);//
	$SQL = str_replace('\t',' ',$SQL);
	while ($SQL != str_replace("  "," ",$SQL))
	{
		$SQL = str_replace("  "," ",$SQL);
	}
	return trim($SQL);
}

function takeTimeFlag($var = 1,$msj = ''){
	global $microinitime;
	list($useg, $seg) = explode(" ", microtime());
	$time = ((float)$useg + (float)$seg);
	if($microinitime)
	{
		if($var)
		{
			$result = $time - $microinitime;
		}
		else
		{
			Imprimir(chr(10).chr(13).$msj." ".($time - $microinitime)." segundos".chr(10).chr(13));
		}
		$microinitime = 0;
	}
	else
	{
		$microinitime = $time;
		$result = 0;
	}
	if(isset($result))
	{
		return $result;
	}
}



function obj2array($obj) {
	if (is_object($obj) || is_array($obj)) {
		$array = array();
		foreach($obj as $id => $data) {
			$data = obj2array($data);
			$array[$id] = $data;
		}
		return $array;
	} else {
		return $obj;
	}
}

?>