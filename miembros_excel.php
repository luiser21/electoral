<?php
session_start();
    $conexion = new mysqli('localhost','root','','electoral',3306);
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
	$sql="";
	if($_SESSION["username"]!='alcaldia'){	
			
		$sql="SELECT
				miembros.ID,
				CONCAT(TRIM(miembros.NOMBRES)) AS NOMBRE,
				miembros.CEDULA,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS LIDER,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				municipios.NOMBRE AS MUNICIPIO,
				departamentos.NOMBRE AS DEPARTAMENTO
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
				INNER JOIN municipios ON municipios.ID = puestos_votacion.IDMUNICIPIO
				INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
				where usuario.usuario='".$_SESSION["username"]."' ";
			
			
			$sql.=" ORDER BY NOMBRE ";
		}
	//$consulta = "SELECT concat(paterno,' ', materno, ' ' , nombre) AS alumno, fechanac, sexo, carrera FROM alumno INNER JOIN carrera ON alumno.idcarrera = carrera.idcarrera ORDER BY carrera, nombre";
	$resultado = $conexion->query($sql);
	if($resultado->num_rows > 0 ){
						
		date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'lib/PHPExcel/PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Informe Simpatizantes")
							 ->setKeywords("Informe Simpatizantes")
							 ->setCategory("Reporte excel");

		$tituloReporte = "Informe Simpatizantes";
		$titulosColumnas = array('CEDULA','NOMBRE','NOMBRE_PUESTO','MESA','MUNICIPIO','DEPARTAMENTO','LIDER');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:G1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
					->setCellValue('E3',  $titulosColumnas[4])
					->setCellValue('F3',  $titulosColumnas[5])
					->setCellValue('G3',  $titulosColumnas[6]);
		
		//Se agregan los datos de los alumnos
		$i = 4;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $fila['CEDULA'])
		            ->setCellValue('B'.$i,  utf8_encode($fila['NOMBRE']))
        		    ->setCellValue('C'.$i,  utf8_encode($fila['NOMBRE_PUESTO']))
            		->setCellValue('D'.$i, $fila['MESA'])
					->setCellValue('E'.$i, $fila['MUNICIPIO'])					
					->setCellValue('F'.$i, $fila['DEPARTAMENTO'])
					->setCellValue('G'.$i, $fila['LIDER']);
					$i++;
		}
		
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>14,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => '000000'
        		),
        		'endcolor'   => array(
            		'argb' => 'FFFFFF'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFFFFF')
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => '000000'
                   	)
               	),
				'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                )             
           	)
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));
				
		for($i = 'A'; $i <= 'G'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Simpatizantes');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="InformeSimpatizantes.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>