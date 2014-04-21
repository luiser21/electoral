<?php 
//$url="http://www.registraduria.gov.co/censo/_censoresultado.php?nCedula=1126418237";
include_once "includes/funciones.inc.php";
function Obtener_contenidos($url,$inicio='',$final){
$source = @file_get_contents($url)or die('se ha producido un error');
$posicion_inicio = strpos($source, $inicio) + strlen($inicio);
$posicion_final = strpos($source, $final) - $posicion_inicio;
$found_text = substr($source, $posicion_inicio, $posicion_final);

return $inicio . $found_text .$final;
}
$url = 'http://www.registraduria.gov.co/censo/_censoresultado.php?nCedula=1126418237'; /// pagina web del contenido


$texto=Obtener_contenidos($url,'<body>','</body>');


$convert = explode("\n", trim($texto)); //create array separate by new line

for ($i=0;$i<count($convert);$i++) 
{
     $convert[$i].', '; //write value by index
}

imprimir($convert);


$cadena="En un lugar del reino Leonés :) había un rapacín muy listo";


// Palabra que queremos buscar
$palabra=preg_quote('Usuario');
if(@eregi("[ tnr]+".$palabra."[ tnr]+",$texto)) { 
    echo 'Si existe.'; 
} else { 
    echo 'No existe'; 
}   
// Obtener_contenidos(url,ancla inicio,ancla final);
?>

