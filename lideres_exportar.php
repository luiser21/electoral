
<?php
session_start();
include_once "includes/GestionBD.new.class.php";
//imprimir($_SESSION['username']);exit;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=lideres_".$_SESSION['username'].".xls");
header("Pragma: no-cache");
header("Expires: 0");

try
{
	//Open database connection
	$DBGestion = new GestionBD('AGENDAMIENTO');

	if($_GET["action"] == "exportar")
	{
		//Get record count
		if($_SESSION["username"]!='edgarcarreno'){	
		
			
		$sql="SELECT
				lideres.ID,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS NOMBRE,
				lideres.CEDULA,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO,
				(SELECT count(*) AS miembros FROM miembros m WHERE lideres.ID  = m.IDLIDER) as MIEMBROS 
				FROM
				lideres
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.LIDER = lideres.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA AND mesas.IDPUESTO = lideres.IDPUESTOSVOTACION
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
			  where usuario.usuario='".$_SESSION["username"]."'  ";	
			
			$sql.=" ORDER BY NOMBRE ";
			
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;
					//echo $sql;
			$row=array();
			
?>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #006600;
	font-size: 18px;
}
-->
</style>
<p>&nbsp;</p>
<blockquote>
  <p><span class="Estilo1">	CONSOLIDADO POR LIDERES</span></p>
  <p><?php echo $_SESSION['nombre']?><br/>
    Candidato al <?php echo $_SESSION['tipocandidato']?><br/>
    <?php echo ucwords(strtolower($_SESSION['municipio'])).' - '. ucwords(strtolower($_SESSION['departamento']))?><br/>
    <?php echo $_SESSION['partido']?><br/>
    Tarjeton # <?php echo $_SESSION['ntarjeton']?>  </p>
</blockquote>
<?PHP

		$tabla='<br/>	<table width="100%" border="1">
					  <tr bgcolor="#408080">
						<th scope="row"><div align="center"><strong>NOMBRE</strong></div></th>
						<td><div align="center"><strong>CEDULA</strong></div></td>
						<td><div align="center"><strong>NOMBRE_PUESTO</strong></div></td>
						<td><div align="center"><strong>MESA</strong></div></td>
					  </tr>';
			foreach($partidos as $indice=>$valor){
				  $tabla .= ' <tr>
					<th scope="row">'.$valor['NOMBRE'].'</th>
					<td>'.$valor['CEDULA'].'</td>
					<td>'.$valor['NOMBRE_PUESTO'].'</td>
					<td>'.$valor['MESA'].'</td>
				  </tr>';
			}
			$tabla .= "</table></html>";
			echo $tabla;
				
			
		}else{
			
		$sql="SELECT
				miembros.codigo AS ID,
				CONCAT(TRIM(miembros.nombre),' ',TRIM(miembros.apellido)) AS NOMBRE,
				miembros.identificacion AS CEDULA,
				CONCAT(lider.nombre,' ',lider.apellido) AS LIDER,
				mesas.mesas AS MESA,
				puesto.nombre AS NOMBRE_PUESTO,
				puesto.municipio as MUNICIPIO,
				puesto.departamento AS DEPARTAMENTO
				FROM
				miembros_2010 miembros
				INNER JOIN lider_2010 lider ON lider.codigo = miembros.lider
				INNER JOIN mesa_puesto_miembro_2010 mesa_puesto_miembro ON mesa_puesto_miembro.miembro = miembros.codigo
				INNER JOIN mesas_2010 mesas ON mesas.codigo = mesa_puesto_miembro.mesas
				INNER JOIN puesto_2010 puesto ON puesto.codigo = mesas.puesto
				INNER JOIN candidato_2010 ON candidato_2010.cc_ope = lider.candidato
				INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope
				where usuario_2010.usuario='".$_SESSION["username"]."' and puesto.municipio=(SELECT candidato_2010.municipio FROM candidato_2010 INNER JOIN usuario_2010 ON usuario_2010.cc_ope = candidato_2010.cc_ope where usuario_2010.usuario='".$_SESSION["username"]."')";
			
			
			$sql.=" ORDER BY NOMBRE ";
			
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
				$row[$i]['MUNICIPIO']=$partidos[$i]['MUNICIPIO'];
				$row[$i]['DEPARTAMENTO']=$partidos[$i]['DEPARTAMENTO'];
			}
		}	
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