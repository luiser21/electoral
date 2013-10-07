<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	

$fecha= (!empty($_POST['fecha']))? $_POST['fecha']: 0;

$fecha_nacimiento=array();

$fecha_nacimiento=@split('-',$fecha);

//fecha actual
 
$dia=date('j');
$mes=date('n');
$ano=date('Y');
 
//fecha de nacimiento
 
@$dianaz=$fecha_nacimiento[0];
@$mesnaz=$fecha_nacimiento[1];
@$anonaz=$fecha_nacimiento[2];
 
//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
 
if ((@$mesnaz == @$mes) && (@$dianaz > @$dia)) {
@$ano=($ano-1); }
 
//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
 
if (@$mesnaz > @$mes) {
@$ano=($ano-1);}
 
//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
 
@$edad=($ano-$anonaz);
 
echo $edad.' a&ntilde;os';
?>