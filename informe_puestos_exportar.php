
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
					p.IDPUESTO AS ID,
					p.NOMBRE_PUESTO AS NOMBRE,
					municipios.NOMBRE AS MUNICIPIO,
					departamentos.NOMBRE AS DEPARTAMENTO,
					p.MESAS AS MESAS,
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
					where usuario.USUARIO='".$_SESSION["username"]."' AND puestos_votacion.IDPUESTO=p.IDPUESTO) as VOTOSPREV,
					(SELECT
				SUM(mesas.votoreal) AS VOTOSREALES
				FROM
				puestos_votacion
				INNER JOIN mesas ON mesas.IDPUESTO = puestos_votacion.IDPUESTO
				where puestos_votacion.IDMUNICIPIO=(SELECT candidato.municipio FROM candidato INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO where usuario.usuario='".$_SESSION["username"]."') and puestos_votacion.IDPUESTO=p.IDPUESTO
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
					WHERE usuario.USUARIO='".$_SESSION["username"]."' and p.IDMUNICIPIO=(SELECT candidato.municipio FROM candidato INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO where usuario.usuario='".$_SESSION["username"]."')
					";			
			
			$sql.=" ORDER BY NOMBRE ";
			
			$DBGestion->ConsultaArray($sql);				
			$puestos=$DBGestion->datos;
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
  <p><span class="Estilo1">	CONSOLIDADO POR PUESTO DE VOTACI&Oacute;N</span></p>
  <p><?php echo $_SESSION['nombre']?><br/>
    Candidato al <?php echo $_SESSION['tipocandidato']?><br/>
    <?php echo ucwords(strtolower($_SESSION['municipio'])).' - '. ucwords(strtolower($_SESSION['departamento']))?><br/>
    <?php echo $_SESSION['partido']?><br/>
    Tarjeton # <?php echo $_SESSION['ntarjeton']?>  </p>
</blockquote>


		<br/>	<table width="100%" border="1">
					
			 <tr>
			 
			   <td width="26%" bgcolor="#009999"><div align="center"><strong>PUESTO DE VOTACION</strong></div></td>
			   <td width="8%" bgcolor="#009999"><div align="center"><strong>MUNICIPIO</strong></div></td>
	           <td width="27%" bgcolor="#009999"><div align="center"><strong>DEPARTAMENTO</strong></div></td>
	           <td width="7%" bgcolor="#009999"><div align="center"><strong>MESAS</strong></div></td>
			    <td width="7%" bgcolor="#009999"><div align="center"><strong>VOTO_PRE</strong></div></td>
				 <td width="7%" bgcolor="#009999"><div align="center"><strong>VOTO_REAL</strong></div></td>
				  <td width="7%" bgcolor="#009999"><div align="center"><strong>VARIACION</strong></div></td>
          </tr>
		  <?php 
		
		  foreach($puestos as $indice=>$valor){ ?>
			 <tr>
			   <td align="left"><?php echo $valor['NOMBRE']?></td>
			   <td align="center"><?php echo $valor['MUNICIPIO']?></td>
	           <td align="left"><?php echo $valor['DEPARTAMENTO']?></td>
	           <td align="center"><?php echo $valor['MESAS']?></td>
			    <td align="center"><?php echo $valor['VOTOSPREV']?></td>
				 <td align="center"><?php echo $valor['VOTOSREALES']?></td>
				 	 <td align="center"><?php echo $valor['VOTOSREALES']-$valor['VOTOSPREV']?></td>
          </tr><?php }?>
		
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