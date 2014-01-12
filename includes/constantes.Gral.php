<?php
#12924522253921||ACTUALIZACION||80234702||10.244.143.19:8091||192.168.15.213||201012151730253921#
define('VALIDA_NIVELES','N');#Valida niveles [S/N]
define('NGZONA', '12');
define('NRZONA', '3');
define('IDNG_RES', '3'); #VALIDA EL IDNG PARA RESIDENCIAL
define('MATERIALES', '0'); #VALIDA MUESTRA MATERIALES 0 NO VEMOS MATERIALES 1 LOS VEMOS.
define("RESTRINGEINV", 1);#Activa o desactiva restriccion de inventarios
define('AUTENTICAAD','N');#Flag Realiza la Validacion de Usuario en el Directori Activo [S/N]
define('SESSIONES','N');#Flag Realiza la Validacion de Usuario Por Variables de Sesion [S/N]
define('COOKIES','S'); #Flag Realiza Validacion de Usuarios por Cokies [S/N]
define("GENERALOG",'N');#Flag Habilita la Generacion de log [S/N]
define("PCMLAGENDA",0);#Flag Habilita el uso de WS en agendamiento prueba[1/0]
define("VALIDACADICIONALES",7);
define("TIMESESSION",10);#Minutos de duracion de la sesion de sistema
define("PENALIDAD_INTENTOS", 10);//minutios de penalizacion por exeder los 5 intentos fallidos de logeo
define("MAIL_SISTEMA", "xx@telmex.com"); //mail que va a enviar los correos de alertas del sistema
define("SESSIONTIME",0);#Activa o desactiva el el limite de sesion por tiempo
define("LOGSCRIPT",0);#Activa o desactiva el log por scripts en el sistema.
define("LOGCONSULTAS",FALSE);#Activa o desactiva el log por scripts en el sistema.
define("DBSDEBUGS","ORACLE|INTRAWAY|AS400");#Cadena que contiene los nombres de las bases a las que se les hace debug, cada base va separada por caracter pipe
define("LOGAUDITORIA",false);
define("LOGAUDITORIAPATH","E:/LogSesiones/");
define('PERFILCG0','<PERFILCGO><PERFIL>81</PERFIL></PERFILCGO>');#ID DE PERFIL SEPARADO POR [#] EJ. 81#82#134
define("RED_EXTERNA","EXT");#id en la base de datos de la red externa
define("RED_RESIDENCIAL","RES");#id en la base de datos de la red residencial
define("RED_CORPORATIVA","COR");#id en la base de datos de la red corporativa
//constantes para agendamiento de moviles
define("UNIDAD_TIEMPO_MINIMA",15);
define("CANTIDAD_DIAS",2);
define("INVVIGENCIA",0);#Valida vigencia de inventario por ciudad - tegnologia
define("VALIDAxCEDULA",TRUE);#para validar por cedula poner true
//Constantes para redireccionar a gerencia produccion y a gerencia pruebas
define("GERENCIAPRO", "gerencia.cable.net.co");
// define("GERENCIAPRU", "10.244.143.19:8888");
define("GERENCIAPRU", "192.168.0.133");
#12924522253921||ACTUALIZACION||80234702||10.244.143.19:8091||192.168.15.213||201012151730253921#
define("BODEGA_SERIALIZADOS", "A");
define("BODEGA_MATERIALES", "K");
define("HILOSACTMASUNIDADES", "2");
define("HILOSACTMASUNIDADESFESTIVO", "20");
define("ACTIVA_ENVIO_CORREOS", "Y"); //ACTIVA O DESACTIVA ENVIO DE CORREO (Y ENVIA CORRERO) (N NO ENVIA CORREO)
define("FTP_ALIADOS_MACHINE","10.244.143.19");
define("FTP_ALIADOS_USER","hectorg");
define("FTP_ALIADOS_PASSWORD","a1b2c3d4e5");
define("WS_COMCEL_ACTIVO", TRUE); //Ejecutar activacion en comcel por WS (true) Ejecutar activacion Manual(False) Sin WS
/**************************************************************************************
 * aqui comienzan las constantes necesarias para facturacion.
 **************************************************************************************/
define("CODIGODIASESPECIALESCAPEX", "RECAPEX");#define el codigo con el que se creo la actividad facturable de dias especiales.
define("CODIGODIASESPECIALESOPEX", "REOPEX");#define el codigo con el que se creo la actividad facturable de dias especiales.

define("CODIGOHORASNOCTURNASCAPEX", "NOCAPEX");#define el codigo con el que se creo la actividad facturable de horas nocturnas.
define("CODIGOHORASNOCTURNASOPEX", "NOOPEX");#define el codigo con el que se creo la actividad facturable de horas nocturnas.

define("VALIDARANGOHORA", TRUE);#HABILITA O DESHABILITA LA VALIDACION DEL RANGO HORA.
define("CIERRACOKIEE",TRUE);

DEFINE('URL_DTH','http://190.183.222.194:8248/IntrawayWS/server.php?wsdl');
DEFINE('authKey_DTH','3d171243d43a41605ad58e1e2fbfea25');#
DEFINE('CLIENTE_DTH','32');#
IF(!DEFINED('SELF_PROVISIONING')) DEFINE('SELF_PROVISIONING',FALSE);#
IF(!DEFINED('TV_PROVISIONING')) DEFINE('TV_PROVISIONING',FALSE);############### #
IF(!DEFINED('SELF_TIPO_SERV')) DEFINE('SELF_TIPO_SERV','<0>TL</0><1>IN</1>');#
IF(!DEFINED('TV_TIPO_SERV')) DEFINE('TV_TIPO_SERV','<0>TV</0><1>DG</1><2>DBA</2><3>enDDG</3><4>DBV</4><5>CAR</5>');#
IF(!DEFINED('KEYWS')) DEFINE('KEYWS','94dda7d96c847be15d52485cc6f4706e');#
IF(!DEFINED('DTH_PROVISIONING')) DEFINE('DTH_PROVISIONING',FALSE);#
IF(!DEFINED('NDS_PROVISIONING')) DEFINE('NDS_PROVISIONING',FALSE);#
IF(!DEFINED('CTI_PROVISIONING')) DEFINE('CTI_PROVISIONING',FALSE);#
IF(!DEFINED('DAC_PROVISIONING')) DEFINE('DAC_PROVISIONING',FALSE);#
IF(!DEFINED('IW_SEND_CONTROLLER')) DEFINE('IW_SEND_CONTROLLER','TRUE');#
IF(!DEFINED('DEBUG_DB')) DEFINE('DEBUG_DB',FALSE);
?>