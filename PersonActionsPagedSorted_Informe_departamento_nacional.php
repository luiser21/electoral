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
			$sql="";
			
			
			$sql="SELECT departamentos.IDDEPARTAMENTO, departamentos.NOMBRE as DEPARTAMENTO,
					VOTOS,
					elecciones_senado.PARTICIPACION
					FROM  elecciones_senado 
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO=elecciones_senado.IDDEPARTAMENTO
					UNION
					SELECT 0 AS IDDEPARTAMENTO, 'TOTAL' as DEPARTAMENTO,
					'81.698'  AS VOTOS,
					'0.53%' AS PARTICIPACION
					FROM  elecciones_senado 
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO=elecciones_senado.IDDEPARTAMENTO
					WHERE elecciones_senado.IDMUNICIPIO=0
					GROUP BY elecciones_senado.IDMUNICIPIO
					 ";
				
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
		//	imprimir($partidos);
			$recordCount=count($partidos);
			
			//Get records from database
		
			$sql="SELECT departamentos.IDDEPARTAMENTO, departamentos.NOMBRE as DEPARTAMENTO,
						VOTOS,
						elecciones_senado.PARTICIPACION
						FROM  elecciones_senado 
						INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO=elecciones_senado.IDDEPARTAMENTO
						UNION
						SELECT 0 AS IDDEPARTAMENTO, 'TOTAL' as DEPARTAMENTO,
						'81.698'  AS VOTOS,
						'0.53%' AS PARTICIPACION
						FROM  elecciones_senado 
						INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO=elecciones_senado.IDDEPARTAMENTO
						WHERE elecciones_senado.IDMUNICIPIO=0
						GROUP BY elecciones_senado.IDMUNICIPIO
				 ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
			
			
			$row=array();		
			for($i=0; $i<count($partidos);$i++){
				$row[$i]['ID']=$partidos[$i]['IDDEPARTAMENTO'];
				$row[$i]['DEPARTAMENTO']=utf8_encode($partidos[$i]['DEPARTAMENTO']);
				//$row[$i]['MUNICIPIOS']=utf8_encode($partidos[$i]['MUNICIPIOS']);
				$row[$i]['VOTOS']=$partidos[$i]['VOTOS'];
				//$row[$i]['MESAS']=utf8_encode($partidos[$i]['MESAS']);
				$row[$i]['PARTICIPACION']=$partidos[$i]['PARTICIPACION'];
				
			}
			
			//Return result to jTable
			$jTableResult = array();
			$jTableResult['Result'] = "OK";
			$jTableResult['TotalRecordCount'] =$recordCount;
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