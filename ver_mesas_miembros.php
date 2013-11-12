<?php
session_start();
include_once "includes/GestionBD.new.class.php";
try
{
	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');

		//Get record count
		if($_SESSION["username"]!='edgarcarreno'){	
		
			$sql="SELECT lideres.ID, CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE, lideres.CEDULA, puestos_votacion.NOMBRE_PUESTO, mesas.MESA, (SELECT COUNT(ID) FROM miembros WHERE miembros.IDLIDER=lideres.ID) AS MIEMBROS FROM lideres INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = lideres.IDPUESTOSVOTACION INNER JOIN mesas ON mesas.IDPUESTO = puestos_votacion.IDPUESTO	INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID AND mesa_puesto_miembro.LIDER = lideres.ID ";	
			if(isset($_POST["name"])!=""){
				$sql.=" where upper(lideres.NOMBRES) like upper('%".$_POST["name"]."%') ";
			}			
			//Add all records to an array
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$recordCount=count($partidos);	
			
			//Get records from database
			$sql="SELECT lideres.ID, CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE, lideres.CEDULA, puestos_votacion.NOMBRE_PUESTO, mesas.MESA, (SELECT COUNT(ID) FROM miembros WHERE miembros.IDLIDER=lideres.ID) AS MIEMBROS FROM lideres INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = lideres.IDPUESTOSVOTACION INNER JOIN mesas ON mesas.IDPUESTO = puestos_votacion.IDPUESTO	INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID AND mesa_puesto_miembro.LIDER = lideres.ID ";	
			
			if(isset($_POST["name"])!=""){
				$sql.=" where upper(lideres.NOMBRES) like upper('%".$_POST["name"]."%') ";
			}	
			$sql.=" ORDER BY NOMBRE ";				
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";	
					
			//Add all records to an array
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['CEDULA']=$partidos[$i]['CEDULA'];
				$row[$i]['LIDER']=utf8_encode($partidos[$i]['LIDER']);
				$row[$i]['NOMBRE_PUESTO']=$partidos[$i]['NOMBRE_PUESTO'];
				$row[$i]['MESA']=$partidos[$i]['MESA'];
			}
				
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}else{
			$sql="SELECT
				mesas_2010.mesas as MESAS,
				mesas_2010.votoreal as VOTOREAL
				FROM
				mesas_2010
				INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
				where puesto_2010.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')	and puesto_2010.codigo='".$_GET["idpuesto"]."'";
					
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		$sql="SELECT
				m.codigo as CODIGO,
				m.mesas as MESAS,
				(SELECT
				 count(*) as miembros 
				FROM
				miembros_2010
				INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
				INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
				INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.codigo='".$_GET["idpuesto"]."' and mesas_2010.codigo=m.codigo) as VOTOSPREVISTOS,
				m.votoreal as VOTOREAL,
				m.votoreal - (SELECT
				 count(*) as miembros 
				FROM
				miembros_2010
				INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
				INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
				INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.codigo='".$_GET["idpuesto"]."' and mesas_2010.codigo=m.codigo) as VARIACION
				FROM
				mesas_2010 m
				INNER JOIN puesto_2010 ON puesto_2010.codigo = m.puesto
				where puesto_2010.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')	and puesto_2010.codigo='".$_GET["idpuesto"]."' ";
			
			$sql.=" order by m.mesas ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$Idmiembros=array();
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$Idmiembros=array();
				$row[$i]['CODIGO']=$partidos[$i]['CODIGO'];				
				$sql="SELECT
					 CONCAT(trim(miembros_2010.nombre),' ',trim(miembros_2010.apellido)) as miembros
					FROM
					miembros_2010
					INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
					INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
					INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
					INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
					INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
					where usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.codigo='".$_GET["idpuesto"]."' and mesas_2010.codigo='".$row[$i]['CODIGO']."'";
				$DBGestion->ConsultaArray($sql);				
				$miembros=$DBGestion->datos;
				foreach ($miembros as $value) {
					$Idmiembros[]=$value['miembros'];
				}
				$Idmiembros=implode(", ",$Idmiembros);
				$row[$i]['SIMPATIZANTES']=$Idmiembros;
				$row[$i]['VOTOSPREVISTOS']=$partidos[$i]['VOTOSPREVISTOS'];
				$row[$i]['VOTOREAL']=$partidos[$i]['VOTOREAL'];
				$row[$i]['MESAS']='Mesa #'.$partidos[$i]['MESAS'];
				$row[$i]['VARIACION']=$partidos[$i]['VARIACION'];
			}
			
			$sql="SELECT '' as CODIGO,'' as SIMPATIZANTES, CONCAT(SUM(VOTOSPREVISTOS),'  ','Votos Previstos') as VOTOSPREVISTOS, CONCAT(SUM(votoreal),'  ','Votos Reales') as VOTOREAL, 'TOTALES' as MESAS, CONCAT(SUM(variacion),'  ','Variacion') as VARIACION FROM 
(SELECT
m.codigo as CODIGO,
m.mesas as MESAS,
m.votoreal as VOTOREAL,
(SELECT
				 count(*) as miembros 
				FROM
				miembros_2010
				INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
				INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
				INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.codigo='".$_GET["idpuesto"]."' and mesas_2010.codigo=m.codigo) as VOTOSPREVISTOS,
m.votoreal - (SELECT
				 count(*) as miembros 
				FROM
				miembros_2010
				INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
				INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
				INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.codigo='".$_GET["idpuesto"]."' and mesas_2010.codigo=m.codigo) as VARIACION
FROM
mesas_2010 m
INNER JOIN puesto_2010 ON puesto_2010.codigo = m.puesto
where puesto_2010.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 
INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')
and puesto_2010.codigo='".$_GET["idpuesto"]."') TOTAL";	
			$DBGestion->ConsultaArray($sql);				
			$totales=$DBGestion->datos;
			$row = array_merge($row, $totales);

			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}
		print json_encode($jTableResult);		

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>