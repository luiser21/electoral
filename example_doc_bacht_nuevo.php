<?php

$data = array(
        'cedula' => '000',
        'medioconsulta' => 'Web',
		'recaptcha' => '03ANcjosrM5ngDnFcoWohaJcRGlH9lEE4XzegA5Xw3NV-NLebT8KcOF-gVeB6unJlLZnbbLOdxBSox8THvnAbHufR6fKKGPZXEos0EtmYZp9V1JvH6IqkF6tesmX-b3SMvsGNIonygCNQF5RLNWOGGus8n_EmRNOM9v_tRUI5VcuX2eD-06T6yxIfJo2m5TZbXDMfVblZMXVySYW47LTCRkHc8Twp6e6agIZHEfZRyKjvI8SzzB3fMr9sc89ukzDkViWDg0-uYWNnJ1QbqMaMYhf6x4Dy3lxV5jXYqk9-aWDXR1XPwZtDbI1_JYmdB59GMSsaPpBPqINm0cPKTP2E06ZheEnaursiLGhFok6TNkmUl-OpZPfd88_1yrLwfXC6Ah8EhM_xDtdlp-FzJieSzg4TRd0Yh36Vml9QU5e2B-rOLV55YPpqbR1KFnve0TSHI76UTdHedpZvJ1yACdUXpL5QxqGTLmDOnH73YFK8C9CpWegPj5rAhcCx-uNEehmlPGeeLlzXkYYxjvFWC55N0yfKHVsi6It_XLw',
        'versionnavegador' => '58.0',
		'versionso' => 'windows-7',
        'dispositivo' => 'unknown',
		'navegador' => 'firefox',
        'sistemaoperativo' => 'windows',
		'agente' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0'
		
    );                                                                    
$data_string = json_encode($data);                                                                                   
   //var_dump($data_string);                                                                                                               
$ch = curl_init('https://app.infovotantes.co/InfoVotantesWS/InfoServices/Servicios/consultarLugar');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);                                                                  
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
	'Host:app.infovotantes.co',
	'User-Agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0',
	'Accept:application/json, text/plain, */*',
	'Accept-Language:es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3',
	'Accept-Encoding:gzip, deflate, br',
	'Referer:https://consulta.infovotantes.co/',
	'Content-Type:application/json',
	'Content-Length:'. strlen($data_string),
	'Origin:https://consulta.infovotantes.co',
	'Connection:keep-alive')                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);

$puesto=json_decode($result, true);

$contenido = trim(strip_tags($puesto['mensaje']));
		$buscar=array(chr(13).chr(10), "\r\n", "\n", "\r",); 
		$reemplazar=array("", "", "", ""); 
		$contenido=str_ireplace($buscar,$reemplazar,$contenido);
		$contenido=str_replace("\r",". ",$contenido);
		$contenido=str_replace("\n"," ",$contenido);	
		$posicion_coincidencia = strpos($contenido, 'Departamento');
		var_dump($contenido);
?>