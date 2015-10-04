<?php 
header('Content-Type: text/html; charset=ISO-8859-1'); 
include_once "includes/GestionBD.new.class.php";
include_once "consultar_puesto_votacion_registraduria.php";
$DBGestion = new GestionBD('AGENDAMIENTO');	
$cedula= (!empty($_POST['cedula']))? $_POST['cedula']: 0;
$puestoreg=puesto_votacion($cedula);		
		if(!empty($puestoreg['ERROR'])){ ?>
		<h2>Puesto de Votacion</h2>
				<br/>
				<li>
					<label for="departamento_puesto" style="width: 450px;">
						<span class="textRequired"> * </span>
						<?php echo utf8_decode($puestoreg['ERROR']) ?>
					</label>
						
				</li>
				<?php 
		}else{
				$DEPARTAMENTO_R=trim($puestoreg['DEPARTAMENTO']);
				$MUNICIPIO_R=trim($puestoreg['MUNICIPIO']);
				$PUESTO_R=trim($puestoreg['PUESTO']);
				$DIRECCION_R=trim($puestoreg['DIRECCION']);
				$MESA_R=trim($puestoreg['MESA']);
				$FECHA_INSCRIP=trim($puestoreg['FECHA_INSCRIP']);
?>
<h2>Puesto de Votacion</h2>
				<br/>
				<li>
					<label for="departamento_puesto">
						<span class="textRequired"> * </span>
						Departamento
					</label>
						<?php echo $DEPARTAMENTO_R ?>
				</li>
				<li>
					<label for="muncipio2" style="width: 100px;">
							<span class="textRequired"> * </span>
							Municipio
					</label>
					<?php echo $MUNICIPIO_R ?>
							</li>
					<li>
					<label for="puesto" >
						<span class="textRequired"> * </span>
						Puesto de Votacion
					</label>
						<?php echo $PUESTO_R ?>
				</li>			
							<li>
					<label for="password" style="width: 100px;">
						<span class="textRequired"> * </span>
						Mesa
					</label>
						<?php echo $MESA_R ?>
						
				</li>
		<?php } ?>	