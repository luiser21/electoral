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
					p.IDPUESTO AS ID,
					p.NOMBRE_PUESTO AS NOMBRE,
					municipios.NOMBRE AS MUNICIPIO,
					departamentos.NOMBRE AS DEPARTAMENTO,
					p.MESAS AS MESAS,
					COUNT(miembros.id) as VOTOS
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					LEFT JOIN miembros ON miembros.IDPUESTOSVOTACION = p.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
					INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA				
					left JOIN lideres ON lideres.ID = miembros.IDLIDER
					left JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					LEFT JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."' " ;
				if($_SESSION["tipocandidato"]=="ALCALDIA"){
					$sql.=" and municipios.NOMBRE='".$_SESSION["municipio"]."' ";
				}
				if(isset($_POST["name"])!=""){
				$sql.=" and upper(p.NOMBRE_PUESTO) like upper('%".$_POST["name"]."%') ";
			}
					$sql.=" GROUP BY p.IDPUESTO 
					 HAVING COUNT(miembros.id)>=100
             ORDER BY VOTOS DESC
					";						
					
			
	//echo $sql;
	//exit;
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			//imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
			$sql="SELECT
					p.IDPUESTO AS ID,
					p.NOMBRE_PUESTO AS NOMBRE,
					municipios.NOMBRE AS MUNICIPIO,
					departamentos.NOMBRE AS DEPARTAMENTO,
					p.MESAS AS MESAS,
					count(miembros.ID) as VOTOSPREV,
					(SELECT
				SUM(mesas.votoreal) AS VOTOSREALES
				FROM
				puestos_votacion
				INNER JOIN mesas ON mesas.IDPUESTO = puestos_votacion.IDPUESTO
				where 
				puestos_votacion.IDPUESTO=p.IDPUESTO
				GROUP BY puestos_votacion.IDPUESTO
				) AS VOTOSREALES,
				'' AS VARIACION
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					LEFT JOIN miembros ON miembros.IDPUESTOSVOTACION = p.IDPUESTO
					left JOIN lideres ON lideres.ID = miembros.IDLIDER
					left JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					LEFT JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."' ";
				if($_SESSION["tipocandidato"]=="ALCALDIA"){
					$sql.=" and municipios.NOMBRE='".$_SESSION["municipio"]."' ";
				}
				if(isset($_POST["name"])!=""){
				$sql.=" and upper(p.NOMBRE_PUESTO) like upper('%".$_POST["name"]."%') ";
			}
					$sql.=" GROUP BY p.IDPUESTO 
							HAVING COUNT(miembros.id)>=60
							ORDER BY VOTOSPREV DESC
					";	
		$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
		//	imprimir($partidos);
			$row=array();
			$mesas=0;
			$votosprev=0;
			$votosreales=0;
			$variacion=0;
			
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['ID'];
				$row[$i]['NOMBRE']=utf8_encode($partidos[$i]['NOMBRE']);
				$row[$i]['MUNICIPIO']=utf8_encode($partidos[$i]['MUNICIPIO']);
				$row[$i]['DEPARTAMENTO']=utf8_encode($partidos[$i]['DEPARTAMENTO']);
				$row[$i]['VOTOSPREV']=$partidos[$i]['VOTOSPREV'];
				$row[$i]['VOTOSREALES']=$partidos[$i]['VOTOSREALES'];
				$row[$i]['MESAS']=$partidos[$i]['MESAS'];
				$row[$i]['VARIACION']=$partidos[$i]['VOTOSREALES']-$partidos[$i]['VOTOSPREV'];
				
				$mesas=$mesas+$partidos[$i]['MESAS'];
				$votosprev=$votosprev+$partidos[$i]['VOTOSPREV'];
				$votosreales=$votosreales+$partidos[$i]['VOTOSREALES'];
				$variacion=$variacion+$row[$i]['VARIACION'];
			}
			$i++;
			$row[$i]['ID']=0;
			$row[$i]['NOMBRE']='TOTAL PUESTOS: '.$recordCount;
			$row[$i]['MUNICIPIO']='';
			$row[$i]['DEPARTAMENTO']='TOTAL';
			$row[$i]['VOTOSPREV']=$votosprev;
			$row[$i]['VOTOSREALES']=$votosreales;
			$row[$i]['MESAS']=$mesas;
			$row[$i]['VARIACION']=$variacion;
				
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