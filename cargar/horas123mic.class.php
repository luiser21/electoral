<?php
include_once("../include/form_creation.class.php");
class clase extends form_creation{
	protected $titulo = '';
	protected $texto = '';
	protected $url = '';
	protected $result='';
	protected $tabla='';
	protected $valores = array();
	protected $fallos = array();
	protected $tipo = array();
	protected $destino = array();
	protected $errores = 0;
	public $categoria ='';
	
	function parametros($titulo='',$texto='',$url=''){
		$this->titulo = $titulo;
		$this->texto = $texto;
		$this->url = $url;
	}
	
	function formulario(){
		$form = array();
		$i=0;
		
		$form[$i++][] = $this->create_titulo($this->titulo,'','id="titulo"');
		$form[$i++][] = '<br />';
		$form[$i++][] = $this->create_texto($this->texto,'');
		$form[$i][] = $this->create_texto('archivo:','','id ="campo"');
		$form[$i++][] = $this->create_input('file','archivo','tabla','','','');
		$form[$i++][] = '<br />';
		$form[$i++][] = $this->create_input('submit','cargar','boton','Cargar','','');
		return $this->print_formulario('form','mic',$form,1,$this->url,'enctype="multipart/form-data"','POST');
	}
	
	function validarArchivo($POST=array(),$file=array()){
		if(isset($POST['cargar'])){
			//die;
			//imprimir($file);
			if($file['archivo']['tmp_name'] == ''){
				$fecha = implode(explode("-",date('d-m-Y')));
				$nombre_archivo='horas_123mic/123MIC_'.$fecha.'_sla.xls';
				if (file_exists($nombre_archivo)) {
					//echo "El fichero $nombre_archivo existe";
				} else {
					echo "El fichero $nombre_archivo no existe";
				}
				//echo $fecha;
				//$this->result='No se ha cargado ningun archivo.';
			}
			else{
				$this->tipo = explode(".",$file['archivo']['name']);
				$this->destino = explode("_",$file['archivo']['name']);
				switch(end($this->tipo)){
					case 'xls':
						//var_dump($this->tipo);
						if($this->destino[0] == '123MIC'){
							$this->result = $this->cargarDexonsXls($file);
						}
						else{
							$this->result = $this->cargarXls($file);
						}
					break;
					case 'xlsx':
						if($this->destino[0] == '123MIC'){
							$this->result = $this->cargarDexonsXlsx($file);
						}
						else{
							$this->result = $this->cargarXlsx($file);
						}
					break;
					default:
						$this->result = '<strong style="color:#FF0000">El archivo no es de formato xls o xlsx. Porfavor verifique.</strong>';
					break;
				}
			}
		}
		return $this->result;
	}
//CARGA EL ARCHIVO EN FORMATO XLS
	function cargarXls($archivo){
		require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read(utf8_decode($archivo['archivo']['tmp_name']));
		error_reporting(E_ALL ^ E_NOTICE);
		//var_dump($data->sheets[0]['cells']);
		foreach($data->sheets[0]['cells'] as $c => $v){
			//var_dump($v);
			if ($c != 1 ){
				//var_dump($v);
				if ($this->validarDatos($v)){
					if(isset($v[5]) && isset($v[6])){
						$sql="SELECT id FROM outsourcing WHERE usuario = '{$v[6]}'";
						$this->valores['outsourcing'] = $this->ConsultarSqlDato($sql,'id');
					}
					//echo 'Outsourcing : '.$this->ConsultarSqlDato($sql,'id').'<br />';
					if(isset($v[7])){
						$sql="SELECT id FROM asignacion WHERE ticket_id = '{$v[7]}'";
						$this->valores['asignacion'] = $this->ConsultarSqlDato($sql,'id'); 
					}
					//echo 'Asignacion : '.$this->ConsultarSqlDato($sql,'id').'<br />';
					if(isset($v[11])){
						$sql="SELECT id_especialidad FROM especialidades WHERE especialidad LIKE '{$v[11]}'";
						$this->valores['especialidad'] = $this->ConsultarSqlDato($sql,'id_especialidad');
					}
					//echo 'Especialidad : '.$this->ConsultarSqlDato($sql,'id_especialidad').'<br />';
					if(isset($v[14])){
						$sql="SELECT id FROM jefatura WHERE nombre LIKE '{$v[14]}'";
						$this->valores['jefatura'] = $this->ConsultarSqlDato($sql,'id');
					}
					//echo 'Jefatura : '.$this->ConsultarSqlDato($sql,'id').'<br />';
					$this->valores['fecha_asignacion']=$this->cambiarFecha($v[2],$v[15]);
					$this->valores['fecha_pruebas_internas']=$this->cambiarFecha($v[3],$v[15]);
					if($v['I'] == 'ninguna'){
						$this->valores['observacion'] = ' ';
					}
					var_dump($this->valores);
					if($this->validarDatos($this->valores)){
						//echo $v[1];'<br />';
						$sql = "INSERT INTO entregables (
								actividad,
								fecha_asignacion,
								fecha_pruebas_internas,
								fecha_pruebas_usuario,
								avance,
								outsourcing_id,
								asignacion_id,
								porcentaje_total_act,
								observaciones,
								estado,
								especialidad,
								estimado,
								horasreales,
								jefatura_id)";
						$sql.= "VALUES(
								'".$v[1]."',
								'".$this->valores['fecha_asignacion']."',
								'".$this->valores['fecha_pruebas_internas']."',
								'".$this->valores['fecha_pruebas_usuario']."',
								{$v[4]},
								".$this->valores['outsourcing'].",
								".$this->valores['asignacion'].",
								{$v[8]},
								'{$v[9]}',
								'{$v[10]}',
								".$this->valores['especialidad'].",
								{$v[12]},
								{$v[13]},
								".$this->valores['jefatura'].")";
						echo 'Inserto : <br />'.$sql.'<br />';
						//$this->ConsultarSql($sql);
						if(!$this->resultado){
							return 'Error en la insercion';
						}
					}
					else{
						$this->fallos[$c]=$v;
					}
				}
				else{
					$this->fallos[$c]=$v;
				}				
			}
			else{
				$this->fallos[$c]=$v;
			}
		}
		if(isset($this->fallos)){
			//echo $sql.'<br />';
			$this->tabla.= '<p><h3>Los siguientes registros son incorrectos y no se grabaron :</h3>
					Porfavor verifique las fechas y que los campos esten diligenciados.</p>';
			
			$this->tabla.= $this->print_table($this->fallos,count($this->fallos),true,'','id="fallos"');
		}
		return $this->tabla;
	}
//CARGA EL ARCHIVO EN FORMATO XLSX
	function cargarXlsx($archivo){
		require_once('Excel/PHPExcel.php');
		/** Include path **/
		set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
		/** PHPExcel_IOFactory */
		include 'Excel/PHPExcel/IOFactory.php';
		//echo 'Loading file ',pathinfo($archivo['archivo']['tmp_name'],PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
		try {
			$objPHPExcel = PHPExcel_IOFactory::load($archivo['archivo']['tmp_name']);
		} catch(Exception $e) {
			die('Error cargar al archivo "'.pathinfo($archivo['archivo']['tmp_name'],PATHINFO_BASENAME).'": '.$e->getMessage());
		}
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		//var_dump($sheetData);
		//return  $this->print_table($sheetData,20,true,'','border ="1"','50%');
		foreach($sheetData as $c => $v){
			if ($c != 1){
				//var_dump($v);

				if ($this->validarDatos($v)){
					if(isset($v['E']) || isset($v['F'])){
						$sql = "SELECT id FROM outsourcing WHERE usuario = '{$v['F']}'";
						$this->valores['outsourcing'] = $this->ConsultarSqlDato($sql,'id');
					}
					//echo 'Outsourcing : '.$this->ConsultarSqlDato($sql,'id');
					if(isset($v['G'])){
						$sql = "SELECT id FROM asignacion WHERE ticket_id = '{$v['G']}'";
						$this->valores['asignacion'] = $this->ConsultarSqlDato($sql,'id'); 
					}
					//echo 'Asignacion : '.$this->ConsultarSqlDato($sql,'id');
					if(isset($v['K'])){
						$sql = "SELECT id_especialidad FROM especialidades WHERE especialidad LIKE '{$v['K']}'";
						$this->valores['especialidad'] = $this->ConsultarSqlDato($sql,'id_especialidad');
					}
					//echo 'Especialidad : '.$this->ConsultarSqlDato($sql,'id_especialidad');
					if(isset($v['N'])){
						$sql = "SELECT id FROM jefatura WHERE nombre LIKE '{$v['N']}'";
						$this->valores['jefatura'] = $this->ConsultarSqlDato($sql,'id');
					}
					//echo 'Jefatura : '.$this->ConsultarSqlDato($sql,'id');
					if(isset($v['B']) && isset($v['O']) && isset($v['C'])){
						$this->valores['fecha_asignacion']=$this->cambiarFecha($v['B'],$v['O']);
						$this->valores['fecha_pruebas_internas']=$this->cambiarFecha($v['C'],$v['O']);
					}
					if(isset($v['I'])){
						if($v['I'] == 'ninguna'){
							$this->valores['observacion'] = ' ';
						}
					}
					//var_dump($this->valores);
					//var_dump($v);
					if($this->validarDatos($this->valores)){
						$sql = "INSERT INTO entregables (
								actividad,
								fecha_asignacion,
								fecha_pruebas_internas,
								fecha_pruebas_usuario,
								avance,
								outsourcing_id,
								asignacion_id,
								porcentaje_total_act,
								observaciones,
								estado,
								especialidad,
								estimado,
								horasreales,
								jefatura_id)";
						$sql.= " VALUES(
								'{$v['A']}',
								'".@$this->valores['fecha_asignacion']."',
								'".@$this->valores['fecha_pruebas_internas']."',
								'".@$this->valores['fecha_pruebas_usuario']."',
								{$v['D']},
								".@$this->valores['outsourcing'].",
								".@$this->valores['asignacion'].",
								{$v['H']},
								'".@$this->valores['observacion']."',
								'{$v['J']}',
								".@$this->valores['especialidad'].",
								{$v['L']},
								{$v['M']},
								".@$this->valores['jefatura'].")";
						echo 'Inserto : <br />'.$sql.'<br />';
						//$this->ConsultarSql($sql);
						if(!$this->resultado){
							return 'Error en la insercion';
						}
					}
					else{
						$this->fallos[$c]=$v;
						$this->errores++;
					}
				}
				else{
					$this->fallos[$c]=$v;
					$this->errores++;
				}				
			}
			else{
				if ($c == 1){
					//echo $c.'<br />';
					$this->fallos[$c]=$v;
				}
			}
		}
		if(isset($this->fallos)){
			$this->tabla.= '<p><h3>Los siguientes registros son incorrectos y no se grabaron :</h3>
					Porfavor verifique las fechas y que los campos esten diligenciados. Numero de registros '.$this->errores.'</p>';
			$this->tabla.= $this->print_table($this->fallos,count($this->fallos),true,'','id="fallos"');
		}
		return $this->tabla;
	}
//SE CREAN LAS FUNCIONES PARA CARGAR LOS DEXON 
//
//fUNCION PARA ARCHIVOS XLS
	function cargarDexonsXls($archivo=array()){
		require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		if (!empty($archivo)){
			$data->read($archivo['archivo']['tmp_name']);
		}
		else{
			$data->read('');
		}
		error_reporting(E_ALL ^ E_NOTICE);
		//var_dump($data->sheets[0]['cells']);
		foreach($data->sheets[0]['cells'] as $c => $v){
			//var_dump($v);
			if ($c != 1 ){
				//var_dump($v);
				$this->categoria = explode(':',$v[10]);
				if($this->validarDatos($v)){
					$sql = '';
					//echo $categoria[0];
					switch($this->categoria[0]){
						case 'Incidente':
							$sql = "INSERT INTO incidente_log ";
							
						break;
						case 'Solicitud':
							$sql = "INSERT INTO requerimiento_log ";
						break;
					}
					$sql.= "(SOLICITUD,
							INTERACCION,
							ESTADO,
							ID_USU_AFECTADO,
							NOM_USU_AFECTADO,
							GRUPO_ASIGNACION,
							ID_ASIGNATARIO,
							ASIGNATARIO,
							TIPO,
							FECHA_APERTURA,
							NOMBRE_SLO,
							FECHA_VENCIMIENTO)
							VALUES(
							'".$v[1]."',
							'".$v[2]."',
							'".$v[3]."',
							'".$v[5]."',
							'".$v[6]."',
							'".$v[7]."',
							'".$v[8]."',
							'".$v[9]."',
							'".$v[10]."/".$v[11]."/".$v[12]."/".$v[13]."/".$v[14]."',
							'".$this->cambiarFecha($v[20],'123MIC')."',
							'".$v[39]."',
							'".$this->cambiarFecha($v[40],'123MIC')."')";
					$this->ConsultarSql($sql);
					//echo $sql.'<br />';
					if(!$this->resultado){
						//var_dump($this->resultado);
						echo 'Error en la insercion fila '.($c-1).'<br />';
					}
				}
			}
			else{
				$this->fallos[$c] = $v;
			}
		}
		if(isset($this->fallos)){
			//echo $sql.'<br />';
			$this->tabla.= '<p><h3>Los siguientes registros son incorrectos y no se grabaron :</h3>
					Porfavor verifique las fechas y que los campos esten diligenciados.</p>';
			
			$this->tabla.= $this->print_table($this->fallos,count($this->fallos),true,'','id="fallos"');
		}
		return $this->tabla;
	}
//CAMBIA EL FORMATO DE LA FECHA Y LA VALIDA
	function cambiarFecha($dato="",$nombre=""){
		setlocale(LC_TIME,'Spanish');
		$fecha = '';
		$bool = false;
		$F = array();
		$mes = date('m');
		if($dato != ""){
			$F = explode('/',$dato);
		}
		$fecha =date('Y-m-d', strtotime(($F[2].'-'.$F[1].'-'.$F[0]).' - 1 day'));
		if($nombre == '123MIC'){
			$bool = checkdate($F[0],$F[1],$F[2]);
			if(!$bool == true){
				return false;
				//$fecha = $F[2].'-'.$F[1].'-'.$F[0];
				//$fecha = date('Y-m-d', strtotime($fecha.' - 1 day'));
			}
		}
		else{
			if($F[1]>=$mes){				
				//$fecha = $F[2].'-'.$F[1].'-'.$F[0];
				//$fecha = date('Y-m-d', strtotime($fecha.' - 1 day'));
				if($mes == date('m', strtotime($fecha.' + 3 day'))){
					$this->valores['fecha_pruebas_usuario'] = date("Y-m-d", strtotime($fecha.' + 3 day'));
				}
				else{
					$this->valores['fecha_pruebas_usuario'] = $fecha;
				}
			}
			else{
				$this->valores['fecha_pruebas_usuario'] = '';
			}
		}
		//echo $fecha;
		return $fecha;
	}
//VALIDAN QUE LOS CAMPOS DEL EXCEL ESTEN CON DATOS
	function validarDatos($dato=array()){
		$bool=true;
		foreach($dato as $c){
			if ($c == '' && $this->destino[0] != "123MIC"){
				//echo 'variable :'.$c.'<br />';
				$bool = false;
			}
		}
		if ($this->categoria[0] == 'Solicitud'){
			$sql = "SELECT * FROM requerimiento_log WHERE solicitud = '{$dato[1]}' and interaccion = '{$dato[2]}'";
			$this->resultado = $this->ConsultarSql($sql);
			//var_dump($this->resultado);
			//echo $sql;
			if(!empty($this->resultado)){
				$bool = false;
				//var_dump($bool);
			}
		}
		else{
			$sql = "SELECT * FROM incidente_log WHERE solicitud = '{$dato[1]}' and interaccion = '{$dato[2]}'";
			$this->resultado = $this->ConsultarSql($sql);
			//echo $sql;
			//var_dump($this->resultado);
			if(!empty($this->resultado)){
				$bool = false;
				//var_dump($bool);
			}
		}
		return $bool;
	}
}
?>