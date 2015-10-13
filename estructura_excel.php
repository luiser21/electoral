<?php
session_start();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=informe_votos.xls");
header("Pragma: no-cache");
header("Expires: 0");
    include_once "includes/GestionBD.new.class.php";
	$DBGestion = new GestionBD('AGENDAMIENTO');	
	
	if($_SESSION["username"]=='alcaldia'){	
			
			
			//Get records from database
		 $sql="SELECT
				lideres.ID,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE,
				lideres.CEDULA,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				(SELECT count(*) AS miembros FROM miembros m WHERE lideres.ID  = m.IDLIDER) as MIEMBROS 
				FROM
				lideres
				LEFT JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				LEFT JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				LEFT JOIN mesa_puesto_miembro ON mesa_puesto_miembro.LIDER = lideres.ID
				LEFT JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA AND mesas.IDPUESTO = lideres.IDPUESTOSVOTACION
				LEFT JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
			  where usuario.usuario='".$_SESSION["username"]."' ";			
		
			$sql.=" ORDER BY NOMBRE ";
		
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['MIEMBROS']=utf8_encode($partidos[$i]['MIEMBROS']+1);
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
			}	
		
		}else{
		
			 $sql="SELECT ID,FILE,TRANSFERIR,INVALIDAR,DATOSVALIDOOS,DATOSINVALIDOS,APTOSVOTAR,NOAPTOSVOTAR,CREADO,DIFERENTEMUNICIPIO,
BAJA,PENDIENTE,MUERTE,DEBEINSCRIBIRSE,(SELECT count(CEDULA) from tmp_miembros WHERE PUESTO='Cedula ya existe' AND candidato=26) as DUPLICADO,
(SELECT count(CEDULA) from tmp_miembros WHERE PUESTO<>'Cedula ya existe' AND CANDIDATO=26) AS REPROCESAR from upload_file
				WHERE ESTADO='A' AND CANDIDATO='".$_SESSION["username"]."' ";				
			$sql.=" ORDER BY ID DESC ";
		
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		
			$row=array();

			$row2=array();			?>

			<table width="100%" border="1">
				  <tr>
					<td>ARCHIVOS</td>
					<td>REGISTRADO</td>
					<td>REGISTROS</td>
					<td>APTOS</td>
					<td>VALIDOS</td>
					<td>NOAPTOS</td>
					<td>INVALIDOS</td>					
				  </tr>	<tr>
			<?php for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['FILES']=utf8_encode($partidos[$i]['FILE']);
				$row[$i]['REGISTRADO']=$partidos[$i]['CREADO'];
				$row[$i]['VALIDOS']=number_format($partidos[$i]['DATOSVALIDOOS'],0,",",".");
				$row[$i]['INVALIDOS']=number_format($partidos[$i]['DATOSINVALIDOS'],0,",",".");				
				$row[$i]['REGISTROS']=number_format($partidos[$i]['APTOSVOTAR']+$partidos[$i]['NOAPTOSVOTAR']+$partidos[$i]['DATOSINVALIDOS'],0,",",".");
				$row[$i]['APTOS']=number_format($partidos[$i]['APTOSVOTAR'],0,",",".");
				$row[$i]['NOAPTOS']=number_format($partidos[$i]['NOAPTOSVOTAR']+$partidos[$i]['DATOSINVALIDOS'],0,",",".");
				$_GET["id"]=$row[$i]['ID'];
				echo "<td>".$row[$i]['FILES']."</td>";
				echo "<td>".$row[$i]['REGISTRADO']."</td>";
				echo "<td>".$row[$i]['REGISTROS']."</td>";
				echo "<td>".$row[$i]['APTOS']."</td>";
				echo "<td>".$row[$i]['VALIDOS']."</td>";
				echo "<td>".$row[$i]['NOAPTOS']."</td>";
				echo "<td>".$row[$i]['INVALIDOS']."</td>";			
				echo '<br/>';
				echo '<table width="100%" border="1">
					 
				  <tr>
				  	<td>ID</td>
					<td>CATEGORIAS</td>
					<td>REGISTROS</td>
					<td>PORCENTAJE</td>								
				  </tr>';
				  $sql="SELECT 11 as ID,'100%' AS PORCENTAJE,(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) as MUERTE,'Total Registros Procesados' AS DETALLE from upload_file  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 7 as ID,CONCAT(ROUND((APTOSVOTAR/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,2),'%') AS PORCENTAJE,APTOSVOTAR,'1.APTOS PARA VOTAR' AS DETALLE from upload_file  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 9 as ID,CONCAT(ROUND((DATOSVALIDOOS/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,2),'%') AS PORCENTAJE,DATOSVALIDOOS,'  - Inscritos en el Municipio' AS DETALLE from upload_file  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 6 as ID,CONCAT(ROUND((DIFERENTEMUNICIPIO/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,2),'%') AS PORCENTAJE,DIFERENTEMUNICIPIO,'  - No Inscrito en el Municipo ' AS DETALLE from upload_file WHERE ESTADO='A' AND id=".$_GET["id"]."
UNION
SELECT 8 as ID,CONCAT(ROUND(((NOAPTOSVOTAR+DATOSINVALIDOS)/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,2),'%') AS PORCENTAJE,(NOAPTOSVOTAR+DATOSINVALIDOS),'2.NO APTOS PARA VOTAR' AS DETALLE from upload_file  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 3 as ID,CONCAT(ROUND((DEBEINSCRIBIRSE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,2),'%') AS PORCENTAJE,DEBEINSCRIBIRSE,'  - No se encuentra en el censo para las próximas elecciones' AS DETALLE from upload_file  WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 1 as ID,CONCAT(ROUND((MUERTE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,2),'%') AS PORCENTAJE,MUERTE,'  - Cancelada por Muerte' AS DETALLE from upload_file WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 2 as ID,CONCAT(ROUND((BAJA/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,2),'%') AS PORCENTAJE,BAJA,'  - Baja por Perdida o Suspension de los Derechos Politicos' AS DETALLE from upload_file WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 4 as ID,CONCAT(ROUND((PENDIENTE/(APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS))*100,2),'%') AS PORCENTAJE,PENDIENTE,'  - Pendiente por Solicitud en proceso' AS DETALLE from upload_file WHERE ESTADO='A' AND id=".$_GET["id"]."		
UNION
SELECT 5 as ID,CONCAT(ROUND((count(CEDULA)/(SELECT (APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) from upload_file  WHERE ESTADO='A' AND id=".$_GET["id"]."))*100,2),'%') AS PORCENTAJE,count(CEDULA),'  - Registros Duplicados' AS DETALLE from tmp_miembros WHERE PUESTO='Cedula ya existe'AND IDFILE=".$_GET["id"]."
UNION
SELECT 10 as ID,CONCAT(ROUND((count(CEDULA)/(SELECT (APTOSVOTAR+NOAPTOSVOTAR+DATOSINVALIDOS) from upload_file  WHERE ESTADO='A' AND id=".$_GET["id"]."))*100,2),'%') AS PORCENTAJE,count(CEDULA),'  - Para Reprocesar' AS DETALLE from tmp_miembros WHERE PUESTO<>'Cedula ya existe'AND IDFILE=".$_GET["id"]."";		

				$DBGestion->ConsultaArray($sql);				
				$partidos2=$DBGestion->datos;	
			
				$row2=array();			
				for($y=0; $y<count($partidos2);$y++){
					$row2[$y]['ID']=$partidos2[$y]['ID'];
					$row2[$y]['MUERTE']=number_format($partidos2[$y]['MUERTE'],0,",",".");
					$row2[$y]['DETALLE']=$partidos2[$y]['DETALLE'];
					$row2[$y]['PORCENTAJE']=$partidos2[$y]['PORCENTAJE'];
					echo "<tr><td>".$row2[$y]['ID']."</td>";
					echo "<td>".$row2[$y]['DETALLE']."</td>";
					echo "<td>".$row2[$y]['MUERTE']."</td>";
					echo "<td>".$row2[$y]['PORCENTAJE']."</td></tr>";
				}
				echo '</table>';	
					
			}
			?>  </tr>
</table><?php				
		
		}
	

?>