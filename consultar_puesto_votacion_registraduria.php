<?php
include_once "includes/GestionBD.new.class.php";
//imprimir(puesto_votacion('2618362'));  /*Cedula de un Condenado*/
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
		$contexto = stream_context_create($opciones);
		try{
			$contenido = @file_get_contents("http://www3.registraduria.gov.co/censo/_censoresultado.php?nCedula=".$cedula_Excel,false, $contexto);
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
				'DIRECCION'=>'',
				'MESA'=>'',
				'FECHA_INSCRIP'=>''				
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
									if(!empty($contenido)) {
										$puesto_votacion=array(
											'ERROR'=>'INDEFINIDO'			
										);
										return $puesto_votacion;
									}else{
										$puesto_votacion=array(
												'ERROR'=>utf8_decode('Se produjo un error durante el intento de conexion a la Registraduria.')
										);
										return $puesto_votacion;
									}
								}else{
									$puesto_votacion=array(
											'ERROR'=>utf8_decode('La información se encuentra en actualización. Por favor intente más tarde.')			
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
						'ERROR'=>'Debe inscribirse en los períodos que establezca la Registraduría Nacional del Estado Civil en próximas oportunidades'			
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
			$puesto5=limpiar_metas($puesto[4],null);
			$puesto5=explode('Fecha', $puesto5 );

			//Mesa de Votacion
			$puesto6=limpiar_metas($puesto[6],null);
			$puesto6=explode('Censo', $puesto6 );
			$puesto6=limpiar_metas($puesto6[0],null);
			$puesto6=explode('Mesa', $puesto6 );

			//Fecha de inscripcion 
			$puesto7=limpiar_metas($puesto[5],null);

			$puesto_votacion=array(
						'DEPARTAMENTO'=>trim($puesto2[0]),
						'MUNICIPIO'=>trim($puesto3[0]),
						'PUESTO'=>trim($puesto4[0]),
						'DIRECCION'=>trim($puesto5[0]),
						'MESA'=>trim($puesto6[1]),
						'FECHA_INSCRIP'=>trim($puesto7)
						);
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
