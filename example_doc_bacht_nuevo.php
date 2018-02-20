<?php

 //datos a enviar
 $data = array("a" => '{"cedula":"27680309","medioconsulta":"Web","recaptcha":"03ANcjospTuz1i1aOTzwnDqFQda2TdFPeXGYEhNTlN8HbdbbvcJJeXZeoYXGMJ66TQd9IOduYQqew3TCr1EuKoq4LmtDfxiXvAtk2Rx3NXhprWoUZbYbFvBULDhlRI5aOqmY56L8hVVCqNaVqCm9_JLSxbIN4lMBllftmIbL4cvys5koUFSHu5Lb5COuzQYs2RZDner_k7O6OdbWfUApVRHjXwKxvVIFqxigDLyLIk-qkiww0jgznmNHQ7t8qitms84D-OmT35S5BIesIaAz4QqWntHBtctvOHxfoXv5ZZ-2gIe1vjVXKCTkJF6pUyuchM-Rt9iuBCwK3Dh8u4fJkY6nsttODCDIoSsWJO6zmNERy_fXFcNbInwqawomb_iuwpyKmqxm9v89jmMRAlEJ8glqBX8t-FmjfRB7PPmuN33gCfV9ydb0hD_zupTWG8JnRpTVQfcWxcO2JVPyriwRoougILwtn4AkbTHQ","agente":"Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0","sistemaoperativo":"windows","navegador":"firefox","dispositivo":"unknown","versionso":"windows-7","versionnavegador":"58.0"}');
 //url contra la que atacamos
 $ch = curl_init();
 //a true, obtendremos una respuesta de la url, en otro caso, 
 //true si es correcto, false si no lo es
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 //establecemos el verbo http que queremos utilizar para la petición
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
 //enviamos el array data
 curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
 //obtenemos la respuesta
 $response = curl_exec($ch);
 // Se cierra el recurso CURL y se liberan los recursos del sistema
 curl_close($ch);
 if(!$response) {
     return false;
 }else{
 var_dump($response);
 }
 
 
$sesion = curl_init("https://app.infovotantes.co/InfoVotantesWS/InfoServices/Servicios/consultarLugar");
// definir tipo de petición a realizar: POST
curl_setopt ($sesion, CURLOPT_POST, true); 
// Le pasamos los parámetros definidos anteriormente
curl_setopt ($sesion, CURLOPT_POSTFIELDS, '{"cedula":"27680309","medioconsulta":"Web","recaptcha":"03ANcjospTuz1i1aOTzwnDqFQda2TdFPeXGYEhNTlN8HbdbbvcJJeXZeoYXGMJ66TQd9IOduYQqew3TCr1EuKoq4LmtDfxiXvAtk2Rx3NXhprWoUZbYbFvBULDhlRI5aOqmY56L8hVVCqNaVqCm9_JLSxbIN4lMBllftmIbL4cvys5koUFSHu5Lb5COuzQYs2RZDner_k7O6OdbWfUApVRHjXwKxvVIFqxigDLyLIk-qkiww0jgznmNHQ7t8qitms84D-OmT35S5BIesIaAz4QqWntHBtctvOHxfoXv5ZZ-2gIe1vjVXKCTkJF6pUyuchM-Rt9iuBCwK3Dh8u4fJkY6nsttODCDIoSsWJO6zmNERy_fXFcNbInwqawomb_iuwpyKmqxm9v89jmMRAlEJ8glqBX8t-FmjfRB7PPmuN33gCfV9ydb0hD_zupTWG8JnRpTVQfcWxcO2JVPyriwRoougILwtn4AkbTHQ","agente":"Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:58.0) Gecko/20100101 Firefox/58.0","sistemaoperativo":"windows","navegador":"firefox","dispositivo":"unknown","versionso":"windows-7","versionnavegador":"58.0"}'); 
// sólo queremos que nos devuelva la respuesta
curl_setopt($sesion, CURLOPT_HEADER, false); 
curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);
// ejecutamos la petición
$respuesta = curl_exec($sesion); 
// cerramos conexión
curl_close($sesion); 
?>