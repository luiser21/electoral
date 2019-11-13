<?php
session_start();
include_once "includes/GestionBD.new.class.php";
try
{

	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');
/*$_GET["action"] = "list";
$_GET["jtPageSize"]=	2;
$_GET["jtStartIndex"]=0;*/
	//Getting records (listAction)

	if($_GET["action"] == "list")
	{
		//Get record count
		if($_SESSION["username"]!='alcaldia'){	
					
			$sql="SELECT CANDIDATO,MESA1,MESA2,MESA3,MESA4,TOTALMESAS FROM (

SELECT 
'1-MIGUEL ANGEL VARGAS HERNANDEZ' AS CANDIDATO,
(SELECT 
votoscandidato1 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato1 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato1 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato1 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato1) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'2-HNO. ARIOSTO ARDILA SILVA' AS CANDIDATO,
(SELECT 
votoscandidato2 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato2 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato2 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato2 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato2) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'3-JAVIER FUENTES CORTES' AS CANDIDATO,
(SELECT 
votoscandidato3 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato3 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato3 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato3 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato3) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'4-LUIS GERARDO MARTINEZ MORENO' AS CANDIDATO,
(SELECT 
votoscandidato4 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato4 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato4 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato4 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato4) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'5-JAIRO ERNESTO MORENO LOPEZ' AS CANDIDATO,
(SELECT 
votoscandidato5 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato5 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato5 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato5 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato5) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'6-ALVARO SOTELO SOTELO' AS CANDIDATO,
(SELECT 
votoscandidato6 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato6 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato6 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato6 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato6) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'7-ORLANDO TARAZONA VILLAMIZAR' AS CANDIDATO,
(SELECT 
votoscandidato7 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato7 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato7 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato7 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato7) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'8-ALFONSO PULIDO LEON' AS CANDIDATO,
(SELECT 
votoscandidato8 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato8 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato8 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato8 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato8) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'VOTOS EN BLANCO' AS CANDIDATO,
(SELECT 
VOTOS_BLANCO as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
VOTOS_BLANCO as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
VOTOS_BLANCO as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
VOTOS_BLANCO as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(VOTOS_BLANCO) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'VOTOS NO MARCADOS' AS CANDIDATO,
(SELECT 
VOTOS_NO_MARCADOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
VOTOS_NO_MARCADOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
VOTOS_NO_MARCADOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
VOTOS_NO_MARCADOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(VOTOS_NO_MARCADOS) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'VOTOS NULOS' AS CANDIDATO,
(SELECT 
VOTOS_NULOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
VOTOS_NULOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
VOTOS_NULOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
VOTOS_NULOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(VOTOS_NULOS) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
) ESCRUTINIO" ;
				
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			//imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
			$sql="SELECT CANDIDATO,MESA1,MESA2,MESA3,MESA4,TOTALMESAS FROM (

SELECT 
'1-MIGUEL ANGEL VARGAS HERNANDEZ' AS CANDIDATO,
(SELECT 
votoscandidato1 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato1 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato1 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato1 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato1) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'2-HNO. ARIOSTO ARDILA SILVA' AS CANDIDATO,
(SELECT 
votoscandidato2 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato2 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato2 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato2 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato2) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'3-JAVIER FUENTES CORTES' AS CANDIDATO,
(SELECT 
votoscandidato3 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato3 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato3 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato3 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato3) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'4-LUIS GERARDO MARTINEZ MORENO' AS CANDIDATO,
(SELECT 
votoscandidato4 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato4 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato4 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato4 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato4) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'5-JAIRO ERNESTO MORENO LOPEZ' AS CANDIDATO,
(SELECT 
votoscandidato5 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato5 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato5 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato5 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato5) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'6-ALVARO SOTELO SOTELO' AS CANDIDATO,
(SELECT 
votoscandidato6 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato6 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato6 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato6 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato6) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'7-ORLANDO TARAZONA VILLAMIZAR' AS CANDIDATO,
(SELECT 
votoscandidato7 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato7 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato7 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato7 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato7) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'8-ALFONSO PULIDO LEON' AS CANDIDATO,
(SELECT 
votoscandidato8 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
votoscandidato8 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
votoscandidato8 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
votoscandidato8 as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(votoscandidato8) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'VOTOS EN BLANCO' AS CANDIDATO,
(SELECT 
VOTOS_BLANCO as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
VOTOS_BLANCO as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
VOTOS_BLANCO as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
VOTOS_BLANCO as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(VOTOS_BLANCO) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'VOTOS NO MARCADOS' AS CANDIDATO,
(SELECT 
VOTOS_NO_MARCADOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
VOTOS_NO_MARCADOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
VOTOS_NO_MARCADOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
VOTOS_NO_MARCADOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(VOTOS_NO_MARCADOS) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
UNION
SELECT 
'VOTOS NULOS' AS CANDIDATO,
(SELECT 
VOTOS_NULOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=1) AS MESA1,
(SELECT 
VOTOS_NULOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=2) AS MESA2,
(SELECT 
VOTOS_NULOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=3) AS MESA3,
(SELECT 
VOTOS_NULOS as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116 and mesa=4) AS MESA4,
(SELECT 
SUM(VOTOS_NULOS) as MESA1
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116) AS TOTALMESAS
FROM DUAL
) ESCRUTINIO";
				
		$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
		//	imprimir($partidos);
			$row=array();
			$mesas=0;
			$votosprev=0;
			$votosreales=0;
			$variacion=0;
			$total_mesas=0;
			$y=1;
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$y;
				$row[$i]['CANDIDATO']=$partidos[$i]['CANDIDATO'];
				$row[$i]['MESA1']=$partidos[$i]['MESA1'];
				$row[$i]['MESA2']=$partidos[$i]['MESA2'];
				$row[$i]['MESA3']=$partidos[$i]['MESA3'];
				$row[$i]['MESA4']=$partidos[$i]['MESA4'];
				$row[$i]['TOTALMESAS']=$partidos[$i]['TOTALMESAS'];
			
				$mesas=$mesas+$partidos[$i]['MESA1'];
				$votosprev=$votosprev+$partidos[$i]['MESA2'];
				$votosreales=$votosreales+$partidos[$i]['MESA3'];
				$variacion=$variacion+$row[$i]['MESA4'];
				$total_mesas=$total_mesas+$row[$i]['TOTALMESAS'];
				$y++;
			}
			$i++;
			$row[$i]['ID']=0;
			$row[$i]['CANDIDATO']='        TOTAL VOTOS VALIDOS: ';
			$row[$i]['MESA1']=$mesas;
			$row[$i]['MESA2']=$votosprev;
			$row[$i]['MESA3']=$votosreales;
			$row[$i]['MESA4']=$variacion;
			$row[$i]['TOTALMESAS']=$total_mesas;
				
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
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
					where p.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')";
				
					
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(p.nombre) like upper('%".$_POST["name"]."%') ";
			}
	
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
				where puesto_2010.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."') and puesto_2010.codigo=p.codigo
				GROUP BY puesto_2010.codigo
				) AS VOTOSREALES				
				FROM
				puesto_2010 p
				where p.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."') ";
			
			if(isset($_POST["name"])!=""){
				$sql.=" and upper(p.nombre) like upper('%".$_POST["name"]."%') ";
			}
			$sql.=" ORDER BY VOTOSPREV desc ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['MUNICIPIO']='LA PROSPERIDAD';
				$row[$i]['DEPARTAMENTO']='EL BIENESTAR';
				$row[$i]['VOTOSPREV']=$partidos[$i]['VOTOSPREV'];
				$row[$i]['VOTOSREALES']=$partidos[$i]['VOTOSREALES'];
				$row[$i]['MESAS']=$partidos[$i]['MESAS'];
				$row[$i]['VARIACION']=$partidos[$i]['VOTOSREALES']-$partidos[$i]['VOTOSPREV'];
			}
					
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] = $recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}
		//imprimir($jTableResult);
		$_SESSION['graficos'] = $jTableResult;
		print json_encode($jTableResult);		
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "puestos")
	{
		if($_SESSION["username"]=='alcaldia'){	
		//Insert record into database
			$sql="SELECT
					p.codigo as ID,
					p.nombre AS NOMBRE,
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
					where p.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope 
where usuario_2010.usuario='".$_SESSION["username"]."')
ORDER BY votos desc
	";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		$sql="SELECT	
					p.codigo as ID,
					p.nombre AS NOMBRE,
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
					where p.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope 
where usuario_2010.usuario='".$_SESSION["username"]."')
ORDER BY votos desc ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);				
				$row[$i]['VOTOSPREV']=$partidos[$i]['VOTOS'];
				
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
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE people SET Name = '" . $_POST["Name"] . "', Age = " . $_POST["Age"] . " WHERE PersonId = " . $_POST["PersonId"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM people WHERE PersonId = " . $_POST["PersonId"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}else if($_GET["action"] == "list2"){
		//Get record count
		if($_SESSION["username"]!='alcaldia'){	
					
			$sql="SELECT ID, CASE
						WHEN IDPUESTO=13054 THEN 'MARIBEL'
						WHEN IDPUESTO=13055 THEN 'MARIO IVAN'
							WHEN IDPUESTO=13056 THEN 'MARIA FERNANDA'
						ELSE 'NO HAY LIDER'

					END AS ZONA, SUM(MOVILIZADOS) AS MOVILIZADOS
					from boletines_departamentos where candidato=".$_SESSION["idcandidato"]."
					GROUP BY IDPUESTO ORDER BY MOVILIZADOS DESC " ;
								
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	

			$recordCount=count($partidos);
			
			//Get records from database
			$sql="SELECT ID, CASE
						WHEN IDPUESTO=13054 THEN 'MARIBEL'
						WHEN IDPUESTO=13055 THEN 'MARIO IVAN'
							WHEN IDPUESTO=13056 THEN 'MARIA FERNANDA'
						ELSE 'NO HAY LIDER'

					END AS ZONA,SUM(MOVILIZADOS) AS MOVILIZADOS
					from boletines_departamentos where candidato=".$_SESSION["idcandidato"]."
					GROUP BY IDPUESTO ORDER BY MOVILIZADOS DESC " ;
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";

			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
		
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['ZONA']=$partidos[$i]['ZONA'];
				$row[$i]['MOVILIZADOS']=$partidos[$i]['MOVILIZADOS'];	
				$row[$i]['PARTICIPACION']= number_format(($partidos[$i]['MOVILIZADOS']/$_SESSION['votosprevistos'])*100, 2, ',', ',').'%';					
			}
				
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			print json_encode($jTableResult);
		}
		//print json_encode($jTableResult);	
	}	

	//Close database connection
	//mysql_close($con);

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