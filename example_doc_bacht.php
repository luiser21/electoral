
<?php
ini_set('default_socket_timeout', 5);
require_once 'Excel/Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
include_once "includes/GestionBD.new.class.php";
include_once "consultar_puesto_votacion_registraduria.php";
include_once "includes/funciones.inc.php";
@$data->setOutputEncoding('CP1251');
$nombre_archivo='ejemplo.xls';
$_SESSION["username"]='jhonmorera';
$_SESSION["idmunicipio"]=556;
$_SESSION["municipio"]='VILLETA';
$_SESSION["tipocandidato"]="ALCALDIA";
$_SESSION["idcandidato"]=26;
//move_uploaded_file($_FILES["archivoupload"]["tmp_name"], "Excel/cargas/".$_FILES["archivoupload"]["name"]); 
$data->read('Excel/cargas/ejemplo.xls');
$y=0;
$registros=count($data->sheets[0]['cells']);
for ($i = 2; $i <= $registros; $i++) {
	$cedula_simpatizante[$y]=trim($data->sheets[0]['cells'][$i][3]);
	$cedula_lider[$y]=trim($data->sheets[0]['cells'][$i][1]);
	$nombre_lider[$y]=$data->sheets[0]['cells'][$i][2];
	$nombre_simpartizante[$y]=$data->sheets[0]['cells'][$i][4];
	$ocupacion[$y]=(!empty($data->sheets[0]['cells'][$i][5]))? $data->sheets[0]['cells'][$i][5]:'VOLUNTARIADO';	
	$celular[$y]=(!empty($data->sheets[0]['cells'][$i][6]))? $data->sheets[0]['cells'][$i][6] : '';
	$email [$y]=(!empty($data->sheets[0]['cells'][$i][7]))? $data->sheets[0]['cells'][$i][7] : '';
	$direccion [$y]=(!empty($data->sheets[0]['cells'][$i][8]))? $data->sheets[0]['cells'][$i][8] : '';
	$MUNICIPIO [$y]=(!empty($data->sheets[0]['cells'][$i][9]))? $data->sheets[0]['cells'][$i][9] : '';
	$departamento[$y]=(!empty($data->sheets[0]['cells'][$i][10]))? $data->sheets[0]['cells'][$i][10] : '';
	$candidato[$y]=$data->sheets[0]['cells'][$i][11];	
	$y++;
}
$puestoreg=array();
$old_error_handler = set_error_handler("myErrorHandler");
$DBGestion = new GestionBD('AGENDAMIENTO');	
//INSERTO ARCHIVO
$sql="INSERT INTO UPLOAD_FILE (FILE, CREADO,CANDIDATO) VALUES ('".'Excel/cargas/'.$nombre_archivo."',SYSDATE(),'".$_SESSION["username"]."')";										
$DBGestion->Consulta($sql);	
$sql="SELECT @@identity AS id";
$DBGestion->ConsultaArray($sql);
$files=$DBGestion->datos;
$idfile = $files[0]['id'];
		
$datosvalidos=0;
$datosinvalidos=0;
$aptosvotar=0;
$aptosnovotar=0;
$muerte=0;
$baja=0;
$debeinscribirse=0;
$pendiente=0;
$diferentemunicipio=0;
for($i=0; $i<$registros-1; $i++){		
	try{		
		
		$puestoreg=puesto_votacion($cedula_simpatizante[$i]);	
		echo '[CEDULA] = <strong>'.$cedula_simpatizante[$i].'</strong>';
		if(!empty($puestoreg['ERROR'])){
			echo ' - '.$puestoreg['ERROR'].'<br/>';
			$aptosnovotar++;
			//VALIDO LIDER
			$sql="SELECT
					LIDERES.ID
					FROM
					LIDERES
					INNER JOIN candidato ON candidato.ID = LIDERES.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."' AND LIDERES.CEDULA=".$cedula_lider[$i];			
			$DBGestion->ConsultaArray($sql);
			$idlider=$DBGestion->datos;
			if(!empty($idlider[0]['ID'])){	
				//BUSCO EL ID DEL DEPARTAMENTO
				$sql="SELECT
						departamentos.IDDEPARTAMENTO,
						departamentos.NOMBRE
						FROM
						departamentos
						where UPPER(departamentos.NOMBRE) like UPPER('%".trim($departamento[$i])."%')";
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
							where upper(municipios.NOMBRE) like UPPER('%".trim($MUNICIPIO[$i])."%') AND IDDEPARTAMENTO=".$iddepartamento;
					$DBGestion->ConsultaArray($sql);
					$municipios=$DBGestion->datos;	
					if(count($municipios)>=1){
						$idmunicipios=$municipios[0]['ID'];
						//echo $puestoreg['ERROR'];
						if($puestoreg['ERROR']=='Cancelada por Muerte'){
							$muerte++;
							$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
									VALUES ('".strtoupper(trim($nombre_simpartizante[$i]))."',".trim($cedula_simpatizante[$i]).",
									".$idmunicipios.",1,".$idlider[0]['ID'].",'".$ocupacion[$i]."',".$idfile.")";										
							$DBGestion->Consulta($sql);	
							//echo $sql;
						}elseif($puestoreg['ERROR']=='Baja por Perdida o Suspension de los Derechos Politicos'){
							$baja++;
							$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
									VALUES ('".strtoupper(trim($nombre_simpartizante[$i]))."',".trim($cedula_simpatizante[$i]).",
									".$idmunicipios.",2,".$idlider[0]['ID'].",'".$ocupacion[$i]."',".$idfile.")";										
							//echo $sql;
							$DBGestion->Consulta($sql);	
						}elseif($puestoreg['ERROR']=='Pendiente por Solicitud en proceso'){
							$pendiente++;
							$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
									VALUES ('".strtoupper(trim($nombre_simpartizante[$i]))."',".trim($cedula_simpatizante[$i]).",
									".$idmunicipios.",3,".$idlider[0]['ID'].",'".$ocupacion[$i]."',".$idfile.")";										
							$DBGestion->Consulta($sql);	
							//echo $sql;
						}elseif($puestoreg['ERROR']=='No inscrito'){
							$debeinscribirse++;
							//echo $sql;
							$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
									VALUES ('".strtoupper(trim($nombre_simpartizante[$i]))."',".trim($cedula_simpatizante[$i]).",
									".$idmunicipios.",4,".$idlider[0]['ID'].",'".$ocupacion[$i]."',".$idfile.")";										
							$DBGestion->Consulta($sql);	
							echo $sql;
						}elseif($puestoreg['ERROR']=='INDEFINIDO'){
							$debeinscribirse++;
							
							$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
									VALUES ('".strtoupper(trim($nombre_simpartizante[$i]))."',".trim($cedula_simpatizante[$i]).",
									".$idmunicipios.",5,".$idlider[0]['ID'].",'INDEFINIDO',".$idfile.")";										
							$DBGestion->Consulta($sql);	
							//echo $sql;
						}						
					}
				}
			}
		}else{
			
			//imprimir($puestoreg);
			echo '<br/>';
			echo '[DEPARTAMENTO] = '.$DEPARTAMENTO_R=trim($puestoreg['DEPARTAMENTO']);
			echo '<br/>';
			echo '[MUNICIPIO] = '.$MUNICIPIO_R=trim($puestoreg['MUNICIPIO']);
			echo '<br/>';
			echo '[PUESTO] = '.$PUESTO_R=trim($puestoreg['PUESTO']);
			echo '<br/>';
			echo '[DIRECCION] = '.$DIRECCION_R=trim($puestoreg['DIRECCION']);
			echo '<br/>';
			echo '[MESA] = '.$MESA_R=trim($puestoreg['MESA']);
			echo '<br/>';
			echo '[FECHA_INSCRIPCION] = '.$FECHA_INSCRIP=trim($puestoreg['FECHA_INSCRIP']);
		
			//BUSO SI YA EXISTE EL MIEMBRO
			$sql="SELECT
					count(1) as MIEMBROS
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."' AND miembros.CEDULA=".$cedula_simpatizante[$i];
			$DBGestion->ConsultaArray($sql);
			$miembros=$DBGestion->datos;
			
			if($miembros[0]['MIEMBROS']=='0'){
				//BUSCO EL ID DEL DEPARTAMENTO
				$sql="SELECT
						departamentos.IDDEPARTAMENTO,
						departamentos.NOMBRE
						FROM
						departamentos
						where UPPER(departamentos.NOMBRE) like UPPER('%".trim($departamento[$i])."%')";
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
							where upper(municipios.NOMBRE) like UPPER('%".trim($MUNICIPIO[$i])."%') AND IDDEPARTAMENTO=".$iddepartamento;
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
						where UPPER(departamentos.NOMBRE) like UPPER('%".trim($DEPARTAMENTO_R)."%')";
						
						$DBGestion->ConsultaArray($sql);
						$dtodepartamentos=$DBGestion->datos;	
						if(count($dtodepartamentos)>=1){
							//BUSCO EL ID DEL MUNICIPIO DEL PUESTO
							$sql="SELECT
							municipios.ID,
							municipios.NOMBRE,
							municipios.IDDEPARTAMENTO
							FROM
							municipios
							where upper(municipios.NOMBRE) like UPPER('%".trim($MUNICIPIO_R)."%') AND IDDEPARTAMENTO=".$dtodepartamentos[0]['IDDEPARTAMENTO'];

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
										where departamentos.IDDEPARTAMENTO=".$dtodepartamentos[0]['IDDEPARTAMENTO']." AND municipios.ID=".$dtomunicipios[0]['ID'];
										
								@$nomp = $PUESTO_R;
								@$nombrep= ereg_replace( "([     ]+)", "-", $nomp);
								@$nombrep= split("-",$nombrep);	
								$y = 0;
								while(@$nombrep[$y] != ""){
									@$jef = @$nombrep[$y];
									$sql .= " AND UPPER(puestos_votacion.NOMBRE_PUESTO) like UPPER('%".trim($jef)."%') ";
									$y++;
								}							
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
											WHERE puestos_votacion.IDPUESTO=".$idpuesto." AND mesas.MESA='".$MESA_R."'";									
									$DBGestion->ConsultaArray($sql);
									$mesavotacion=$DBGestion->datos;
									if(count($mesavotacion)>=1){
										//VALIDO LIDER
										$sql="SELECT
												LIDERES.ID
												FROM
												LIDERES
												INNER JOIN candidato ON candidato.ID = LIDERES.IDCANDIDATO
												INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
												WHERE usuario.USUARIO='".$_SESSION["username"]."' AND LIDERES.CEDULA=".$cedula_lider[$i];
										
										$DBGestion->ConsultaArray($sql);
										$idlider=$DBGestion->datos;
										if(!empty($idlider[0]['ID'])){									
											//INSERTO EL MIEMBRO EN LA TABLA
											$idmesa=$mesavotacion[0]['ID'];
											$sql="SELECT
												puestos_votacion.IDMUNICIPIO							
												FROM
												puestos_votacion										
												where IDPUESTO=".$idpuesto;
											$DBGestion->ConsultaArray($sql);
											$idmunicipiopuesto=$DBGestion->datos;
											
											$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) VALUES ('".strtoupper(trim($nombre_simpartizante[$i]))."',".trim($cedula_simpatizante[$i]).",".$idmunicipios.",".$idpuesto.",".$idlider[0]['ID'].",'".$ocupacion[$i]."',".$idfile.")";										
											//echo "Registro ".$i."<br/><br/>".$sql."<br/><br/>";
											$DBGestion->Consulta($sql);	
											$sql="SELECT @@identity AS id";
											$DBGestion->ConsultaArray($sql);
											$rs=$DBGestion->datos;
											$idmiembro = $rs[0]['id'];
																			
											$sql="INSERT INTO MESA_PUESTO_MIEMBRO (IDMESA, MIEMBRO,CANDIDATO) VALUES (".$idmesa.",".$idmiembro.",'".$_SESSION["username"]."')";	
											$DBGestion->Consulta($sql);		
											if($_SESSION["tipocandidato"]=="ALCALDIA"){
														if($idmunicipiopuesto[0]['IDMUNICIPIO']!=$_SESSION["idmunicipio"]){
															$diferentemunicipio++;
														}else{
															$datosvalidos++;
														}														
													}	
											$aptosvotar++;
										}else{
											echo '<strong><br/>Simpatizante sin Lider: '.$cedula_simpatizante[$i].' - '.$nombre_simpartizante[$i].'<br/></strong>';	
											$datosinvalidos++;
											//insertar los simpatizantes con datos incompletos o sin lideres
											
										}										
									}else{
										echo "<strong><br/>Problemas con la mesa del Puesto de Votacion ".$MESA_R." - ".$idpuesto.' - '.$cedula_simpatizante[$i]."<br/><br/></strong>";
										$sql="SELECT
												MAX(mesas.MESA) as MESA
												FROM
												mesas
												where IDPUESTO=".$idpuesto;
										$DBGestion->ConsultaArray($sql);
										$cantidadmesas=$DBGestion->datos;	
										$max=$cantidadmesas[0]['MESA']+1;
										$mesaexcel=trim($MESA_R);
										for($p=$max;$p<=$mesaexcel;$p++){
											$sql="INSERT INTO MESAS (IDPUESTO, MESA) VALUES (".$idpuesto.",".$p.")";	
											$DBGestion->Consulta($sql);
										}
										//BUSCO EL ID DE LA MESA DE VOTACION lo vuelvo a buscar ya que lo insert
										$sql="SELECT
												mesas.ID,
												mesas.MESA
												FROM
												mesas
												INNER JOIN puestos_votacion ON puestos_votacion.IDPUESTO = mesas.IDPUESTO
												WHERE puestos_votacion.IDPUESTO=".$idpuesto." AND mesas.MESA='".$MESA_R."'";									
										$DBGestion->ConsultaArray($sql);
										$mesavotacion=$DBGestion->datos;
										if(count($mesavotacion)>=1){
											//VALIDO LIDER
											$sql="SELECT
													LIDERES.ID
													FROM
													LIDERES
													INNER JOIN candidato ON candidato.ID = LIDERES.IDCANDIDATO
													INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
													WHERE usuario.USUARIO='".$_SESSION["username"]."' AND LIDERES.CEDULA=".$cedula_lider[$i];
											$DBGestion->ConsultaArray($sql);
											$idlider=$DBGestion->datos;
											if(!empty($idlider[0]['ID'])){									
												//INSERTO EL MIEMBRO EN LA TABLA
												$idmesa=$mesavotacion[0]['ID'];
												$sql="SELECT
												puestos_votacion.IDMUNICIPIO							
												FROM
												puestos_votacion										
												where IDPUESTO=".$idpuesto;
												$DBGestion->ConsultaArray($sql);
												$idmunicipiopuesto=$DBGestion->datos;												
												$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) VALUES ('".strtoupper(trim($nombre_simpartizante[$i]))."',".trim($cedula_simpatizante[$i]).",".$idmunicipios.",".$idpuesto.",".$idlider[0]['ID'].",'".$ocupacion[$i]."',".$idfile.")";										
												//echo "Registro ".$i."<br/><br/>".$sql."<br/><br/>";
												$DBGestion->Consulta($sql);									
												$sql="SELECT @@identity AS id";
												$DBGestion->ConsultaArray($sql);
												$rs=$DBGestion->datos;
												$idmiembro = $rs[0]['id'];								
												$sql="INSERT INTO MESA_PUESTO_MIEMBRO (IDMESA, MIEMBRO,CANDIDATO) VALUES (".$idmesa.",".$idmiembro.",'".$_SESSION["username"]."')";	
												$DBGestion->Consulta($sql);		
												if($_SESSION["tipocandidato"]=="ALCALDIA"){
														if($idmunicipiopuesto[0]['IDMUNICIPIO']!=$_SESSION["idmunicipio"]){
															$diferentemunicipio++;
														}else{
															$datosvalidos++;
														}														
													}	
												$aptosvotar++;
											}else{
												echo '<strong><br/>Simpatizante sin Lider: '.$cedula_simpatizante[$i].' - '.$nombre_simpartizante[$i].'<br/></strong>';	
												$datosinvalidos++;
												//insertar los simpatizantes con datos incompletos o sin lideres
												
											}	
										}else{
											echo '<strong><br/>Imposible crear el registro<br/></strong>';
											//mandarlo a la tabla de invalidos
											$datosinvalidos++;											
										}
									}								
								}else{
									echo "<strong><br/>Problemas con el Puesto de Votacion ".$PUESTO_R." - ".$cedula_simpatizante[$i]."<br/><br/></strong>";
									if(count($puestosvotacion)==0){
										$sql="select NOMBRE_PUESTO from PUESTOS_VOTACION where upper(NOMBRE_PUESTO) like upper('%".trim($PUESTO_R)."%') and idmunicipio='".$dtomunicipios[0]['ID']."' "; //echo $sql;
										$DBGestion->Consulta($sql);
										$puestoexiste=$DBGestion->datos;
										if(empty($puestoexiste)){
											$sql="INSERT INTO PUESTOS_VOTACION (NOMBRE_PUESTO, MESAS, IDMUNICIPIO) VALUES ('".strtoupper(trim($PUESTO_R))."','".trim($MESA_R)."','".$dtomunicipios[0]['ID']."')";	
											echo $PUESTO_R.' - '.$MESA_R.' - '.$cedula_simpatizante[$i].' - '.$MUNICIPIO[$i];																	
											echo " SE INGRESO PUESTO DE VOTACION";
											echo '<br/>';	
											$DBGestion->Consulta($sql);
											$rs = mysql_query("SELECT @@identity AS id");
											if ($row = mysql_fetch_row($rs)) {
												$idpuesto = trim($row[0]);
											}								
											for($k=1;$k<=$MESA_R; $k++){
												$sql="INSERT INTO MESAS (IDPUESTO, MESA) VALUES (".$idpuesto.",".$k.")";	
												$DBGestion->Consulta($sql);
												}
										}
										//BUSCO EL ID DEL PUESTO DE VOTACION 
										$sql="SELECT
												puestos_votacion.IDPUESTO,
												puestos_votacion.NOMBRE_PUESTO							
												FROM
												puestos_votacion
												INNER JOIN municipios ON municipios.ID = puestos_votacion.IDMUNICIPIO
												INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO 
												where departamentos.IDDEPARTAMENTO=".$dtodepartamentos[0]['IDDEPARTAMENTO']." AND municipios.ID=".$dtomunicipios[0]['ID'];
												
										@$nomp = $PUESTO_R;
										@$nombrep= ereg_replace( "([     ]+)", "-", $nomp);
										@$nombrep= split("-",$nombrep);	
										$y = 0;
										while(@$nombrep[$y] != ""){
											@$jef = @$nombrep[$y];
											$sql .= " AND UPPER(puestos_votacion.NOMBRE_PUESTO) like UPPER('%".trim($jef)."%') ";
											$y++;
										}							
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
													WHERE puestos_votacion.IDPUESTO=".$idpuesto." AND mesas.MESA='".$MESA_R."'";									
											$DBGestion->ConsultaArray($sql);
											$mesavotacion=$DBGestion->datos;
											if(count($mesavotacion)>=1){
												//VALIDO LIDER
												$sql="SELECT
														LIDERES.ID
														FROM
														LIDERES
														INNER JOIN candidato ON candidato.ID = LIDERES.IDCANDIDATO
														INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
														WHERE usuario.USUARIO='".$_SESSION["username"]."' AND LIDERES.CEDULA=".$cedula_lider[$i];
												$DBGestion->ConsultaArray($sql);
												$idlider=$DBGestion->datos;
												if(!empty($idlider[0]['ID'])){									
													//INSERTO EL MIEMBRO EN LA TABLA
													$idmesa=$mesavotacion[0]['ID'];
													$sql="SELECT
														puestos_votacion.IDMUNICIPIO							
														FROM
														puestos_votacion										
														where IDPUESTO=".$idpuesto;
													$DBGestion->ConsultaArray($sql);
													$idmunicipiopuesto=$DBGestion->datos;
													
													$sql="INSERT INTO MIEMBROS (NOMBRES, CEDULA, MUNICIPIO,TELEFONO,EMAIL, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
													VALUES ('".strtoupper(trim($nombre_simpartizante[$i]))."',".trim($cedula_simpatizante[$i]).",".$idmunicipios.",'".$celular[$i]."','".$email[$i]."',".$idpuesto.",".$idlider[0]['ID'].",'".$ocupacion[$i]."',".$idfile.")";										
													echo "Registro ".$i."<br/><br/>".$sql."<br/><br/>";
													$DBGestion->Consulta($sql);									
													$rs = mysql_query("SELECT @@identity AS id");
													if ($row = mysql_fetch_row($rs)) {
													$idmiembro = trim($row[0]);
													}									
													$sql="INSERT INTO MESA_PUESTO_MIEMBRO (IDMESA, MIEMBRO,CANDIDATO) VALUES (".$idmesa.",".$idmiembro.",'".$_SESSION["username"]."')";	
													$DBGestion->Consulta($sql);		
													if($_SESSION["tipocandidato"]=="ALCALDIA"){
														if($idmunicipiopuesto[0]['IDMUNICIPIO']!=$_SESSION["idmunicipio"]){
															$diferentemunicipio++;
														}else{
															$datosvalidos++;
														}														
													}													
													$aptosvotar++;
												}else{
													echo '<strong><br/>Simpatizante sin Lider: '.$cedula_simpatizante[$i].' - '.$nombre_simpartizante[$i].'<br/></strong>';	
													$datosinvalidos++;
													//insertar los simpatizantes con datos incompletos o sin lideres
													$sql="INSERT INTO TMP_MIEMBROS (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION) 
													VALUES (".trim($cedula_simpatizante[$i]).",'".strtoupper(trim($nombre_simpartizante[$i]))."','".$departamento[$i]."','".$MUNICIPIO[$i]."',".$idlider[0]['ID'].",'".$nombre_lider[$i]."','".$celular[$i]."','".$email[$i]."',
													'Simpatizante con lider',". $_SESSION["idcandidato"].",'".$ocupacion[$i]."')";	
													$DBGestion->Consulta($sql);	
													
												}		
											}else{
												echo '<strong><br/>Imposible crear el registro<br/></strong>';
												//mandarlo a la tabla de invalidos
												$datosinvalidos++;		
												$sql="INSERT INTO TMP_MIEMBROS (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION) 
												VALUES (".trim($cedula_simpatizante[$i]).",'".strtoupper(trim($nombre_simpartizante[$i]))."','".$departamento[$i]."','".$MUNICIPIO[$i]."',".$idlider[0]['ID'].",'".$nombre_lider[$i]."','".$celular[$i]."','".$email[$i]."',
												'Imposible crear el registro',". $_SESSION["idcandidato"].",'".$ocupacion[$i]."')";	
												$DBGestion->Consulta($sql);	
											}
										}else{
											echo '<strong><br/>Imposible crear el registro<br/></strong>';
											//mandarlo a la tabla de invalidos
											$datosinvalidos++;		
											$sql="INSERT INTO TMP_MIEMBROS (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION) 
											VALUES (".trim($cedula_simpatizante[$i]).",'".strtoupper(trim($nombre_simpartizante[$i]))."','".$departamento[$i]."','".$MUNICIPIO[$i]."',".$idlider[0]['ID'].",'".$nombre_lider[$i]."','".$celular[$i]."','".$email[$i]."',
											'Imposible crear el registro',". $_SESSION["idcandidato"].",'".$ocupacion[$i]."')";	
											$DBGestion->Consulta($sql);								
										}
									}
								}
							}else{
								echo "<strong><br/>Problemas con el municipio del Puesto de Votacion ".$MUNICIPIO_R." - ".$cedula_simpatizante[$i]."<br/><br/></strong>";
								$datosinvalidos++;
								$sql="INSERT INTO TMP_MIEMBROS (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION) 
								VALUES (".trim($cedula_simpatizante[$i]).",'".strtoupper(trim($nombre_simpartizante[$i]))."','".$departamento[$i]."','".$MUNICIPIO[$i]."',".$idlider[0]['ID'].",'".$nombre_lider[$i]."','".$celular[$i]."','".$email[$i]."',
								'Problemas con el municipio del Puesto de Votacion',". $_SESSION["idcandidato"].",'".$ocupacion[$i]."')";	
								//echo $sql;
								$DBGestion->Consulta($sql);	
							}
						}else{
							echo "<strong><br/>Problemas con el departamento del Puesto de Votacion ".$DEPARTAMENTO_R." - ".$cedula_simpatizante[$i]."<br/><br/></strong>";
							$datosinvalidos++;
							$sql="INSERT INTO TMP_MIEMBROS (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION) 
							VALUES (".trim($cedula_simpatizante[$i]).",'".strtoupper(trim($nombre_simpartizante[$i]))."','".$departamento[$i]."','".$MUNICIPIO[$i]."',".$idlider[0]['ID'].",'".$nombre_lider[$i]."','".$celular[$i]."','".$email[$i]."',
							'Problemas con el departamento del Puesto de Votacion',". $_SESSION["idcandidato"].",'".$ocupacion[$i]."')";	
							$DBGestion->Consulta($sql);	
						}						
					}else{
						echo "<strong><br/>Problemas con el municipio. ".$MUNICIPIO[$i]." - ".$cedula_simpatizante[$i]."<br/><br/></strong>";
						$datosinvalidos++;
						$sql="INSERT INTO TMP_MIEMBROS (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION) 
						VALUES (".trim($cedula_simpatizante[$i]).",'".strtoupper(trim($nombre_simpartizante[$i]))."','".$departamento[$i]."','".$MUNICIPIO[$i]."',".$idlider[0]['ID'].",'".$nombre_lider[$i]."','".$celular[$i]."','".$email[$i]."',
						'Problemas con el MUNICIPIO',". $_SESSION["idcandidato"].",'".$ocupacion[$i]."')";	
						$DBGestion->Consulta($sql);	
					}
				}else{
					echo "<strong><br/>Problemas con el departamento ".$departamento[$i]." - ".$cedula_simpatizante[$i]."<br/><br/></strong>";
					$datosinvalidos++;
					$sql="INSERT INTO TMP_MIEMBROS (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION) 
					VALUES (".trim($cedula_simpatizante[$i]).",'".strtoupper(trim($nombre_simpartizante[$i]))."','".$departamento[$i]."','".$MUNICIPIO[$i]."',".$idlider[0]['ID'].",'".$nombre_lider[$i]."','".$celular[$i]."','".$email[$i]."',
					'Problemas con el departamento',". $_SESSION["idcandidato"].",'".$ocupacion[$i]."')";	
					$DBGestion->Consulta($sql);		
				}	
			}else{
				echo "<strong><br/>Cedula ya existe ".$cedula_simpatizante[$i]."<br/><br/></strong>";
				$datosinvalidos++;
				$sql="INSERT INTO TMP_MIEMBROS (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION) 
					VALUES (".trim($cedula_simpatizante[$i]).",'".strtoupper(trim($nombre_simpartizante[$i]))."','".$departamento[$i]."','".$MUNICIPIO[$i]."',".$idlider[0]['ID'].",'".$nombre_lider[$i]."','".$celular[$i]."','".$email[$i]."',
					'Cedula ya existe',". $_SESSION["idcandidato"].",'".$ocupacion[$i]."')";	
				//echo $sql;
				$DBGestion->Consulta($sql);			
							
			}	
		}
	$sql="UPDATE UPLOAD_FILE SET DATOSVALIDOOS=".$datosvalidos." ,DATOSINVALIDOS=".$datosinvalidos.", APTOSVOTAR=".$aptosvotar.",
		  NOAPTOSVOTAR=".$aptosnovotar.",MUERTE=".$muerte.",DEBEINSCRIBIRSE=".$debeinscribirse.", PENDIENTE=".$pendiente.",BAJA=".$baja.",
		  DIFERENTEMUNICIPIO=".$diferentemunicipio."  WHERE ID=".$idfile;	
	$DBGestion->Consulta($sql);	
	}catch(Exception $e){
		$msg = $ex->getMessage() . $ex->getTraceAsString();
        error_log('ELASTICSEARCH ERROR: ' . $msg);
	}
}
$sql="SELECT
					COUNT(ID) AS TOTAL
					FROM
					BOLETINES					
					WHERE CANDIDATO=".$_SESSION["idcandidato"];			
			$DBGestion->ConsultaArray($sql);
			$idboletine=$DBGestion->datos;
			$idboletine=$idboletine[0]['TOTAL'];
		 
	$sql="INSERT INTO BOLETINES (REPORTES,HORA,MOVILIZADOS,ESTADO,ESTADO_DEPARTAMENTO,CANDIDATO,MES)  VALUES 
			('".($idboletine+1)." - CARGUE','".Num2MesSmall(date('m'))."',".$datosvalidos.",2,0,".$_SESSION["idcandidato"].",'".Num2MesSmall(date('m'))." ".date('Y')." ')	";			
	$DBGestion->Consulta($sql);	
?>
	 