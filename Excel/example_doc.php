<?php
//require_once('topadmin.php');
require_once 'Excel/reader.php';
session_start();
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();
include_once "../includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	
// Set output Encoding.
@$data->setOutputEncoding('CP1251');
@$data->read('Lista del Senado.xls');
error_reporting(E_ALL ^ E_NOTICE);  
$y=0;
$registros=count($data->sheets[0]['cells']);
for ($i = 2; $i <= $registros; $i++) {
	$cedula[$y]=trim($data->sheets[0]['cells'][$i][1]);
	$nombre[$y]=$data->sheets[0]['cells'][$i][2];
	$apellido[$y]=$data->sheets[0]['cells'][$i][3];
	$DEPARTAMENTO[$y]=$data->sheets[0]['cells'][$i][4];	
	
	$MUNICIPIO [$y]=$data->sheets[0]['cells'][$i][5];
	$LIDER[$y]=$data->sheets[0]['cells'][$i][6];
	$CELULAR1[$y]=$data->sheets[0]['cells'][$i][7];
	$CELULAR1[$y]=$data->sheets[0]['cells'][$i][8];
	$CORREO1[$y]=$data->sheets[0]['cells'][$i][9];
	$CORREO1[$y]=$data->sheets[0]['cells'][$i][10];
	$NICHO[$y]=$data->sheets[0]['cells'][$i][11];
	$DTOVOTACION[$y]=$data->sheets[0]['cells'][$i][12];	
	$MPIOVOTACION[$y]=$data->sheets[0]['cells'][$i][13];	
	$PUESTO[$y]=$data->sheets[0]['cells'][$i][14];	
	if($DEPARTAMENTO[$y]==""){
		$DEPARTAMENTO[$y]=$DTOVOTACION[$y];
	}
	if($MUNICIPIO[$y]==""){
		$MUNICIPIO[$y]=$MPIOVOTACION[$y];
	}
	$PUESTO[$y]=str_replace("."," ",$PUESTO[$y]);
	//echo $PUESTO[$y];exit;
	$MESA[$y]=$data->sheets[0]['cells'][$i][15];	
	$y++;
}
//var_dump($MESA);
//exit;
for($i=0; $i<$registros; $i++){	
		//BUSO SI YA EXISTE EL MIEMBRO
		$sql="SELECT
				count(1) as MIEMBROS
				FROM
				miembros
				INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
				INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
				INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
				WHERE usuario.USUARIO='".$_SESSION["username"]."' AND miembros.CEDULA=".$cedula[$i];
		$DBGestion->ConsultaArray($sql);
		$miembros=$DBGestion->datos;
		if($miembros[0][MIEMBROS]=='0'){
			//BUSCO EL ID DEL DEPARTAMENTO
			$sql="SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE
					FROM
					departamentos
					where UPPER(departamentos.NOMBRE) = UPPER('".trim($DEPARTAMENTO[$i])."')";
			$DBGestion->ConsultaArray($sql);
			$departamentos=$DBGestion->datos;	
			if(count($departamentos)>=1){
				//BUSCO EL ID DEL MUNICIPIO
				$iddepartamento=$departamentos[0]['IDDEPARTAMENTO'];
				$sql="SELECT
						municipios.ID,
						municipios.NOMBRE,
						municipios.IDDEPARTAMENTO
						FROM
						municipios
						where upper(municipios.NOMBRE) like UPPER('%".trim($MUNICIPIO[$i])."%') AND IDDEPARTAMENTO='".$iddepartamento."'";
				$DBGestion->ConsultaArray($sql);
				$municipios=$DBGestion->datos;	
				if(count($municipios)>=1){
					$idmunicipios=$municipios[0]['ID'];
					//BUSCO EL ID DEL DEPARTAMENTO DEL PUESTO
					$sql="SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE
					FROM
					departamentos
					where UPPER(departamentos.NOMBRE) = UPPER('".trim($DTOVOTACION[$i])."')";
					//echo '<br/>';
					//echo $sql;
					//echo '<br/>';
					$DBGestion->ConsultaArray($sql);
					$dtodepartamentos=$DBGestion->datos;	
					if(count($dtodepartamentos)>=1){
					//echo $MPIOVOTACION[$i];
					//echo '<br/><br/>';
						//BUSCO EL ID DEL MUNICIPIO DEL PUESTO
						$sql="SELECT
						municipios.ID,
						municipios.NOMBRE,
						municipios.IDDEPARTAMENTO
						FROM
						municipios
						where upper(municipios.NOMBRE) like UPPER('%".trim($MPIOVOTACION[$i])."%') AND IDDEPARTAMENTO='".$dtodepartamentos[0]['IDDEPARTAMENTO']."'";
					//	echo $sql;
						//echo '<br/><br/>';
						$DBGestion->ConsultaArray($sql);
						$dtomunicipios=$DBGestion->datos;	
						if(count($dtomunicipios)>=1){
							//BUSCO EL ID DEL PUESTO DE VOTACION 
							$sql="SELECT
									puestos_votacion.IDPUESTO,
									puestos_votacion.NOMBRE_PUESTO							
									FROM
									puestos_votacion
									INNER JOIN municipios ON municipios.ID = puestos_votacion.IDMUNICIPIO
									INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO 
									where departamentos.IDDEPARTAMENTO='".$dtodepartamentos[0]['IDDEPARTAMENTO']."' AND municipios.ID='".$dtomunicipios[0]['ID']."' ";
									
							@$nomp = $PUESTO[$i];
							@$nombrep= ereg_replace( "([     ]+)", "-", $nomp);
							@$nombrep= split("-",$nombrep);	
							$y = 0;
							while(@$nombrep[$y] != ""){
								@$jef = @$nombrep[$y];
								$sql .= " AND UPPER(puestos_votacion.NOMBRE_PUESTO) like UPPER('%".trim($jef)."%') ";
								$y++;
							}
						//	echo $sql;
							$DBGestion->ConsultaArray($sql);
							$puestosvotacion=$DBGestion->datos;	
							if(count($puestosvotacion)>=1){
								$idpuesto=$puestosvotacion[0]['IDPUESTO'];
								//BUSCO EL ID DE LA MESA DE VOTACION
								$sql="SELECT
										mesas.ID,
										mesas.MESA
										FROM
										mesas
										INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
										WHERE puestos_votacion.IDPUESTO='".$idpuesto."' AND mesas.MESA='".$MESA[$i]."'";									
								$DBGestion->ConsultaArray($sql);
								$mesavotacion=$DBGestion->datos;									
								if(count($mesavotacion)>=1){
									//INSERTO EL MIEMBRO EN LA TABLA
									$idmesa=$mesavotacion[0]['ID'];
									$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO, TELEFONO, EMAIL, IDPUESTOSVOTACION, IDLIDER, OCUPACION) VALUES ('".strtoupper(trim($nombre[$i])).' '.strtoupper(trim($apellido[$i]))."','".trim($cedula[$i])."','".$idmunicipios."','".trim($celular1[$i])."','".trim($correo[$i])."','".$idpuesto."','25','VOLUNTARIADO')";										
									echo "Registro ".$i."<br/><br/>".$sql."<br/><br/>";
									$DBGestion->Consulta($sql);									
									$rs = mysql_query("SELECT @@identity AS id");
									if ($row = mysql_fetch_row($rs)) {
									$idmiembro = trim($row[0]);
									}									
									$sql="INSERT INTO MESA_PUESTO_MIEMBRO (IDMESA, MIEMBRO) VALUES (".$idmesa.",".$idmiembro.")";	
									$DBGestion->Consulta($sql);
								}else{
									echo "Problemas con la mesa Puesto de Votacion ".$MESA[$i]." - ".$idpuesto.' - '.$cedula[$i]."<br/><br/>";
									$sql="SELECT
											MAX(mesas.MESA) as MESA
											FROM
											mesas
											where IDPUESTO=".$idpuesto;
									$DBGestion->ConsultaArray($sql);
									$cantidadmesas=$DBGestion->datos;	
									$max=$cantidadmesas[0]['MESA']+1;
									$mesaexcel=trim($MESA[$i]);
									for($p=$max;$p<=$mesaexcel;$p++){
										$sql="INSERT INTO MESAS (IDPUESTO, MESA) VALUES (".$idpuesto.",".$p.")";	
										$DBGestion->Consulta($sql);
									}
									//exit;
								}								
							}else{
								echo "Problemas con el Puesto de Votacion ".$PUESTO[$i]." - ".$cedula[$i]."<br/><br/>";
								if(count($puestosvotacion)==0){
									$sql="select NOMBRE_PUESTO from PUESTOS_VOTACION where upper(NOMBRE_PUESTO) like upper('%".trim($PUESTO[$i])."%') and idmunicipio='".$dtomunicipios[0]['ID']."' "; //echo $sql;
									$DBGestion->Consulta($sql);
								    $puestoexiste=$DBGestion->datos;
									//var_dump($puestoexiste);
									if(empty($puestoexiste)){
										$sql="INSERT INTO PUESTOS_VOTACION (NOMBRE_PUESTO, MESAS, IDMUNICIPIO) VALUES ('".strtoupper(trim($PUESTO[$i]))."','".trim($MESA[$i])."','".$dtomunicipios[0]['ID']."')";	 /*echo $sql;
										echo '<br/><br/>';
										echo $PUESTO[$i].' - '.$MESA[$i].' - '.$cedula[$i].' - '.$MUNICIPIO[$i].' - '.$DTOVOTACION[$i];
										echo '<br/><br/>';
											//exit;								
									echo "SE INGRESO PUESTO DE VOTACION";
									$DBGestion->Consulta($sql);
									$rs = mysql_query("SELECT @@identity AS id");
									if ($row = mysql_fetch_row($rs)) {
										$idpuesto = trim($row[0]);
									}								
									for($k=1;$k<=$MESA[$i]; $k++){
										$sql="INSERT INTO MESAS (IDPUESTO, MESA) VALUES (".$idpuesto.",".$k.")";	
										$DBGestion->Consulta($sql);
									}*/
								  }	
								
								}
							}
						}else{
							echo "Problemas con el municipio del Puesto de Votacion ".$MPIOVOTACION[$i]." - ".$cedula[$i]."<br/><br/>";
						}
					}else{
						echo "Problemas con el departamento del Puesto de Votacion ".$DTOVOTACION[$i]." - ".$cedula[$i]."<br/><br/>";
					}						
				}else{
					echo "Problemas con el municipio. ".$MUNICIPIO[$i]." - ".$cedula[$i]."<br/><br/>";
				}
			}else{
				echo "Problemas con el departamento ".$DEPARTAMENTO[$i]." - ".$cedula[$i]."<br/><br/>";
			}	
		}else{
				
				//echo "cedula ya existe ".$cedula[$i]."<br/><br/>";
		}	
}
?>