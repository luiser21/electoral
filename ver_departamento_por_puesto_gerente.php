<?php
session_start();
include_once "includes/GestionBD.new.class.php";
try
{
	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');
$_GET["action"] = "list";
//var_dump($_GET['departamento']);exit;
/*$_GET["jtPageSize"]=	2;
$_GET["jtStartIndex"]=0;*/
	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		if($_SESSION["username"]!='alcaldia'){	
			$sql="";
			if($_SESSION['tipocandidato']=='SENADO'){
			
			$sql="SELECT municipios.ID, municipios.NOMBRE as MUNICIPIO,
					(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='C21' AND municipios.ID=elecciones_senado.IDMUNICIPIO) AS 'C21',
					(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='U6' AND municipios.ID=elecciones_senado.IDMUNICIPIO) AS 'U6',
					(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='U24' AND municipios.ID=elecciones_senado.IDMUNICIPIO) AS 'U24',
					(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO IN ('U24','C21','U6') AND municipios.ID=elecciones_senado.IDMUNICIPIO) AS 'TOTAL'
					FROM  elecciones_senado 
					INNER JOIN municipios ON municipios.ID=elecciones_senado.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO=municipios.IDDEPARTAMENTO
					WHERE departamentos.IDDEPARTAMENTO=24
					GROUP BY municipios.ID
					ORDER BY 2 ";
				
					
			
	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		$sql="SELECT municipios.ID, municipios.NOMBRE as MUNICIPIO,
				(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='C21' AND municipios.ID=elecciones_senado.IDMUNICIPIO) AS 'C21',
				(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='U6' AND municipios.ID=elecciones_senado.IDMUNICIPIO) AS 'U6',
				(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='U24' AND municipios.ID=elecciones_senado.IDMUNICIPIO) AS 'U24',
				(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO IN ('U24','C21','U6') AND municipios.ID=elecciones_senado.IDMUNICIPIO) AS 'TOTAL'
				FROM  elecciones_senado 
				INNER JOIN municipios ON municipios.ID=elecciones_senado.IDMUNICIPIO
				INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO=municipios.IDDEPARTAMENTO
				WHERE departamentos.IDDEPARTAMENTO=24
				GROUP BY municipios.ID
				ORDER BY 2 ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['MUNICIPIO']=utf8_encode($partidos[$i]['MUNICIPIO']);
				$row[$i]['C21']=$partidos[$i]['C21'];
				$row[$i]['U6']=$partidos[$i]['U6'];
				$row[$i]['U24']=$partidos[$i]['U24'];
				$row[$i]['TOTAL']=$partidos[$i]['TOTAL'];
			}
			
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			}
			//print json_encode($jTableResult);
		}else{
			$sql="SELECT
					p.codigo as ID,
					p.nombre AS NOMBRE,
					p.municipio AS MUNICIPIO,
					p.departamento AS DEPARTAMENTO,
					p.mesas AS MESAS,
					(SELECT count(miembros_2010.codigo) as VOTOS
					FROM
					miembros_2010
					INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
					INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
					INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
					INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
					INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
					where usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.codigo=p.codigo) as VOTOS
					FROM
					puesto_2010 p
					where p.municipio='".$_GET["municipio"]."'";
				
					
			
	
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		$sql="SELECT
				p.codigo as ID,
				p.nombre AS NOMBRE,
				p.municipio AS MUNICIPIO,
				p.departamento AS DEPARTAMENTO,
				p.mesas AS MESAS,
				(SELECT
				count(miembros_2010.codigo) as VOTOS
				FROM
				miembros_2010
				INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
				INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
				INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.codigo=p.codigo) as VOTOSPREV,
				(SELECT
				SUM(mesas_2010.votoreal) AS VOTOSREALES
				FROM
				puesto_2010
				INNER JOIN mesas_2010 ON mesas_2010.puesto = puesto_2010.codigo
				where puesto_2010.municipio='".$_GET["municipio"]."' and puesto_2010.codigo=p.codigo
				GROUP BY puesto_2010.codigo
				) AS VOTOSREALES,
				(SELECT
SUM(mesas_2010.votoreal) AS VOTOSREALES
FROM
puesto_2010
INNER JOIN mesas_2010 ON mesas_2010.puesto = puesto_2010.codigo
where puesto_2010.municipio='".$_GET["municipio"]."' 
and puesto_2010.codigo=p.codigo
GROUP BY puesto_2010.codigo
)
-
	(SELECT
				count(miembros_2010.codigo) as VOTOS				
				FROM
				miembros_2010
				INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.miembro = miembros_2010.codigo
				INNER JOIN mesas_2010 ON mesas_2010.codigo = mesa_puesto_miembro_2010.mesas
				INNER JOIN puesto_2010 ON puesto_2010.codigo = mesas_2010.puesto
				where usuario_2010.usuario='edgarcarreno' and puesto_2010.codigo=p.codigo)  AS VARIACION
				FROM
				puesto_2010 p
				where p.municipio='".$_GET["municipio"]."' ";
			
			
			$sql.=" ORDER BY nombre ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['MUNICIPIO']=utf8_encode($partidos[$i]['MUNICIPIO']);
				$row[$i]['DEPARTAMENTO']=utf8_encode($partidos[$i]['DEPARTAMENTO']);
				$row[$i]['VOTOSPREV']=$partidos[$i]['VOTOSPREV'];
				$row[$i]['VOTOSREALES']=$partidos[$i]['VOTOSREALES'];
				$row[$i]['MESAS']=$partidos[$i]['MESAS'];
				$row[$i]['VARIACION']=$partidos[$i]['VARIACION'];
			}
					
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}
		print json_encode($jTableResult);		
	}	

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