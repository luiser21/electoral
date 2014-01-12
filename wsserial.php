<?php
$Raiz = str_replace($_SERVER['PHP_SELF'],'',str_replace('\\','/',$_SERVER['SCRIPT_FILENAME']));
include_once($Raiz."/include/ConfgGral.conf.php");
include_once (INCLUDES ."nusoap.php");
include_once($Raiz."/ControlOperaciones/valida_serial.php");
$namespace="http://Agendamiento.cable.net.co/ControlOperaciones/wsserial";
$Serial = new serial('AS400');
$res = $Serial->traerOT(78248119,148074734);
//$res = $Serial->traerOT(78719853, 148543805);
exit;
//imprimir($res);
/*
ws -> http://192.168.253.246:7001/ControlOperaciones/wsserial?WSDL
test: http://10.244.143.19:8071/ControlOperaciones/wsserial.php

BD: 161 ..
SELECT INITMC TIPO, INMANC FABRICANTE, INSERÑ SERIAL, ININST ESTADO, INACCT CUENTA,
                ININSC,ININSY,ININSM,ININSD, INPSTA ESTADOPREVIO, INVODF
                FROM CABLEDTA.INVMSTR WHERE INACCT = 78248119 AND INWOÑ =148074734
go
SELECT IHITMC TIPO, IHMANC FABRICANTE, IHSERÑ SERIAL, IHINST ESTADO_INV,
        IHSTRC,IHSTRY,IHSTRM,IHSTRD, IHACCT CUENTA,
        IHPGMC PROGRAMADO
        FROM CABLEDTA.INVHIST WHERE IHSERÑ = '21530109838W2B028911' AND IHMANC = 'WHI' AND IHITMC = 'DBV'
 */
$server = new soap_server();
$server->configurewsdl('Seriales',$namespace);
$server->wsdl->schematargetnamespace=$namespace;

$server->wsdl->addComplexType(
'AsocOrder',
'complexType',
'struct',
'all',
'',
array(
	'TIPO' => array('name' => 'TIPO', 'type' => 'xsd:string'),
    'FABRICANTE' => array('name' => 'FABRICANTE', 'type' => 'xsd:string'),
    'SERIAL' => array('name' => 'SERIAL', 'type' => 'xsd:string'),
	'ESTADO' => array('name' => 'ESTADO', 'type' => 'xsd:string'),
	'CUENTA' => array('name' => 'CUENTA', 'type' => 'xsd:string'),
	'FINSTALADO' => array('name' => 'FINSTALADO', 'type' => 'xsd:string'),
	'ESTADOPREVIO' => array('name' => 'ESTADOPREVIO', 'type' => 'xsd:string'),
    'INVODF' => array('name' => 'INVODF', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'AsocOrders',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:AsocOrder[]')
    ),
    'tns:AsocOrder'
);

$server->wsdl->addComplexType(
'AsocOrderConError',
'complexType',
'struct',
'all',
'',
array(
	'ErrorNo' => array('name' => 'ErrorNo', 'type' => 'xsd:string'),
	'ErrorDesc' => array('name' => 'ErrorDesc', 'type' => 'xsd:string'),
	'RESULTADO' => array('name' => 'RESULTADO', 'type' => 'tns:AsocOrders')
	)
);

$server->wsdl->addComplexType(
'AsocSerial',
'complexType',
'struct',
'all',
'',
array(
	'TIPO' => array('name' => 'TIPO', 'type' => 'xsd:string'),
    'FABRICANTE' => array('name' => 'FABRICANTE', 'type' => 'xsd:string'),
    'SERIAL' => array('name' => 'SERIAL', 'type' => 'xsd:string'),
	'ESTADO_INV' => array('name' => 'ESTADO_INV', 'type' => 'xsd:string'),
	'FECHA' => array('name' => 'FECHA', 'type' => 'xsd:string'),
	'CUENTA' => array('name' => 'CUENTA', 'type' => 'xsd:string'),
	'PROGRAMADO' => array('name' => 'PROGRAMADO', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'AsocSeriales',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:AsocSerial[]')
    ),
    'tns:AsocSerial'
);

$server->wsdl->addComplexType(
'AsocSerialConError',
'complexType',
'struct',
'all',
'',
array(
	'ErrorNo' => array('name' => 'ErrorNo', 'type' => 'xsd:string'),
	'ErrorDesc' => array('name' => 'ErrorDesc', 'type' => 'xsd:string'),
	'RESULTADO' => array('name' => 'RESULTADO', 'type' => 'tns:AsocSeriales')
	)
);

$server->register('consultaOT',array('OT' => 'xsd:string','Cuenta' => 'xsd:string'),array('AsocOrders' => 'tns:AsocOrderConError'),$namespace);
$server->register('consultaSerial',array('Serial' => 'xsd:string','Fabricante' => 'xsd:string','Tipo' => 'xsd:string'),array('AsocSeriales' => 'tns:AsocSerialConError'),$namespace);

function consultaOT($OT,$cuenta)
{
   $Serial = new serial('AS400');
   return $Serial->AsocOrder($OT,$cuenta);
}

function consultaSerial($serial,$fabricante,$tipo)
{
   $Serial = new serial('AS400');
   return $Serial->ValidSerial($serial,$fabricante,$tipo);
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>