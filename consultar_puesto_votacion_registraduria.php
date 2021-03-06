<?php
include_once "includes/GestionBD.new.class.php";
//imprimir(puesto_votacion_v2('000'));  /*Cedula de un Condenado*/
//imprimir(puesto_votacion('000'));

function puesto_votacion($cedula_Excel){
	try{
		
		$opciones = array(
		  'http'=>array(
			'method'=>"GET",
			'header'=>"Accept-language: en\r\n" .
					  "Cookie: foo=bar\r\n"
		  )
		);
		$arrContextOptions=array(
		  "ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false				
			),
		); 
		//* VERIFICA QUE ESTE INSTALADO LA LIBRERIA OPENSSL PARA URLS HTTPS *////
		/*$w = stream_get_wrappers();
		echo 'openssl: ',  extension_loaded  ('openssl') ? 'yes':'no', "\n";
		echo 'http wrapper: ', in_array('http', $w) ? 'yes':'no', "\n";
		echo 'https wrapper: ', in_array('https', $w) ? 'yes':'no', "\n";
		echo 'wrappers: ', var_export($w);*/
		$contexto = stream_context_create($arrContextOptions);
		try{
			//$contenido = @file_get_contents("http://www3.registraduria.gov.co/censo/_censoresultado.php?nCedula=".$cedula_Excel,false, $contexto);
			$contenido = @file_get_contents("https://wsp.registraduria.gov.co/censo/_censoResultado.php?nCedula=".$cedula_Excel,false,$contexto);

		}catch(Exception $e){
		//$observacion2 = $e->getMessage();
		throw new Exception('Sin conexion a la registraduria.');		
		}
		$contenido = trim(strip_tags($contenido));
		$buscar=array(chr(13).chr(10), "\r\n", "\n", "\r",); 
		$reemplazar=array("", "", "", ""); 
		$contenido=str_ireplace($buscar,$reemplazar,$contenido);
		$contenido=str_replace("\r",". ",$contenido);
		$contenido=str_replace("\n"," ",$contenido);	
		$posicion_coincidencia = strpos($contenido, 'Departamento');
	 
		//se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
		if ($posicion_coincidencia === false) {
				//echo "NO se ha encontrado la palabra deseada!!!!";
				$puesto_votacion=array(
				'DEPARTAMENTO'=>'',
				'MUNICIPIO'=>'',
				'PUESTO'=>'',
				//'DIRECCION'=>'',
				'MESA'=>'',
				//'FECHA_INSCRIP'=>'',
				'REPETIR'=>0		
				);
				$posicion_coincidencia2 = strpos($contenido, 'Cancelada por Muerte');
				if ($posicion_coincidencia2 === false) {
					$posicion_coincidencia3 = strpos($contenido, 'Debe inscribirse');
					if($posicion_coincidencia3 === false) {
						$posicion_coincidencia4 = strpos($contenido, 'Pendiente por Solicitud en proceso');
						if($posicion_coincidencia4 === false) {
							$posicion_coincidencia5 = strpos($contenido, 'Baja por Perdida o Suspension');
							if($posicion_coincidencia5 === false) {
								$posicion_coincidencia6 = strpos($contenido, 'Por favor intente');
								if($posicion_coincidencia6 === false) {
									$posicion_coincidencia7 = strpos($contenido, 'Baja por trashumancia');
									if($posicion_coincidencia7 === false) {
										$posicion_coincidencia8 = strpos($contenido, 'Baja por Inhumacion');
										if($posicion_coincidencia8 === false) {
											$posicion_coincidencia9 = strpos($contenido, 'Vigente');
											if($posicion_coincidencia9 === false) {
												$posicion_coincidencia10 = strpos($contenido, 'Cancelada por Doble Cedulacion');
												if($posicion_coincidencia10 === false) {
													$posicion_coincidencia11 = strpos($contenido, 'documento Incorrecto');
													if($posicion_coincidencia11 === false) {
														if(!empty($contenido)) {
															$puesto_votacion=array(
																'ERROR'=>'INDEFINIDO'			
															);
															return $puesto_votacion;
														}else{
															$puesto_votacion=array(
																	'ERROR'=>utf8_decode('Se produjo un error durante el intento de conexion a la Registraduria')
															);
															$puesto_votacion=array(
																	'REPETIR'=>1
															);
															return $puesto_votacion;
														}
													}else{
														$puesto_votacion=array(
															'ERROR'=>utf8_decode('Numero de documento Incorrecto')			
														);
													return $puesto_votacion;
													}
												}else{
													$puesto_votacion=array(
														'ERROR'=>utf8_decode('Cancelada por Doble Cedulacion')			
													);
												return $puesto_votacion;
												}
											}else{
												$puesto_votacion=array(
													'ERROR'=>utf8_decode('Vigente')			
												);
											return $puesto_votacion;
											}
										}else{
											$puesto_votacion=array(
												'ERROR'=>utf8_decode('Baja por Inhumacion o Necrodactilia Positiva')			
											);
										return $puesto_votacion;
										}
									}else{
										$puesto_votacion=array(
												'ERROR'=>utf8_decode('Baja por trashumancia')			
										);
									return $puesto_votacion;
									}
								}else{
									$puesto_votacion=array(
											'ERROR'=>utf8_decode('La informacion se encuentra en actualizacion')			
									);
									return $puesto_votacion;
								}
							}else{
								$puesto_votacion=array(
										'ERROR'=>'Baja por Perdida o Suspension de los Derechos Politicos'			
								);
								return $puesto_votacion;
							}
						}else{
							$puesto_votacion=array(
									'ERROR'=>'Pendiente por Solicitud en proceso'			
							);
							return $puesto_votacion;
						}
					}else{
						$puesto_votacion=array(
						'ERROR'=>'Debe inscribirse'			
						);
					return $puesto_votacion;
					}
				}else{
					$puesto_votacion=array(
						'ERROR'=>'Cancelada por Muerte'			
						);
					return $puesto_votacion;
				}
				return $puesto_votacion;
		} else {
				
			$resultado = substr($contenido, 1159,1702);

			$puesto=explode( ':', $resultado );
			//imprimir($puesto);
			//Departamento
			$puesto2=limpiar_metas($puesto[1],null);
			$puesto2=explode( 'Municipio', $puesto2 );

			//Municipio
			$puesto3=limpiar_metas($puesto[2],null);
			$puesto3=explode( 'Puesto', $puesto3 );

			//Puesto
			$puesto4=limpiar_metas($puesto[3],null);
			$puesto4=explode('Direcci', $puesto4 );

			//Direccion del Puesto
			//$puesto5=limpiar_metas($puesto[4],null);
			//$puesto5=explode('Fecha', $puesto5 );

			//Mesa de Votacion
			$puesto6=limpiar_metas($puesto[6],null);
			$puesto6=explode('Censo', $puesto6 );
			$puesto6=limpiar_metas($puesto6[0],null);
			$puesto6=explode('Mesa', $puesto6 );

			//Fecha de inscripcion 
			//$puesto7=limpiar_metas($puesto[5],null);

			$puesto_votacion=array(
						'DEPARTAMENTO'=>trim($puesto2[0]),
						'MUNICIPIO'=>trim($puesto3[0]),
						'PUESTO'=>trim($puesto4[0]),
						//'DIRECCION'=>trim($puesto5[0]),
						'MESA'=>trim($puesto6[1])
						//'FECHA_INSCRIP'=>trim($puesto7)
						);
			//imprimir($puesto_votacion);//exit;
			 return $puesto_votacion;
		}
	}catch(Exception $e){
		//$observacion2 = $e->getMessage();
		throw new Exception('Sin conexion a la registraduria.');		
	}
}
function puesto_votacion_v2($cedula_Excel){
	try{
		
		
		try{
			$data = array(
					'cedula' => $cedula_Excel,
					'medioconsulta' => 'Web',
					'recaptcha' => '03ANcjosrP2rNJoYWe22oG-SAsl5as-HVgjh-gGe12dobR-0rYuLTdepidQhzIZpmP0HImKJbac35fy63XVvEFsR6WV6L_Lq6cyLB0miEwTKzJHy76MiZUkRBZjYsdGW4rvGInT-98S6sAbat-w4hj4FNAR47R_a5rwlZuO9-_w6GLN16h7ROmg-ndLREZh7ubKDaFzgC_3NORkFOUQZJ2BaZCis2ecc8v3nHGx_VRpDxwSBlO-F32Q3KZZeHfmzlE1Z88Q7DM9Vni9t8Yn0pMHQZbPRXXk5ovFvJ1mDa4O9z9G5EZw3zbmAVLHqtOjgBq5qJK1KMEYGUga0I6cbsgMNwoP9Rgurkjwn4KBqBdErFvWnibsD5jbTpQh4B2C_YD00azPYEXsUg3RPIImBbwaqQy4VB6N-Ehqt9OzB7143MnUHCHpUgrI5W9t0LvlK55NoHNIePaly_63uuxp9-ujsfz0FzLf3-bYw',				'versionnavegador' => '58.0',
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
imprimir($result);//exit;
		}catch(Exception $e){
		//$observacion2 = $e->getMessage();
		throw new Exception('Sin conexion a la registraduria.');		
		}
		$puesto=json_decode($result, true);

		//imprimir($puesto);
		if(!empty($puesto['data']['novedades']['nombreNovedad'])){
			//var_dump($puesto['mensaje']);
			$contenido = trim(strip_tags($puesto['data']['novedades']['nombreNovedad']));
			$buscar=array(chr(13).chr(10), "\r\n", "\n", "\r",); 
			$reemplazar=array("", "", "", ""); 
			$contenido=str_ireplace($buscar,$reemplazar,$contenido);
			$contenido=str_replace("\r",". ",$contenido);
			$contenido=str_replace("\n"," ",$contenido);	
			$posicion_coincidencia = strpos($contenido, 'Departamento');
			//var_dump($contenido);
		
		//se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
			if ($posicion_coincidencia === false) {
					//echo "NO se ha encontrado la palabra deseada!!!!";
					$puesto_votacion=array(
					'DEPARTAMENTO'=>'',
					'MUNICIPIO'=>'',
					'PUESTO'=>'',
					//'DIRECCION'=>'',
					'MESA'=>'',
					//'FECHA_INSCRIP'=>'',
					'REPETIR'=>0		
					);
					$posicion_coincidencia2 = strpos($contenido, 'Cancelada por Muerte');
					if ($posicion_coincidencia2 === false) {
						$posicion_coincidencia3 = strpos($contenido, 'Debe inscribirse');
						if($posicion_coincidencia3 === false) {
							$posicion_coincidencia4 = strpos($contenido, 'Pendiente por Solicitud en proceso');
							if($posicion_coincidencia4 === false) {
								$posicion_coincidencia5 = strpos($contenido, 'Baja por Perdida o Suspension');
								if($posicion_coincidencia5 === false) {
									$posicion_coincidencia6 = strpos($contenido, 'Por favor intente');
									if($posicion_coincidencia6 === false) {
										$posicion_coincidencia7 = strpos($contenido, 'Baja por trashumancia');
										if($posicion_coincidencia7 === false) {
											$posicion_coincidencia8 = strpos($contenido, 'Baja por Inhumacion');
											if($posicion_coincidencia8 === false) {
												$posicion_coincidencia9 = strpos($contenido, 'Vigente');
												if($posicion_coincidencia9 === false) {
													$posicion_coincidencia10 = strpos($contenido, 'Cancelada por Doble Cedulacion');
													if($posicion_coincidencia10 === false) {
														$posicion_coincidencia11 = strpos($contenido, 'documento Incorrecto');
														if($posicion_coincidencia11 === false) {
															if(!empty($contenido)) {
																$puesto_votacion=array(
																	'ERROR'=>'INDEFINIDO'			
																);
																return $puesto_votacion;
															}else{
																imprimir($result);
																$puesto_votacion=array(
																		'ERROR'=>utf8_decode('Se produjo un error durante el intento de conexion a la Registraduria')
																);
																$puesto_votacion=array(
																		'REPETIR'=>1
																);
																return $puesto_votacion;
															}
														}else{
															$puesto_votacion=array(
																'ERROR'=>utf8_decode('Numero de documento Incorrecto')			
															);
														return $puesto_votacion;
														}
													}else{
														$puesto_votacion=array(
															'ERROR'=>utf8_decode('Cancelada por Doble Cedulacion')			
														);
													return $puesto_votacion;
													}
												}else{
													$puesto_votacion=array(
														'ERROR'=>utf8_decode('Vigente')			
													);
												return $puesto_votacion;
												}
											}else{
												$puesto_votacion=array(
													'ERROR'=>utf8_decode('Baja por Inhumacion o Necrodactilia Positiva')			
												);
											return $puesto_votacion;
											}
										}else{
											$puesto_votacion=array(
													'ERROR'=>utf8_decode('Baja por trashumancia')			
											);
										return $puesto_votacion;
										}
									}else{
										$puesto_votacion=array(
												'ERROR'=>utf8_decode('La informacion se encuentra en actualizacion')			
										);
										return $puesto_votacion;
									}
								}else{
									$puesto_votacion=array(
											'ERROR'=>'Baja por Perdida o Suspension de los Derechos Politicos'			
									);
									return $puesto_votacion;
								}
							}else{
								$puesto_votacion=array(
										'ERROR'=>'Pendiente por Solicitud en proceso'			
								);
								return $puesto_votacion;
							}
						}else{
							$puesto_votacion=array(
							'ERROR'=>'Debe inscribirse'			
							);
						return $puesto_votacion;
						}
					}else{
						$puesto_votacion=array(
							'ERROR'=>'Cancelada por Muerte'			
							);
						return $puesto_votacion;
					}
					return $puesto_votacion;
			} 
		}else{
			//var_dump($puesto['data']['lugarVotacion']);
			$puesto_votacion=array(
						'DEPARTAMENTO'=>trim($puesto['data']['lugarVotacion']['departamento']),
						'MUNICIPIO'=>trim($puesto['data']['lugarVotacion']['municipio']),
						'PUESTO'=>trim($puesto['data']['lugarVotacion']['puesto']),
						//'DIRECCION'=>trim($puesto5[0]),
						'MESA'=>trim($puesto['data']['lugarVotacion']['mesa'])
						//'FECHA_INSCRIP'=>trim($puesto7)
						);
			//imprimir($puesto_votacion);//exit;
			 return $puesto_votacion;
		}
	}catch(Exception $e){
		//$observacion2 = $e->getMessage();
		throw new Exception('Sin conexion a la registraduria.');		
	}
}
function limpiar_metas($string,$corte = null)
	    {
	        $caracters_no_permitidos = array('"',"'");
	        # paso los caracteres entities tipo &aacute; $gt;etc a sus respectivos html
	        $s = html_entity_decode($string,ENT_COMPAT,'UTF-8');
	        # quito todas las etiquetas html y php
	        $s = strip_tags($s);
	        # elimino todos los retorno de carro
	       // $s = str_replace("r", '', $s);
	        # en todos los espacios en blanco le añado un <br /> para después eliminarlo
	        $s = preg_replace('/(?<!>)n/', "<br />n", $s);
	        # elimino la inserción de nuevas lineas
	        //$s = str_replace("n", '', $s);
	        # elimino tabulaciones y el resto de la cadena
	        //$s = str_replace("t", '', $s);
	        # elimino caracteres en blanco
	        $s = preg_replace('/[ ]+/', ' ', $s);
	        $s = preg_replace('/<!--[^-]*-->/', '', $s);
	        # vuelvo a hacer el strip para quitar el <br /> que he añadido antes para eliminar las saltos de carro y nuevas lineas
	        $s  = strip_tags($s);
	        # elimino los caracters como comillas dobles y simples
	        $s = str_replace($caracters_no_permitidos,"",$s);
	         
	        if (isset($corte) && (is_numeric($corte)))
	        {
	            $s = mb_substr($s,0,$corte, 'UTF-8');
	        }
	                 
	        return $s;
	    }
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }

    switch ($errno) {
    case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
        echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
        break;

    default:
		$puesto=explode( ':', $errstr );
		if(!empty($puesto[2]) && !empty($puesto[3]) && trim($puesto[2])=='failed to open stream'){
			echo $puesto[3].'<br/>http://www3.registraduria.gov.co';
		}else{
			echo "Unknown error type: [$errno] $errstr<br />\n";
        }
		break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

// function to test the error handling
function scale_by_log($vect, $scale)
{
    if (!is_numeric($scale) || $scale <= 0) {
        trigger_error("log(x) for x <= 0 is undefined, you used: scale = $scale", E_USER_ERROR);
    }

    if (!is_array($vect)) {
        trigger_error("Incorrect input vector, array of values expected", E_USER_WARNING);
        return null;
    }

    $temp = array();
    foreach($vect as $pos => $value) {
        if (!is_numeric($value)) {
            trigger_error("Value at position $pos is not a number, using 0 (zero)", E_USER_NOTICE);
            $value = 0;
        }
        $temp[$pos] = log($scale) * $value;
    }

    return $temp;
}

?>
