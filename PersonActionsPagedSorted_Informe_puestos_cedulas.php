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
					
			$sql="SELECT
					recoleccion_cedulas.IDPUESTO,
					puestos_votacion.NOMBRE_PUESTO,
					(Select count(r.cedulas) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO) as CEDULAS,
					(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO AND R.TIPOELECCION1=3) as ALCALDIA,
					(Select count(r.TIPOELECCION2) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO AND R.TIPOELECCION2=4) as CONCEJO,
					(Select count(r.cedulas) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO and   R.TIPOELECCION1=0 and R.TIPOELECCION2=0) as SINFIRMAS	
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."'
					GROUP BY recoleccion_cedulas.IDPUESTO		";						
					
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
			$sql="SELECT
					recoleccion_cedulas.IDPUESTO AS ID,
					puestos_votacion.NOMBRE_PUESTO,
					(Select count(r.cedulas) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO) as CEDULAS,
					(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO AND R.TIPOELECCION1=3) as ALCALDIA,
					(Select count(r.TIPOELECCION2) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO AND R.TIPOELECCION2=4) as CONCEJO,
					(Select count(r.cedulas) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO and   R.TIPOELECCION1=0 and R.TIPOELECCION2=0) as SINFIRMAS	
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."'
					GROUP BY recoleccion_cedulas.IDPUESTO	";	
			
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE_PUESTO']);
				$row[$i]['CEDULAS']=utf8_encode($partidos[$i]['CEDULAS']);
				$row[$i]['ALCALDIA']=utf8_encode($partidos[$i]['ALCALDIA']);
				$row[$i]['CONCEJO']=$partidos[$i]['CONCEJO'];
				$row[$i]['SINFIRMAS']=$partidos[$i]['SINFIRMAS'];
			}
				
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
		$_SESSION['graficos'] = $jTableResult;
		print json_encode($jTableResult);		
	}
	
	if($_GET["action"] == "list2")
	{
		//Get record count
		if($_SESSION["username"]!='alcaldia'){	
					
			$sql="SELECT
					recoleccion_cedulas.IDPUESTO,
					puestos_votacion.NOMBRE_PUESTO,
					(Select count(r.cedulas) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO) as CEDULAS,
					(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO AND R.TIPOELECCION1=3) as ALCALDIA,
					(Select count(r.TIPOELECCION2) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO AND R.TIPOELECCION2=4) as CONCEJO,
					(Select count(r.cedulas) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO and   R.TIPOELECCION1=0 and R.TIPOELECCION2=0) as SINFIRMAS	
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."'
					GROUP BY recoleccion_cedulas.IDPUESTO		";						
					
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
			$sql="SELECT
					recoleccion_cedulas.IDPUESTO AS ID,
					puestos_votacion.NOMBRE_PUESTO,
					(Select count(r.cedulas) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO) as CEDULAS,
					(Select count(r.TIPOELECCION1) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO AND R.TIPOELECCION1=3) as ALCALDIA,
					(Select count(r.TIPOELECCION2) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO AND R.TIPOELECCION2=4) as CONCEJO,
					(Select count(r.cedulas) from recoleccion_cedulas r where r.IDPUESTO=recoleccion_cedulas.IDPUESTO and   R.TIPOELECCION1=0 and R.TIPOELECCION2=0) as SINFIRMAS	
					FROM
					puestos_votacion
					INNER JOIN recoleccion_cedulas ON recoleccion_cedulas.IDPUESTO = puestos_votacion.IDPUESTO
					INNER JOIN candidato ON candidato.ID = recoleccion_cedulas.CANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					where usuario.USUARIO='".$_SESSION["username"]."'
					GROUP BY recoleccion_cedulas.IDPUESTO	";	
			
			$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			//echo $sql;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			$row=array();
		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE_PUESTO']);
				$row[$i]['CEDULAS']=utf8_encode($partidos[$i]['CEDULAS']);				
				$row[$i]['ALCALDIA']=utf8_encode($partidos[$i]['ALCALDIA']);
				$row[$i]['CONCEJO']=$partidos[$i]['CONCEJO'];
				$row[$i]['SINFIRMAS']=$partidos[$i]['SINFIRMAS'];
			}
				
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
			$jTableResult['Records'] = $row;
			//print json_encode($jTableResult);
		}
		$_SESSION['graficos'] = $jTableResult;
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