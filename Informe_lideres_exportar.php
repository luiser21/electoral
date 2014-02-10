
<?php
session_start();
include_once "includes/GestionBD.new.class.php";
//imprimir($_SESSION['username']);exit;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=informe_lideres_".$_SESSION['username'].".xls");
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
</style><html>
<p>&nbsp;</p>
<blockquote>
  <p><span class="Estilo1">	CONSOLIDADO POR LIDERES</span></p>
  <p><?php echo $_SESSION['nombre']?><br/>
    Candidato al <?php echo $_SESSION['tipocandidato']?><br/>
    <?php echo ucwords(strtolower($_SESSION['municipio'])).' - '. ucwords(strtolower($_SESSION['departamento']))?><br/>
    <?php echo $_SESSION['partido']?><br/>
    Tarjeton # <?php echo $_SESSION['ntarjeton']?>  </p>
</blockquote>


		<br/>	<table width="100%" border="1">
					  <tr >
						<th width="27%" bgcolor="#408080" scope="row"><div align="center"><strong>LIDER NOMBRE</strong></div></th>
						<td width="5%" bgcolor="#408080"><div align="center"><strong>CEDULA</strong></div></td>
						<td colspan="4"><div align="center"></div>						  <div align="center"></div></td>
					  </tr>
			<?php foreach($partidos as $indice=>$valor){ ?>
			 <tr>
					<th scope="row" align="left"><?php echo $valor['NOMBRE']?></th>
					<td align="center"><?php echo $valor['CEDULA']?></td>
					<td colspan="4" bgcolor="#408080"><div align="left"><strong>SIMPATIZANTES</strong></div></td>
				  </tr>
			 <tr>
			   <th scope="row">&nbsp;</th>
			   <td>&nbsp;</td>
			   <td width="26%" bgcolor="#00CCFF"><div align="center"><strong>NOMBRES</strong></div></td>
			   <td width="8%" bgcolor="#00CCFF"><div align="center"><strong>CEDULA</strong></div></td>
	           <td width="27%" bgcolor="#00CCFF"><div align="center"><strong>NOMBRE_PUESTO</strong></div></td>
	           <td width="7%" bgcolor="#00CCFF"><div align="center"><strong>MESA</strong></div></td>
          </tr>
		  <?php 
		  $sql="SELECT
				miembros.ID,
				CONCAT(TRIM(miembros.NOMBRES),' ',TRIM(miembros.APELLIDOS)) AS NOMBRE,
				miembros.CEDULA,
				CONCAT(lideres.NOMBRES,' ',lideres.APELLIDOS) AS LIDER,
				mesas.MESA,
				puestos_votacion.NOMBRE_PUESTO
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.MIEMBRO = miembros.ID
				INNER JOIN mesas ON mesas.ID = mesa_puesto_miembro.IDMESA
				INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
				where usuario.usuario='".$_SESSION["username"]."' and lideres.ID='".$valor['ID']."'";			
			$sql.=" ORDER BY NOMBRE ";
			//$sql.=" LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . " ";
			
			$DBGestion->ConsultaArray($sql);				
			$miembros=$DBGestion->datos;
		  foreach($miembros as $indice=>$valor){ ?>
			 <tr>
			   <th scope="row">&nbsp;</th>
			   <td>&nbsp;</td>
			   <td align="left"><?php echo $valor['NOMBRE']?></td>
			   <td align="center"><?php echo $valor['CEDULA']?></td>
	           <td align="left"><?php echo $valor['NOMBRE_PUESTO']?></td>
	           <td align="center"><?php echo $valor['MESA']?></td>
          </tr><?php }?>
			<?php }?>
			</table>
</html>
		
				
			
	<?php	}else{
			
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