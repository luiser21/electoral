<?php
session_start();
include_once "includes/GestionBD.new.class.php";
try
{
	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');

		//Get record count
		if($_SESSION["username"]!='edgarcarreno'){	
		
			$sql="SELECT
				m.ID as CODIGO,
				m.MESA as MESAS				
				FROM
				mesas m
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = m.IDPUESTO
				where puestos_votacion.IDMUNICIPIO=(SELECT candidato.municipio FROM candidato INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO where usuario.usuario='".$_SESSION["username"]."')	and puestos_votacion.IDPUESTO='".$_GET["idpuesto"]."'";	
			if(isset($_POST["name"])!=""){
				$sql.=" where upper(lideres.NOMBRES) like upper('%".$_POST["name"]."%') ";
			}			
			//Add all records to an array
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$recordCount=count($partidos);	
			
			//Get records from database
			$sql="SELECT
				m.ID as CODIGO,
				m.MESA as MESAS,
				(SELECT
					count(*) as VOTOS
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.USUARIO='".$_SESSION["username"]."' AND puestos_votacion.IDPUESTO='".$_GET["idpuesto"]."' and mesas.ID=m.ID) as VOTOSPREVISTOS,
				m.votoreal as VOTOREAL,
				m.votoreal - (SELECT
				 count(*) as miembros 
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.USUARIO='".$_SESSION["username"]."' AND puestos_votacion.IDPUESTO='".$_GET["idpuesto"]."' and mesas.ID=m.ID) as VARIACION
				FROM
				mesas m
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = m.IDPUESTO
				where puestos_votacion.IDMUNICIPIO=(SELECT candidato.municipio FROM candidato INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO where usuario.usuario='".$_SESSION["username"]."')
	and puestos_votacion.IDPUESTO='".$_GET["idpuesto"]."'";	
			
			if(isset($_POST["name"])!=""){
				$sql.=" where upper(lideres.NOMBRES) like upper('%".$_POST["name"]."%') ";
			}	
				
				$sql.=" order by m.mesa ";			
		//	$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";	
					
			//Add all records to an array
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
	
			$Idmiembros=array();
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$Idmiembros=array();
				$row[$i]['CODIGO']=$partidos[$i]['CODIGO'];				
				$sql="SELECT
					 CONCAT(trim(miembros.nombres),' ',trim(miembros.apellidos)) as miembros
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.usuario='".$_SESSION["username"]."' and puestos_votacion.IDPUESTO='".$_GET["idpuesto"]."' and mesas.ID='".$row[$i]['CODIGO']."'";
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
m.ID as CODIGO,
m.MESA as MESAS,
m.votoreal as VOTOREAL,
(SELECT
					count(*) as VOTOS
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.USUARIO='".$_SESSION["username"]."' AND puestos_votacion.IDPUESTO='".$_GET["idpuesto"]."' and mesas.ID=m.ID) as VOTOSPREVISTOS,
m.votoreal - (SELECT
				 count(*) as miembros 
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.USUARIO='".$_SESSION["username"]."' AND puestos_votacion.IDPUESTO='".$_GET["idpuesto"]."' and mesas.ID=m.ID) as VARIACION
FROM
mesas m
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = m.IDPUESTO
				where puestos_votacion.IDMUNICIPIO=(SELECT candidato.municipio FROM candidato INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO where usuario.usuario='".$_SESSION["username"]."')
	and puestos_votacion.IDPUESTO='".$_GET["idpuesto"]."') TOTAL ";	
			$DBGestion->ConsultaArray($sql);				
			$totales=$DBGestion->datos;
			$row = array_merge($row, $totales);

			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $recordCount;
			$jTableResult['Records'] = $row;
			
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