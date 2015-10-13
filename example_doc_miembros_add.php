
<?php
ini_set('default_socket_timeout', 5);

include_once "includes/GestionBD.new.class.php";
include_once "consultar_puesto_votacion_registraduria.php";
include_once "includes/funciones.inc.php";

function ingresar_manual_miembros($cedula,$nombre,$celular,$email,$idlider,$ocupacion){

$_SESSION["username"]=$_SESSION["username"];
$_SESSION["idmunicipio"]=$_SESSION["idmunicipio"];
$_SESSION["municipio"]=$_SESSION["municipio"];
$_SESSION["tipocandidato"]=$_SESSION["tipocandidato"];
$_SESSION["idcandidato"]=$_SESSION["idcandidato"];


$cedula_simpatizante=$cedula;
$nombre_lider='';

$nombre_simpartizante=$nombre;
$ocupacion=$ocupacion;	
$celular=$celular;
$email=$email;
$candidato=$_SESSION["idcandidato"];	
$departamento='';	
$MUNICIPIO='';

$puestoreg=array();
$old_error_handler = set_error_handler("myErrorHandler");
$DBGestion = new GestionBD('AGENDAMIENTO');	
//INSERTO ARCHIVO
$datosvalidos=0;
$sql="SELECT ID
					FROM
					upload_file				
					WHERE CANDIDATO='".$_SESSION["username"]."' and FILE='Carga_Manual'";
			$DBGestion->ConsultaArray($sql);
			$upload=$DBGestion->datos;
			if(empty($upload[0]['ID'])){	
			
				$sql="INSERT INTO upload_file (FILE, CREADO,CANDIDATO) VALUES ('Carga_Manual',SYSDATE(),'".$_SESSION["username"]."')";										
				$DBGestion->Consulta($sql);	
				$sql="SELECT @@identity AS id";
				$DBGestion->ConsultaArray($sql);
				$files=$DBGestion->datos;
				$idfile = $files[0]['id'];
				
				$sql="SELECT
					COUNT(ID) AS TOTAL
					FROM
					boletines					
					WHERE CANDIDATO=".$_SESSION["idcandidato"];			
						$DBGestion->ConsultaArray($sql);
						$idboletine=$DBGestion->datos;
						$idboletine=$idboletine[0]['TOTAL'];
					 
				$sql="INSERT INTO boletines (REPORTES,HORA,MOVILIZADOS,ESTADO,ESTADO_DEPARTAMENTO,CANDIDATO,MES,IDDEPARTAMENTO)  VALUES 
						('".($idboletine+1)." - CARGUE','".Num2MesSmall(date('m'))."',".$datosvalidos.",2,0,".$_SESSION["idcandidato"].",'".Num2MesSmall(date('m'))." ".date('Y')." ',1)	";			
				$DBGestion->Consulta($sql);					
				
			}else{
				$idfile = $upload[0]['ID'];
			}

$datosinvalidos=0;
$aptosvotar=0;
$aptosnovotar=0;
$muerte=0;
$baja=0;
$debeinscribirse=0;
$pendiente=0;
$diferentemunicipio=0;	
$registro_bueno='';
	try{				
		$puestoreg=puesto_votacion($cedula_simpatizante);	
		//echo '[CEDULA] = <strong>'.$cedula_simpatizante.'</strong>';
		if(!empty($puestoreg['ERROR'])){
			$registro_bueno=$puestoreg['ERROR'];
			$aptosnovotar++;			
			$idlider=$idlider;
			if(!empty($idlider)){
				
				$idmunicipios=0;
				if($puestoreg['ERROR']=='Cancelada por Muerte'){
					$registro_bueno='Cedula reporta Cancelada por Muerte';
					$muerte++;
					$sql="INSERT INTO miembros (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
							VALUES ('".strtoupper(trim($nombre_simpartizante))."',".trim($cedula_simpatizante).",
							".$idmunicipios.",1,".$idlider.",'".$ocupacion."',".$idfile.")";										
					$DBGestion->Consulta($sql);	
				}elseif($puestoreg['ERROR']=='Baja por Perdida o Suspension de los Derechos Politicos'){
					$registro_bueno='Cedula reporta Baja por Perdida o Suspension de los Derechos Politicos';
					$baja++;
					$sql="INSERT INTO miembros (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
							VALUES ('".strtoupper(trim($nombre_simpartizante))."',".trim($cedula_simpatizante).",
							".$idmunicipios.",2,".$idlider.",'".$ocupacion."',".$idfile.")";										
					$DBGestion->Consulta($sql);	
				}elseif($puestoreg['ERROR']=='Pendiente por Solicitud en proceso'){
					$registro_bueno='Cedula reporta Pendiente por Solicitud en proceso';
					$pendiente++;
					$sql="INSERT INTO miembros (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
							VALUES ('".strtoupper(trim($nombre_simpartizante))."',".trim($cedula_simpatizante).",
							".$idmunicipios.",3,".$idlider.",'".$ocupacion."',".$idfile.")";										
					$DBGestion->Consulta($sql);	
				}elseif($puestoreg['ERROR']=='No inscrito'){
					$registro_bueno='Cedula reporta Debe inscribirse en los períodos que establezca la Registraduría Nacional del Estado Civil en próximas oportunidades';
					$debeinscribirse++;
					$sql="INSERT INTO miembros (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
							VALUES ('".strtoupper(trim($nombre_simpartizante))."',".trim($cedula_simpatizante).",
							".$idmunicipios.",4,".$idlider.",'".$ocupacion."',".$idfile.")";										
					$DBGestion->Consulta($sql);	
				}elseif($puestoreg['ERROR']=='INDEFINIDO'){
					$registro_bueno='INDEFINIDO';					
					$debeinscribirse++;
					$sql="INSERT INTO miembros (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
							VALUES ('".strtoupper(trim($nombre_simpartizante))."',".trim($cedula_simpatizante).",
							".$idmunicipios.",5,".$idlider.",'INDEFINIDO',".$idfile.")";										
					$DBGestion->Consulta($sql);	
				}			
			}
			
		}else{
			$registro_bueno='1';
			$DEPARTAMENTO_R=trim($puestoreg['DEPARTAMENTO']);
			$MUNICIPIO_R=trim($puestoreg['MUNICIPIO']);
			$PUESTO_R=trim($puestoreg['PUESTO']);
			$DIRECCION_R=trim($puestoreg['DIRECCION']);
			$MESA_R=trim($puestoreg['MESA']);
			$FECHA_INSCRIP=trim($puestoreg['FECHA_INSCRIP']);
		
			//BUSO SI YA EXISTE EL MIEMBRO
			$sql="SELECT
					count(1) as MIEMBROS
					FROM
					miembros
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."' AND miembros.CEDULA=".$cedula_simpatizante;
			$DBGestion->ConsultaArray($sql);
			$miembros=$DBGestion->datos;
			
			if($miembros[0]['MIEMBROS']=='0'){				
						$idmunicipios=0;
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
										$idlider=$idlider;
										if(!empty($idlider)){									
											//INSERTO EL MIEMBRO EN LA TABLA
											$idmesa=$mesavotacion[0]['ID'];
											$sql="SELECT
												puestos_votacion.IDMUNICIPIO							
												FROM
												puestos_votacion										
												where IDPUESTO=".$idpuesto;
											$DBGestion->ConsultaArray($sql);
											$idmunicipiopuesto=$DBGestion->datos;
											
											$sql="INSERT INTO miembros (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) VALUES ('".strtoupper(trim($nombre_simpartizante))."',".trim($cedula_simpatizante).",".$idmunicipios.",".$idpuesto.",".$idlider.",'".$ocupacion."',".$idfile.")";										
											//echo "Registro ".$i."<br/><br/>".$sql."<br/><br/>";
											$DBGestion->Consulta($sql);	
											$sql="SELECT @@identity AS id";
											$DBGestion->ConsultaArray($sql);
											$rs=$DBGestion->datos;
											$idmiembro = $rs[0]['id'];
																			
											$sql="INSERT INTO mesa_puesto_miembro (IDMESA, MIEMBRO,CANDIDATO) VALUES (".$idmesa.",".$idmiembro.",'".$_SESSION["username"]."')";	
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
											//echo '<strong><br/>Simpatizante sin Lider: '.$cedula_simpatizante.' - '.$nombre_simpartizante.'<br/></strong>';	
											$datosinvalidos++;
											//insertar los simpatizantes con datos incompletos o sin lideres
											
										}										
									}else{
										//echo "<strong><br/>Problemas con la mesa del Puesto de Votacion ".$MESA_R." - ".$idpuesto.' - '.$cedula_simpatizante."<br/><br/></strong>";
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
											$sql="INSERT INTO mesas (IDPUESTO, MESA) VALUES (".$idpuesto.",".$p.")";	
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
											$idlider=$idlider;
											if(!empty($idlider)){									
												//INSERTO EL MIEMBRO EN LA TABLA
												$idmesa=$mesavotacion[0]['ID'];
												$sql="SELECT
												puestos_votacion.IDMUNICIPIO							
												FROM
												puestos_votacion										
												where IDPUESTO=".$idpuesto;
												$DBGestion->ConsultaArray($sql);
												$idmunicipiopuesto=$DBGestion->datos;												
												$sql="INSERT INTO miembros (NOMBRES, CEDULA, MUNICIPIO, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) VALUES ('".strtoupper(trim($nombre_simpartizante))."',".trim($cedula_simpatizante).",".$idmunicipios.",".$idpuesto.",".$idlider.",'".$ocupacion."',".$idfile.")";										
												//echo "Registro ".$i."<br/><br/>".$sql."<br/><br/>";
												$DBGestion->Consulta($sql);									
												$sql="SELECT @@identity AS id";
												$DBGestion->ConsultaArray($sql);
												$rs=$DBGestion->datos;
												$idmiembro = $rs[0]['id'];								
												$sql="INSERT INTO mesa_puesto_miembro (IDMESA, MIEMBRO,CANDIDATO) VALUES (".$idmesa.",".$idmiembro.",'".$_SESSION["username"]."')";	
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
												//echo '<strong><br/>Simpatizante sin Lider: '.$cedula_simpatizante.' - '.$nombre_simpartizante.'<br/></strong>';	
												$datosinvalidos++;
												//insertar los simpatizantes con datos incompletos o sin lideres
												
											}	
										}else{
											//echo '<strong><br/>Imposible crear el registro<br/></strong>';
											//mandarlo a la tabla de invalidos
											$registro_bueno="Imposible crear el registro";
											$datosinvalidos++;											
										}
									}								
								}else{
									//echo "<strong><br/>Problemas con el Puesto de Votacion ".$PUESTO_R." - ".$cedula_simpatizante."<br/><br/></strong>";
									if(count($puestosvotacion)==0){
										$sql="select NOMBRE_PUESTO from puestos_votacion where upper(NOMBRE_PUESTO) like upper('%".trim($PUESTO_R)."%') and idmunicipio='".$dtomunicipios[0]['ID']."' "; //echo $sql;
										$DBGestion->Consulta($sql);
										$puestoexiste=$DBGestion->datos;
										if(empty($puestoexiste)){
											$sql="INSERT INTO puestos_votacion (NOMBRE_PUESTO, MESAS, IDMUNICIPIO) VALUES ('".strtoupper(trim($PUESTO_R))."','".trim($MESA_R)."','".$dtomunicipios[0]['ID']."')";	
											//echo $PUESTO_R.' - '.$MESA_R.' - '.$cedula_simpatizante.' - '.$MUNICIPIO;																	
											//echo " SE INGRESO PUESTO DE VOTACION";
											//echo '<br/>';	
											$DBGestion->Consulta($sql);
											$rs = mysql_query("SELECT @@identity AS id");
											if ($row = mysql_fetch_row($rs)) {
												$idpuesto = trim($row[0]);
											}								
											for($k=1;$k<=$MESA_R; $k++){
												$sql="INSERT INTO mesas (IDPUESTO, MESA) VALUES (".$idpuesto.",".$k.")";	
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
												
												$idlider=$idlider;
												if(!empty($idlider)){									
													//INSERTO EL MIEMBRO EN LA TABLA
													$idmesa=$mesavotacion[0]['ID'];
													$sql="SELECT
														puestos_votacion.IDMUNICIPIO							
														FROM
														puestos_votacion										
														where IDPUESTO=".$idpuesto;
													$DBGestion->ConsultaArray($sql);
													$idmunicipiopuesto=$DBGestion->datos;
													
													$sql="INSERT INTO miembros (NOMBRES, CEDULA, MUNICIPIO,TELEFONO,EMAIL, IDPUESTOSVOTACION, IDLIDER, OCUPACION,IDFILE) 
													VALUES ('".strtoupper(trim($nombre_simpartizante))."',".trim($cedula_simpatizante).",".$idmunicipios.",'".$celular."','".$email."',".$idpuesto.",".$idlider.",'".$ocupacion."',".$idfile.")";										
													//echo "Registro ".$i."<br/><br/>".$sql."<br/><br/>";
													$DBGestion->Consulta($sql);									
													$rs = mysql_query("SELECT @@identity AS id");
													if ($row = mysql_fetch_row($rs)) {
													$idmiembro = trim($row[0]);
													}									
													$sql="INSERT INTO mesa_puesto_miembro (IDMESA, MIEMBRO,CANDIDATO) VALUES (".$idmesa.",".$idmiembro.",'".$_SESSION["username"]."')";	
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
													//echo '<strong><br/>Simpatizante sin Lider: '.$cedula_simpatizante.' - '.$nombre_simpartizante.'<br/></strong>';	
													$datosinvalidos++;
													//insertar los simpatizantes con datos incompletos o sin lideres
													$sql="INSERT INTO tmp_miembros (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION,IDFILE) 
													VALUES (".trim($cedula_simpatizante).",'".strtoupper(trim($nombre_simpartizante))."','".$departamento."','".$MUNICIPIO."',".$idlider.",'".$nombre_lider."','".$celular."','".$email."',
													'Simpatizante con lider',". $_SESSION["idcandidato"].",'".$ocupacion."',".$idfile.")";	
													$DBGestion->Consulta($sql);	
													
												}		
											}else{
												//echo '<strong><br/>Imposible crear el registro<br/></strong>';
												//mandarlo a la tabla de invalidos
												$datosinvalidos++;		
												$sql="INSERT INTO tmp_miembros (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION,IDFILE) 
												VALUES (".trim($cedula_simpatizante).",'".strtoupper(trim($nombre_simpartizante))."','".$departamento."','".$MUNICIPIO."',".$idlider.",'".$nombre_lider."','".$celular."','".$email."',
												'Imposible crear el registro',". $_SESSION["idcandidato"].",'".$ocupacion."',".$idfile.")";	
												$registro_bueno="Imposible crear el registro";
												$DBGestion->Consulta($sql);	
											}
										}else{
											//echo '<strong><br/>Imposible crear el registro<br/></strong>';
											//mandarlo a la tabla de invalidos
											$datosinvalidos++;		
											$sql="INSERT INTO tmp_miembros (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION,IDFILE) 
											VALUES (".trim($cedula_simpatizante).",'".strtoupper(trim($nombre_simpartizante))."','".$departamento."','".$MUNICIPIO."',".$idlider.",'".$nombre_lider."','".$celular."','".$email."',
											'Imposible crear el registro',". $_SESSION["idcandidato"].",'".$ocupacion."',".$idfile.")";	
											$registro_bueno="Imposible crear el registro";
											$DBGestion->Consulta($sql);								
										}
									}
								}
							}else{
								//echo "<strong><br/>Problemas con el municipio del Puesto de Votacion ".$MUNICIPIO_R." - ".$cedula_simpatizante."<br/><br/></strong>";
								$datosinvalidos++;
								$sql="INSERT INTO tmp_miembros (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION,IDFILE) 
								VALUES (".trim($cedula_simpatizante).",'".strtoupper(trim($nombre_simpartizante))."','".$departamento."','".$MUNICIPIO."',".$idlider.",'".$nombre_lider."','".$celular."','".$email."',
								'Problemas con el municipio del Puesto de Votacion',". $_SESSION["idcandidato"].",'".$ocupacion."',".$idfile.")";	
							//	echo $sql;
								$DBGestion->Consulta($sql);	
							}
						}else{
							//echo "<strong><br/>Problemas con el departamento del Puesto de Votacion ".$DEPARTAMENTO_R." - ".$cedula_simpatizante."<br/><br/></strong>";
							$datosinvalidos++;
							$sql="INSERT INTO tmp_miembros (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION,IDFILE) 
							VALUES (".trim($cedula_simpatizante).",'".strtoupper(trim($nombre_simpartizante))."','".$departamento."','".$MUNICIPIO."',".$idlider.",'".$nombre_lider."','".$celular."','".$email."',
							'Problemas con el departamento del Puesto de Votacion',". $_SESSION["idcandidato"].",'".$ocupacion."',".$idfile.")";	
							$DBGestion->Consulta($sql);	
						}				
			}else{
				//echo "<strong><br/>Cedula ya existe ".$cedula_simpatizante."<br/><br/></strong>";
				$datosinvalidos++;
				$sql="INSERT INTO tmp_miembros (CEDULA,NOMBRE,DEPARTAMENTO, MUNICIPIO,LIDER,NOMBRE_LIDER,CELULAR1,CORREO1,PUESTO,CANDIDATO,OCUPACION,IDFILE) 
					VALUES (".trim($cedula_simpatizante).",'".strtoupper(trim($nombre_simpartizante))."','".$departamento."','".$MUNICIPIO."',".$idlider.",'".$nombre_lider."','".$celular."','".$email."',
					'Cedula ya existe',". $_SESSION["idcandidato"].",'".$ocupacion."',".$idfile.")";	
				//echo $sql;
				$registro_bueno="Cedula ya existe ";
				$DBGestion->Consulta($sql);			
							
			}	
		}
	$sql="UPDATE upload_file SET DATOSVALIDOOS=(DATOSVALIDOOS+".$datosvalidos.") ,DATOSINVALIDOS=(DATOSINVALIDOS+".$datosinvalidos."), APTOSVOTAR=(APTOSVOTAR+".$aptosvotar."),
		  NOAPTOSVOTAR=(NOAPTOSVOTAR+".$aptosnovotar."),MUERTE=(MUERTE+".$muerte."),DEBEINSCRIBIRSE=(DEBEINSCRIBIRSE+".$debeinscribirse."), PENDIENTE=(PENDIENTE+".$pendiente."),BAJA=(BAJA+".$baja."),
		  DIFERENTEMUNICIPIO=(DIFERENTEMUNICIPIO+".$diferentemunicipio.")  WHERE ID=".$idfile;	
	$DBGestion->Consulta($sql);	
	$sql="UPDATE boletines SET MOVILIZADOS=(MOVILIZADOS+".$datosvalidos.") WHERE CANDIDATO=".$_SESSION["idcandidato"]." AND IDDEPARTAMENTO=1";			
	$DBGestion->Consulta($sql);	
	
	}catch(Exception $e){
		$msg = $ex->getMessage() . $ex->getTraceAsString();
        error_log('ELASTICSEARCH ERROR: ' . $msg);
	}


	return $registro_bueno;
}
?>
	 