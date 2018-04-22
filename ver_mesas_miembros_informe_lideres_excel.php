<?php
session_start();
include_once "includes/GestionBD.new.class.php";
/** Se agrega la libreria PHPExcel */
include_once "lib/PHPExcel/PHPExcel.php";
 
// Se crea el objeto PHPExcel
 $objPHPExcel = new PHPExcel();
 // Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("SIGUE") // Nombre del autor
    ->setLastModifiedBy("SIGUE") //Ultimo usuario que lo modificó
    ->setTitle("Reporte Excel Miembros x Lideres") // Titulo
    ->setSubject("Reporte Excel Miembros x Lideres") //Asunto
    ->setDescription("Reporte de Miembros") //Descripción
    ->setKeywords("Reporte de Miembros") //Etiquetas
    ->setCategory("Reporte de Miembros"); //Categorias
	
$tituloReporte = "Reporte Excel Miembros x Lideres";
$titulosColumnas = array('LIDER','SIMPATIZANTE', 'CEDULA', 'PUESTO DE VOATACION', 'MESA','VOTOREAL','VARIACION');
// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:G1');
 

	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');

		//Get record count
		
	
			$sql="SELECT
					miembros.ID,
					miembros.NOMBRES,
					miembros.CEDULA,
					puestos_votacion.NOMBRE_PUESTO,
					mesas.MESA,
					mesas.VOTOREAL
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER 
					INNER JOIN capitanes ON capitanes.IDCAPITAN=lideres.IDCAPITAN
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO 
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO 
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = miembros.IDPUESTOSVOTACION 
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID and mesa_puesto_miembro.candidato='".$_SESSION["username"]."' 
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN municipios ON municipios.ID = puestos_votacion.IDMUNICIPIO 
					where usuario.USUARIO='".$_SESSION["username"]."'  and capitanes.IDCAPITAN='".$_GET["idlider"]."'";
								
					$sql.=" GROUP BY miembros.id ";	
			
			//Add all records to an array
			//echo $sql;exit;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$recordCount=count($partidos);	
			
			//Get records from database
			$sql="SELECT
					miembros.ID,
					miembros.NOMBRES,
					miembros.CEDULA,
					puestos_votacion.NOMBRE_PUESTO,
					mesas.MESA,
					mesas.VOTOREAL,
					CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE_LIDER,
					capitanes.NOMBRE_CAPITAN AS CAPITAN
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER 
					INNER JOIN capitanes ON capitanes.IDCAPITAN=lideres.IDCAPITAN
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO 
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO 
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = miembros.IDPUESTOSVOTACION 
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID and mesa_puesto_miembro.candidato='".$_SESSION["username"]."' 
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN municipios ON municipios.ID = puestos_votacion.IDMUNICIPIO 
					where usuario.USUARIO='".$_SESSION["username"]."'  and capitanes.IDCAPITAN='".$_GET["idlider"]."' ";
					
					$sql.=" GROUP BY miembros.id ";	
			
			
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			$idlider='';
			$row=array();

//Se agregan los datos de los alumnos
 
 $y = 4; //Numero de fila donde se va a comenzar a rellenar
			// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1','CAPITAN: '.$partidos[0]['CAPITAN']) // Titulo del reporte
    ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
    ->setCellValue('B3',  $titulosColumnas[1])
    ->setCellValue('C3',  $titulosColumnas[2])
    ->setCellValue('D3',  $titulosColumnas[3])
	->setCellValue('E3',  $titulosColumnas[4])
	->setCellValue('F3',  $titulosColumnas[5])
	->setCellValue('G3',  $titulosColumnas[6]);
	
			 // Titulo del reporte
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE_LIDER']=utf8_encode($partidos[$i]['NOMBRE_LIDER']);
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRES']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
				$row[$i]['VOTOREAL']=$partidos[$i]['VOTOREAL'];
				$row[$i]['VARIACION']=(($partidos[$i]['VOTOREAL']-1)==0)?  "0":$partidos[$i]['VOTOREAL']-1;
				
				 $objPHPExcel->setActiveSheetIndex(0)
				 ->setCellValue('A'.$y, $row[$i]['NOMBRE_LIDER'])
				 ->setCellValue('B'.$y, $row[$i]['NOMBRE'])
				 ->setCellValue('C'.$y, $row[$i]['CEDULA'])
				 ->setCellValue('D'.$y, $row[$i]['NOMBRE_PUESTO'])
				 ->setCellValue('E'.$y, $row[$i]['MESA'])
				 ->setCellValue('F'.$y, $row[$i]['VOTOREAL'])				 
				 ->setCellValue('G'.$y, $row[$i]['VARIACION']);
				 $y++;
			}	
				
			//Return result to jTable
			/*$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);*/
		
		//print json_encode($jTableResult);		


$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'argb' => '778899')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
  'rotation'   => 90,
        'startcolor' => array(
            'rgb' => '778899'
        ),
        'endcolor' => array(
            'argb' => '778899'
        )
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '778899'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '778899'
            )
        )
    ),
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
  'type'  => PHPExcel_Style_Fill::FILL_SOLID,
  'color' => array(
            'argb' => 'ffffff')
  ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
      'color' => array(
              'rgb' => '000000'
            )
        )
    )
));
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));	
for($i = 'A'; $i <= 'G'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}
// Se asigna el nombre a la hoja
$objPHPExcel->getActiveSheet()->setTitle('Miembros');
 
// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
$objPHPExcel->setActiveSheetIndex(0);
 
// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reportedealumnos.xlsx"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
	
?>