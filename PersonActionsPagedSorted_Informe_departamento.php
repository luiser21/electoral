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
		if($_SESSION["username"]!='edgarcarreno'){	
			$sql="";
			if($_SESSION['tipocandidato']=='SENADO'){
				$sql="";
			
			$sql="SELECT IDDEPARTAMENTO,DEPARTAMENTO,COUNT(MUNICIPIOS) AS MUNICIPIOS, SUM(PUESTO) AS PUESTOS, SUM(VOTOS) AS VOTOS,SUM(VOTOSREALES) AS VOTOSREALES FROM (
					SELECT IDDEPARTAMENTO,DEPARTAMENTO,MUNICIPIOS,COUNT(PUESTO) AS PUESTO ,SUM(VOTOS) AS VOTOS,SUM(VOTOSREALES) AS VOTOSREALES  FROM (SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE as DEPARTAMENTO,
					municipios.NOMBRE as MUNICIPIOS,
					p.NOMBRE_PUESTO AS PUESTO,
					COUNT(mesa_puesto_miembro.MIEMBRO) AS VOTOS,
					SUM(mesas.VOTOREAL) AS VOTOSREALES
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					INNER JOIN mesas ON mesas.IDPUESTO = p.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID
					INNER JOIN miembros ON miembros.ID = mesa_puesto_miembro.MIEMBRO
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."'
					GROUP BY p.IDPUESTO
					ORDER BY p.NOMBRE_PUESTO,departamentos.NOMBRE, municipios.NOMBRE) DEPARTAMENTOS
					GROUP BY municipios)  CONSULTA
					 ";
				
					
			if(isset($_POST["name"])!=""){
				$sql.=" where upper(DEPARTAMENTO) like upper('%".$_POST["name"]."%') ";
			}
				$sql.=" GROUP BY DEPARTAMENTO
					ORDER BY DEPARTAMENTO ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		
			$sql="SELECT IDDEPARTAMENTO,DEPARTAMENTO,COUNT(MUNICIPIOS) AS MUNICIPIOS, SUM(PUESTO) AS PUESTOS, SUM(VOTOS) AS VOTOS,SUM(VOTOSREALES) AS VOTOSREALES,COUNT(MESAS) AS MESAS  FROM (
					SELECT IDDEPARTAMENTO,DEPARTAMENTO,MUNICIPIOS,COUNT(PUESTO) AS PUESTO ,SUM(VOTOS) AS VOTOS,SUM(VOTOSREALES) AS VOTOSREALES,COUNT(MESAS) AS MESAS   FROM (SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE as DEPARTAMENTO,
					municipios.NOMBRE as MUNICIPIOS,
					p.NOMBRE_PUESTO AS PUESTO,
					COUNT(mesa_puesto_miembro.MIEMBRO) AS VOTOS,
					SUM(mesas.VOTOREAL) AS VOTOSREALES,
					COUNT(MESAS) AS MESAS 
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					INNER JOIN mesas ON mesas.IDPUESTO = p.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID
					INNER JOIN miembros ON miembros.ID = mesa_puesto_miembro.MIEMBRO
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."'
					GROUP BY p.IDPUESTO
					ORDER BY p.NOMBRE_PUESTO,departamentos.NOMBRE, municipios.NOMBRE) DEPARTAMENTOS
					GROUP BY municipios)  CONSULTA ";
			
			if(isset($_POST["name"])!=""){
				$sql.=" where upper(DEPARTAMENTO) like upper('%".$_POST["name"]."%') ";
			}
				$sql.=" GROUP BY DEPARTAMENTO
					ORDER BY DEPARTAMENTO ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['IDDEPARTAMENTO'];
				$row[$i]['DEPARTAMENTO']=utf8_encode($partidos[$i]['DEPARTAMENTO']);
				$row[$i]['MUNICIPIOS']=utf8_encode($partidos[$i]['MUNICIPIOS']);
				$row[$i]['PUESTOS']=utf8_encode($partidos[$i]['PUESTOS']);
				$row[$i]['MESAS']=utf8_encode($partidos[$i]['MESAS']);
				$row[$i]['VOTOS']=$partidos[$i]['VOTOS'];
				$row[$i]['VOTOSREALES']=$partidos[$i]['VOTOSREALES'];
				$row[$i]['VARIACION']=$partidos[$i]['VOTOSREALES']-$partidos[$i]['VOTOS'];
			}
				
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
			}
		}else{
			//imprimir($_POST);
			$sql="SELECT
					p.municipio AS MUNICIPIO,
					p.departamento AS DEPARTAMENTO,
					count(p.nombre) as PUESTOS,
					SUM(p.mesas) MESAS,
					(SELECT
					count(miembros_2010.nombre) as miembros
					FROM
					puesto_2010
					INNER JOIN mesas_2010 ON mesas_2010.puesto = puesto_2010.codigo
					INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.mesas = mesas_2010.codigo
					INNER JOIN miembros_2010 ON miembros_2010.codigo = mesa_puesto_miembro_2010.miembro
					INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
					INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
					WHERE usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.municipio=p.municipio
					GROUP BY puesto_2010.municipio) AS MIEMBROS
					FROM
					puesto_2010 p
					where 1=1
					and p.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')		
					";
				
					
			if(isset($_POST["name"])){
				if($_POST["name"]!='' && $_POST["name"]!=null){
					$sql.=" and upper(p.municipio) like upper('%".$_POST["name"]."%') ";
				}
			}
			$sql.=" GROUP BY p.municipio ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			//imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		$sql="SELECT
					p.municipio AS MUNICIPIO,
					p.departamento AS DEPARTAMENTO,
					count(p.nombre) as PUESTOS,
					SUM(p.mesas) MESAS,
					(SELECT
					count(miembros_2010.nombre) as miembros
					FROM
					puesto_2010
					INNER JOIN mesas_2010 ON mesas_2010.puesto = puesto_2010.codigo
					INNER JOIN mesa_puesto_miembro_2010 ON mesa_puesto_miembro_2010.mesas = mesas_2010.codigo
					INNER JOIN miembros_2010 ON miembros_2010.codigo = mesa_puesto_miembro_2010.miembro
					INNER JOIN lider_2010 ON lider_2010.codigo = miembros_2010.lider
					INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider_2010.candidato
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
					WHERE usuario_2010.usuario='".$_SESSION["username"]."' and puesto_2010.municipio=p.municipio
					GROUP BY puesto_2010.municipio) AS MIEMBROS
					FROM
					puesto_2010 p
					where 1=1 
					and p.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 
					INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')		
					";
			
			if(isset($_POST["name"])){
				if($_POST["name"]!='' && $_POST["name"]!=null){
					$sql.=" and upper(p.municipio) like upper('%".$_POST["name"]."%') ";
				}
			}
			$sql.=" GROUP BY p.municipio ORDER BY p.municipio ";
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$i+1;
				$row[$i]['MUNICIPIO']=utf8_encode($partidos[$i]['MUNICIPIO']);
				$row[$i]['DEPARTAMENTO']=utf8_encode($partidos[$i]['DEPARTAMENTO']);
				$row[$i]['PUESTOS']=$partidos[$i]['PUESTOS'];
				$row[$i]['MESAS']=$partidos[$i]['MESAS'];
				$row[$i]['MIEMBROS']=$partidos[$i]['MIEMBROS'];
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
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$result = mysql_query("INSERT INTO people(Name, Age, RecordDate) VALUES('" . $_POST["Name"] . "', " . $_POST["Age"] . ",now());");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM people WHERE PersonId = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
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