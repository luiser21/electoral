<?php
define('AUTENTICAAD','N');//Flag Realiza la Validacion de Usuario en el Directori Activo [S/N]
define('SESSIONES','N');//Flag Realiza la Validacion de Usuario Por Variables de Sesion [S/N]
define('COOKIES','S'); //Flag Realiza Validacion de Usuarios por Cokies [S/N]
define("GENERALOG",'N');//Flag Habilita la Generacion de log [S/N]
define("VALIDACADICIONALES",7);
define("ROOT","F:/wwwroot/etom_web/menu/Etom1/");
define("ROOTREL","F:/wwwroot/etom_web/menu/Etom1/");
define("TEMPLATES",ROOT."Template/");
define("INCLUDES",ROOT."include/");
define("FUNCIONES",ROOT."Funciones/");
define("IMAGENES",ROOT."image/");
//define("RAIZ",str_replace($_SERVER['PHP_SELF'],'',str_replace('\\','/',$_SERVER['SCRIPT_FILENAME']))."/");
define("RAIZ","E:/AgendamientoExpansion/");
include(INCLUDES."Texto.ini.php");
//echo INCLUDES;
//Para evitar problemas con la hora
putenv('TZ=America/Bogota');
define('PERFILCG0','<PERFILCGO><PERFIL>81</PERFIL></PERFILCGO>');#ID DE PERFIL SEPARADO POR [#] EJ. 81#82#134

if (!defined('CDATALIB')) {
define("CDATALIB","CABLEDTA");
define("TVCDTALIB","TVCABLEDTA");
}

define('ARCHIVES',ROOT.'ArchiveContainer/');

if(!defined("LOGAUDITORIA")) {
    define("LOGAUDITORIA",true);
    define("LOGAUDITORIAPATH","");
}

?>