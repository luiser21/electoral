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
					
			$sql="SELECT '1 - 7' AS RANGO, SUM(VOTOSPREVISTOS) AS VOTOSPREVISTOS,  COUNT(CODIGO) AS MESAS,  COUNT(DISTINCT IDPUESTO) AS PUESTOS,
COUNT(DISTINCT MUNICIPIO) AS MUNICIPIOS,COUNT(DISTINCT DEPARTAMENTO) AS DEPARTAMENTOS FROM (
SELECT
				m.ID as CODIGO,
				(SELECT
					count(1) as VOTOS
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.USUARIO= '".$_SESSION["username"]."'   and mesas.ID=m.ID) as VOTOSPREVISTOS,
          puestos_votacion.IDPUESTO,
          mun.ID AS MUNICIPIO,
          dep.IDDEPARTAMENTO AS DEPARTAMENTO
				FROM
				mesas m
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = m.IDPUESTO
        INNER JOIN municipios mun ON mun.ID=puestos_votacion.IDMUNICIPIO
        INNER JOIN departamentos dep on dep.IDDEPARTAMENTO=mun.IDDEPARTAMENTO
        HAVING VOTOSPREVISTOS BETWEEN  1 AND 7 )  TABLA
UNION
			SELECT '8 - 30' AS RANGO, SUM(VOTOSPREVISTOS) AS VOTOSPREVISTOS,  COUNT(CODIGO) AS MESAS,  COUNT(DISTINCT IDPUESTO) AS PUESTOS,
COUNT(DISTINCT MUNICIPIO) AS MUNICIPIOS,COUNT(DISTINCT DEPARTAMENTO) AS DEPARTAMENTOS FROM (
SELECT
				m.ID as CODIGO,
				(SELECT
					count(1) as VOTOS
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.USUARIO= '".$_SESSION["username"]."'   and mesas.ID=m.ID) as VOTOSPREVISTOS,
          puestos_votacion.IDPUESTO,
          mun.ID AS MUNICIPIO,
          dep.IDDEPARTAMENTO AS DEPARTAMENTO
				FROM
				mesas m
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = m.IDPUESTO
        INNER JOIN municipios mun ON mun.ID=puestos_votacion.IDMUNICIPIO
        INNER JOIN departamentos dep on dep.IDDEPARTAMENTO=mun.IDDEPARTAMENTO
        HAVING VOTOSPREVISTOS BETWEEN  8 AND 30 )  TABLA
UNION
SELECT '31 - 50' AS RANGO, SUM(VOTOSPREVISTOS) AS VOTOSPREVISTOS,  COUNT(CODIGO) AS MESAS,  COUNT(DISTINCT IDPUESTO) AS PUESTOS,
COUNT(DISTINCT MUNICIPIO) AS MUNICIPIOS,COUNT(DISTINCT DEPARTAMENTO) AS DEPARTAMENTOS FROM (
SELECT
				m.ID as CODIGO,
				(SELECT
					count(1) as VOTOS
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.USUARIO= '".$_SESSION["username"]."'   and mesas.ID=m.ID) as VOTOSPREVISTOS,
          puestos_votacion.IDPUESTO,
          mun.ID AS MUNICIPIO,
          dep.IDDEPARTAMENTO AS DEPARTAMENTO
				FROM
				mesas m
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = m.IDPUESTO
        INNER JOIN municipios mun ON mun.ID=puestos_votacion.IDMUNICIPIO
        INNER JOIN departamentos dep on dep.IDDEPARTAMENTO=mun.IDDEPARTAMENTO
        HAVING VOTOSPREVISTOS BETWEEN  31 AND 50 )  TABLA 
UNION
	SELECT ' >= 51' AS RANGO, SUM(VOTOSPREVISTOS) AS VOTOSPREVISTOS,  COUNT(CODIGO) AS MESAS,  COUNT(DISTINCT IDPUESTO) AS PUESTOS,
	COUNT(DISTINCT MUNICIPIO) AS MUNICIPIOS,COUNT(DISTINCT DEPARTAMENTO) AS DEPARTAMENTOS FROM (
	SELECT
					m.ID as CODIGO,
					(SELECT
						count(1) as VOTOS
						FROM
						miembros
						INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
						INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
						INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
						INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
						INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
						INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
						where usuario.USUARIO= '".$_SESSION["username"]."'   and mesas.ID=m.ID) as VOTOSPREVISTOS,
			  puestos_votacion.IDPUESTO,
			  mun.ID AS MUNICIPIO,
			  dep.IDDEPARTAMENTO AS DEPARTAMENTO
					FROM
					mesas m
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = m.IDPUESTO
			INNER JOIN municipios mun ON mun.ID=puestos_votacion.IDMUNICIPIO
			INNER JOIN departamentos dep on dep.IDDEPARTAMENTO=mun.IDDEPARTAMENTO
			HAVING VOTOSPREVISTOS >=51 )  TABLA 
UNION
	SELECT 'TOTAL' AS RANGO, SUM(VOTOSPREVISTOS) AS VOTOSPREVISTOS,  COUNT(CODIGO) AS MESAS,  COUNT(DISTINCT IDPUESTO) AS PUESTOS,
	COUNT(DISTINCT MUNICIPIO) AS MUNICIPIOS,COUNT(DISTINCT DEPARTAMENTO) AS DEPARTAMENTOS FROM (
		SELECT
				m.ID as CODIGO,
				(SELECT
					count(1) as VOTOS
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
					INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
					where usuario.USUARIO= '".$_SESSION["username"]."'    and mesas.ID=m.ID) as VOTOSPREVISTOS,
          puestos_votacion.IDPUESTO,
          mun.ID AS MUNICIPIO,
          dep.IDDEPARTAMENTO AS DEPARTAMENTO
				FROM
				mesas m
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = m.IDPUESTO
        INNER JOIN municipios mun ON mun.ID=puestos_votacion.IDMUNICIPIO
        INNER JOIN departamentos dep on dep.IDDEPARTAMENTO=mun.IDDEPARTAMENTO
        HAVING VOTOSPREVISTOS >=1 )  TABLA 
       " ;
				
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			$recordCount=count($partidos);
			
			//imprimir($partidos);
			$row=array();
			$mesas=0;
			$votosprev=0;
			$votosreales=0;
			$variacion=0;
			$puestos=0;
			
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$i;
				$row[$i]['RANGO']=$partidos[$i]['RANGO'];
				$row[$i]['VOTOSPREVISTOS']=$partidos[$i]['VOTOSPREVISTOS'];
				$row[$i]['MESAS']=$partidos[$i]['MESAS'];
				$row[$i]['PUESTOS']=$partidos[$i]['PUESTOS'];
				$row[$i]['MUNICIPIOS']=$partidos[$i]['MUNICIPIOS'];
				$row[$i]['DEPARTAMENTOS']=$partidos[$i]['DEPARTAMENTOS'];
				
			}
		
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =5;
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
					
			$sql="SELECT ID, ZONA, MOVILIZADOS from boletines_departamentos where candidato=".$_SESSION["idcandidato"]." GROUP BY MOVILIZADOS ORDER BY MOVILIZADOS DESC " ;
								
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	

			$recordCount=count($partidos);
			
			//Get records from database
			$sql="SELECT ID, ZONA, MOVILIZADOS from boletines_departamentos where candidato=".$_SESSION["idcandidato"]." GROUP BY MOVILIZADOS ORDER BY MOVILIZADOS DESC " ;
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";

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