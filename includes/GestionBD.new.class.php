<?php
include_once "ConfigDB.ini.php";
include_once "funciones.inc.php";
set_time_limit(0);

class GestionBD{
	private $servidor;
	private $usuario;
	private $basedatos;
	private $pass;
	public $TipoDB;
	public $db;
	public $datos;
	public $filas;
	public $NumColumnas;
	public $NomColumnas;
	public $TipoColumnas;
	public $TamColumnas;
	public $NumFilas;
	public $IdConexion;
	public $resultado;
	public $fila_actual;
	public $Ultima_Consulta;
	public $vistas;
	public $Error;

	public function GestionBD($TipoDB, $database = ""){
		$this->servidor = "localhost";
		$this->usuario = "root";
		$this->basedatos = "";
		$this->db = "electoral";
		$this->pass = "";
		$this->datos = array();
		$this->filas = array();
		$this->NumColumnas = 0;
		$this->NomColumnas = array();
		$this->TipoColumnas = array();
		$this->TamColumnas = array();
		$this->NumFilas = 0;
		$this->IdConexion = 0;
		$this->resultado = 0;
		$this->fila_actual = 0;
		$this->Ultima_Consulta = "";
		$this->vistas ="";
		$this->TipoDB = $TipoDB;
		$this->SeleccionBD($TipoDB);
		$this->InicializarBD($TipoDB, $database);
		$this->GuardaLog();
	}

	protected function SeleccionBD($TipoDB)
		{
			$BasesDatos = XML2Array(BASESDEDATOS);
		//date_default_timezone_set('America/Bogota');		
				$this->basedatos = 'MYSQL';
				$this->servidor = 'localhost';
				$this->usuario = 'root';
				$this->pass = '';			
			
		}
	protected function InicializarBD($TipoDB, $db = ""){
		global $Permisos;
		if(!@$Permisos){
			$Permisos["IDUSUARIO"] = 'NOCOOKIE';
		}
		//imprimir($this);
		set_time_limit(0);
		$this->db = 'electoral';
			switch ($this->basedatos)
			{
				case "MYSQL":
					if(!$this->IdConexion = @mysql_connect($this->servidor,$this->usuario,$this->pass)){
						//$err = OCIError();
						throw new Exception('CONEXION MYSQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | '.$err['message']. ' | Inicializando | '. $this->Ultima_Consulta );
						echo $this->Ultima_Consulta;
					}

					if(!@mysql_select_db($this->db,$this->IdConexion)){
						//$err = OCIError();
						throw new Exception('CONEXION A LA BASE '.$this->db.' EN MYSQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | '.$err['message']. ' | Inicializando | '. $this->Ultima_Consulta );
						echo $this->Ultima_Consulta;
					}

				break;

				case "ORACLE":
					if(!$this->IdConexion = @OCILogon($this->usuario,$this->pass,$this->servidor)){
						$err = OCIError();
						throw new Exception('CONEXION ORACLE NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | '.$err['message']. ' | Inicializando | '. $this->Ultima_Consulta );
						#echo $this->Ultima_Consulta;
					}else {
						$Res = OCIParse($this->IdConexion,"Begin dbms_application_info.set_client_info ('".$Permisos["IDUSUARIO"]. "'); end;");
						OCIExecute($Res);
					}
					
				break;

				case "ORACLE5":
					if(!$this->IdConexion = @oci_connect($this->usuario,$this->pass,$this->servidor)){
						$err = oci_error();
						throw new Exception('CONEXION ORACLE5 NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | '.$err['message']. ' | Inicializando | '. $this->Ultima_Consulta );
						#echo $this->Ultima_Consulta;
					}else {
						$Res = oci_parse($this->IdConexion,"Begin dbms_application_info.set_client_info ('".$Permisos["IDUSUARIO"]. "'); end;");
						oci_execute($Res);
					}
					
				break;

				case "ODBC":
				
						if(!$this->IdConexion = @odbc_connect($this->servidor,$this->usuario,$this->pass)){
							$err = odbc_errormsg();
							throw new Exception('TRANSACCION ODBC NO DISPONIBLE CONEXION, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | '.$err['message']. ' | Inicializando | '. $this->Ultima_Consulta );
							#echo $this->Ultima_Consulta;
						}
				break;
			}#switch
	}#f_conectar


	public function CerrarConexion(){

		switch ($this->basedatos){
			case 'MYSQL':
				$this->IdConexion = 0;
				//echo $this->IdConexion;
				mysql_close($this->IdConexion);
			break;

			case 'ORACLE':
				OCILogOff($this->IdConexion);
			break;

			case 'ORACLE5':
				oci_close($this->IdConexion);
			break;

			case 'ODBC':
				odbc_close($this->IdConexion);
	//			odbc_free_result($this->IdConexion);
			break;
		}

		$this->IdConexion = 0;

	}#fin de la función cerrar

	public function CalcularParametros($p_sql)
	{
		if ( strstr($this->Ultima_Consulta,'SELECT') )
		{
			switch ($this->basedatos)
			{
				case 'MYSQL':
					$this->NumColumnas=mysql_num_fields($this->resultado);
					$this->NumFilas=mysql_num_rows($this->resultado);
					if ( strstr($p_sql,'SELECT') )
					{
						for ( $n=1;$n<=$this->NumFilas;$n++ )
						{
							$row = mysql_fetch_row($this->resultado);

							for ( $x=1;$x<=mysql_num_fields($this->resultado);$x++ )
							{
								$this->NomColumnas[$x]=mysql_field_name($this->resultado,$x-1);
								$this->TipoColumnas[$x]=mysql_field_type($this->resultado,$x-1);
								$this->TamColumnas[$x]=mysql_field_len($this->resultado,$x-1);

								$this->filas[$this->NomColumnas[$x]][$n]=$row[$x-1];
							}
						}
					}
					break; //fin de case:'mysql'
				case 'ORACLE':
					$this->NumColumnas=OCINumCols($this->resultado);
					$this->NumFilas=OCIRowCount($this->resultado);
					if ( OCIStatementType($this->resultado)=='SELECT' )
					{
						for ( $n=1;$n<=$this->NumColumnas;$n++ )
						{
							$this->NomColumnas[$n]=OCIColumnName($this->resultado,$n);
							$this->TipoColumnas[$n]=OCIColumnType($this->resultado,$n);
							$this->TamColumnas[$n]=OCIColumnSize($this->resultado,$n);
						}

						if ( $this->NumFilas > 0 )
						{
							return true;
						}else{
							return false;
						}
					} //fin de if OCIStatement == 'SELECT' (Si el tipo de sentencia SQL es una SELECT).
					break; //fin de case:'oracle'

				case 'ORACLE5':
						$this->NumColumnas = oci_num_fields($this->resultado);
						$this->NumFilas = oci_num_rows($this->resultado);
						if ( oci_statement_type($this->resultado)=='SELECT' )
						{
							for ( $n=1;$n<=$this->NumColumnas;$n++ )
							{
								$this->NomColumnas[$n]=oci_field_name($this->resultado,$n);
								$this->TipoColumnas[$n]=oci_field_type($this->resultado,$n);
								$this->TamColumnas[$n]=oci_field_size($this->resultado,$n);
							}
	//						$this->NumFilas = oci_fetch_all($this->resultado,$this->filas);
							if ( $this->NumFilas > 0 ) {
								return true;
							}else{
								return false;
							}
						}
					break;
			}
		}
	}

	public function sqlInsertLOB($p_sql,$CAMPO,$LOB){
		$this->Ultima_Consulta = $p_sql;
		$sqlLOB = $p_sql." RETURNING $CAMPO INTO :".$CAMPO."_loc "; 
		switch ($this->basedatos){
			case 'MYSQL':
				throw new Exception('ESTA FUNCION NO CUBRE INSERCIONES EN MYSQL.');
			break;

			case 'ORACLE':
				if(!$this->resultado = @OCIParse($this->IdConexion,$sqlLOB)) {
					$err = oci_error($this->IdConexion);
					throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION SQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
//					echo $this->Ultima_Consulta;
				}
				$myLOB = ocinewdescriptor($this->IdConexion, OCI_D_LOB);
				
				ocibindbyname($this->resultado, "".$CAMPO."_loc", $myLOB, -1, OCI_B_CLOB);
				
				OCIExecute($this->resultado, OCI_DEFAULT) or die ('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION EXE NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
				#echo $this->Ultima_Consulta;
				// Now save a value to the LOB
				
				if (!$myLOB->save($LOB)) {
				    // On error, rollback the transaction
				    ocirollback($this->IdConexion);
				} else {
				    // On success, commit the transaction
				    ocicommit($this->IdConexion);
				}
				// Free resources
				ocifreestatement($this->resultado);
				$myLOB->free();
			break; //fin de case:'oracle'

			case 'ORACLE5':
				if(!$this->resultado = @oci_parse($this->IdConexion,$sqlLOB)) {
					$err = oci_error($this->IdConexion);
					throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION SQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
//					echo $this->Ultima_Consulta;
				}
				$myLOB = oci_new_descriptor($this->IdConexion, OCI_D_LOB);
				
				oci_bind_by_name($this->resultado, "".$CAMPO."_loc", $myLOB, -1, OCI_B_CLOB);
				
				oci_execute($this->resultado, OCI_DEFAULT) or die ('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION EXE NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
				#echo $this->Ultima_Consulta;
				// Now save a value to the LOB
				
				if (!$myLOB->save($LOB)) {
				    // On error, rollback the transaction
				    oci_rollback($this->IdConexion);
				} else {
				    // On success, commit the transaction
				    oci_commit($this->IdConexion);
				}
				// Free resources
				oci_free_statement($this->resultado);
				$myLOB->free();
			break;

			case 'ODBC':
					throw new Exception('ESTA FUNCION NO CUBRE INSERCIONES EN ODBC.');
			break;

		} //fin de switch $basedatos
		$this->CalcularParametros($p_sql);

	}//fin de funcion Consulta

	public function Consulta($p_sql){
		$this->Ultima_Consulta = $p_sql;
		
		switch ($this->basedatos){
			case 'MYSQL':
				$this->resultado = mysql_query($p_sql,$this->IdConexion) or die (mysql_error());
			break;

			case 'ORACLE':
				if(!$this->resultado = @OCIParse($this->IdConexion,$p_sql)) {
						$err = oci_error($this->IdConexion);
						throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION SQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
						#echo $this->Ultima_Consulta;
				}
					if(!@OCIExecute($this->resultado)) {
						$err = oci_error($this->resultado);
						throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION EXE NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
						#echo $this->Ultima_Consulta;
					}

//				$this->NumColumnas=OCINumCols($this->resultado);
//				$this->NumFilas=OCIRowCount($this->resultado);

			break; //fin de case:'oracle'

			case 'ORACLE5':

					if(!$this->resultado = @oci_parse($this->IdConexion,$p_sql)) {
						$err = oci_error($this->IdConexion);
						throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION SQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
//						echo $this->Ultima_Consulta;

					}
					if(!@oci_execute($this->resultado)) {
						$err = oci_error($this->resultado);
						throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION EXECSQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
//						echo $this->Ultima_Consulta;
					}
					$this->NumColumnas = oci_num_fields($this->resultado);
					$this->NumFilas = oci_num_rows($this->resultado);
			break;

			case 'ODBC':
					set_time_limit(0);
					
					#PARA DESARROLLO UNICAMENTE
//					if($this->TipoDB <> 'AS400PRD' && $this->TipoDB <> 'AS400TMP'){
//						$p_sql = str_replace(' CABLEDTA.',CDATALIB,$p_sql);
//						$p_sql = str_replace(' TVCABLEDTA.',TVCDTALIB,$p_sql);
//					}
					
					$this->Ultima_Consulta = $p_sql;
					$this->resultado = odbc_do($this->IdConexion,$p_sql) or die(exit("Problemas Con la Conexion\n".$p_sql."\n"));
					
					if ( !$this->resultado ) {
						$error = odbc_error($this->resultado);
						echo "Se ha Producido un Error: ".$error['messsage'].'<br>';
						exit;
					}
					$this->NumColumnas = odbc_num_fields($this->resultado);
					$this->NumFilas = odbc_num_rows($this->resultado);
			break;

		} //fin de switch $basedatos
		$this->CalcularParametros($p_sql);

	}//fin de funcion Consulta

	public function ConsultaArray($p_sql){
		//echo "<br>".$p_sql;
		#PARA DESARROLLO UNICAMENTE
		$p_sql = str_replace('..','.',$p_sql);
		
		$this->Ultima_Consulta = $p_sql;
		$this->datos = array();
		$row = array();
			
		switch ($this->basedatos){
			case 'MYSQL':
			
				$this->resultado = mysql_query($p_sql,$this->IdConexion) or die (mysql_error());

			if ( strstr($p_sql,'SELECT') ) {
			
		//	echo "<br>Ejecutando Consulta a Array..";

				 while($row = mysql_fetch_assoc($this->resultado)) {
						$this->datos[] = $row;
				 }
			//imprimir($this->datos);
			} // Fin if StrStr('SELECT') si la consulta es de tipo select

			break;

			case 'ORACLE':

				if(!$this->resultado = @OCIParse($this->IdConexion,$p_sql)) {
						$err = OCIError($this->IdConexion);
						throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION SQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. |' . $err['message'].'|'.$this->Ultima_Consulta);
						#echo $this->Ultima_Consulta;
					}else if(!@OCIExecute($this->resultado,OCI_COMMIT_ON_SUCCESS)) {
						$err = OCIError($this->resultado);
						throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION EXE NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
						#echo $this->Ultima_Consulta;
					}
					while (OCIFetchInto($this->resultado,$row,OCI_ASSOC+OCI_RETURN_NULLS))
					{
						 $this->datos[]  = $row;
					}
			break; //fin de case:'oracle'

			case 'ORACLE5':

				if(!$this->resultado = oci_parse($this->IdConexion,$p_sql)) {
						$err = oci_error($this->IdConexion);
						throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION SQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. |' . $err['message'].'|'.$this->Ultima_Consulta);
						#echo $this->Ultima_Consulta;
					}else if(!@oci_execute($this->resultado,OCI_COMMIT_ON_SUCCESS)) {
						$err = oci_error($this->resultado);
						throw new Exception('ERROR EN SQL: <br><br>'.$p_sql.'<BR>TRANSACCION EXESQL NO DISPONIBLE, FAVOR CONSULTAR CON EL ADMINISTRADOR DEL SISTEMA.. | ' . $err['message'].'|'.$this->Ultima_Consulta);
						#echo $this->Ultima_Consulta;
					}

					while($row = oci_fetch_assoc($this->resultado)) {

						 $this->datos[]  = $row;
					}
			break;

			case 'ODBC':
					set_time_limit (0);
					
					#PARA DESARROLLO UNICAMENTE
//					if($this->TipoDB <> 'AS400PRD' && $this->TipoDB <> 'AS400TMP'){
//						$p_sql = str_replace(' TVCABLEDTA.',TVCDTALIB,$p_sql);
//						$p_sql = str_replace(' CABLEDTA.',CDATALIB,$p_sql);
//					}
					
					$this->Ultima_Consulta = $p_sql;
					$this->resultado = odbc_do($this->IdConexion,$p_sql) or die(exit("Problemas Con la Conexion\n".$p_sql."\n"));
					if ( !$this->resultado ) {
						$error = odbc_error($this->resultado);
						echo "Se ha Producido un Error: ".$error['messsage'].'<br>';
						exit;
					}
					while($row = odbc_fetch_array($this->resultado)){
						$this->datos[] = $row;
					}
			break;
		} //fin de switch $basedatos
		$this->CalcularParametros($p_sql);
	}//fin de funcion Consulta

	public function ConsultaFila(){

	set_time_limit (0);

		$row = array();

		switch ($this->basedatos){
			case 'MYSQL':
					if ( strstr($p_sql,'SELECT') ) {
						 if($row = mysql_fetch_assoc($this->resultado)) {
								$this->fila_actual = $row;
								return $this->fila_actual;
							} else {
								$this->fila_actual = false;
								return $this->fila_actual;
							}
					} // Fin if StrStr('SELECT') si la consulta es de tipo select
					break;

			case 'ORACLE':
					if (OCIFetchInto($this->resultado,$row,OCI_ASSOC+OCI_RETURN_NULLS))
					{
						$this->fila_actual = $row;
						return $this->fila_actual;
					} else {
						$this->fila_actual = false;
						return $this->fila_actual;
					}
					break; //fin de case:'oracle'

			case 'ORACLE5':
					if($row = oci_fetch_assoc($this->resultado)) {
						$this->fila_actual = $row;
						return $this->fila_actual;
					} else {
						$this->fila_actual = false;
						return $this->fila_actual;
					}
					break;
			case 'ODBC':
					set_time_limit(30);
					if($row = odbc_fetch_array($this->resultado)){
						$this->fila_actual = $row;
						return $this->fila_actual;
					} else {
						$this->fila_actual = false;
						return $this->fila_actual;
					}
					break;
		} //fin de switch $basedatos
		$this->CalcularParametros();
	}//fin de funcion Consulta por Fila

	public function TraeCampo($row,$campo){
		if(isset($this->datos[$row][$campo])){
			return $this->datos[$row][$campo];
		}else{
			return "";
		}
	}

	public function BuscaCampoArray($campo){
		if(count($this->datos) > 1 || !is_array($this->datos) ){
			echo "<br>No es Posible Retornar El Campo [" .$campo. "] porque Existe Cero mas de Un Registro(S) en el Array...";
			return null;
		}else{
			if(array_key_exists($campo,$this->datos[0])){
				return $this->datos[0][$campo];
			}else{
				echo "<br>No es Posible Retornar El Campo [" .$campo. "] porque no Existe en Array..";
				return null;
			}
		}
	}

	public function ImprimirTabla($p_sql){

		$border=1;
		$cellspacing=0;
		$cellpading=2;
			if ($p_sql!=""){ $this->Consulta($p_sql); }
				echo '<table border="'.$border.'" cellspacing="'.$cellspacing.'" cellpadding="'.$cellpading.'" class="tmain">';
				echo '<tr bgcolor="silver">';
						for ($x=1;$x<=$this->NumColumnas;$x++){
						echo '<td>'.$this->NomColumnas[$x].'</td>';
					}
				echo '</tr>';

				$n=0;

				while ($n<=$this->NumFilas-1){
						echo'<tr>';
							for ($x=1;$x<=$this->NumColumnas;$x++){
								echo '<td>'.$this->filas[$this->NomColumnas[$x]][$n].'</td>';
							}
						echo '</tr>';
						$n++;
				}

		echo'</table>';
	}#fin de funcion ImprimirTabla()
	
	protected function logChange(){
		global $Permisos;
		#VALIDA LA AUTENTICACION DESDE LA COOKIE EN CASO DE NO ENCONTRAR USUARIO
		$MODULO= @$MODULO?$MODULO:'NO ESPESIFICADO';
		if(function_exists('AtenticacionUsuario')){
			if(!@$USER){
				if (!@$Permisos){
					$Permisos = AtenticacionUsuario(1);
				}
				$USER = $Permisos['IDUSUARIO'];
			}else {
				$USER = $USER;
			}
		}else{
			include_once(ROOT."Checksession.php");
			$Permisos = AtenticacionUsuario(1);
			$USER = $Permisos['IDUSUARIO'];
		}
		
		#CAPTURA DEL ARCHIVO DE ORIGEN
		$PAGE = @$PAGE?$PAGE:@$_SERVER['PHP_SELF'];
		$PAGE = @$PAGE?$PAGE:@$_SERVER['SCRIPT_NAME'];
		
		#CAPTURA DEL SERVIDOR DE ORIGEN
		$SERV = @$SERV?$SERV:@$_SERVER['HTTP_HOST'];
		$SERV = @$SERV?$SERV:@$_SERVER['SERVER_NAME'];
		
		#CAPTURA DEL SERVIDOR REMOTO
		if ($REMOTO = @$_SERVER['REMOTE_ADDR']){
		}elseif($REMOTO = @$_SERVER['REMOTE_HOST']){
		}else {
			$REMOTO = 'NO ENCONTRADO';
		}
		
		
		$SQL = strtoupper(FixQuery(@$this->Ultima_Consulta));
		
		#DISCRIMINACION DE CAMBIOS
		if ((strpbrk('MERGE',$SQL) || strpbrk('INSERT',$SQL) || strpbrk('UPDATE',$SQL) || 
		 strpbrk('DELETE',$SQL) || strpbrk('CREATE',$SQL) || strpbrk('TRUNCATE',$SQL)) && @$SQL) {
			$SESSION = 'SELECT SID FROM V$SESSION WHERE AUDSID = USERENV(\'SESSIONID\')';
//			echo "<br>$SESSION<br>";
			$this->ConsultaArray($SESSION);
			$IDSESSION = $this->TraeCampo(0,'SID');
//			echo "<br>IDSESSION = $IDSESSION<br>";
			$LOG = "INSERT INTO AUDITORIA_LOG_CHANGES
			(ID_USUARIO, SESSION_ID, SCRIPT_ORIGEN, SERVIDOR_ORIGEN, FECHA, CLIENTE,MODULO)
			VALUES
			('$USER',$IDSESSION,'$PAGE','$SERV',SYSDATE,'$REMOTO','$MODULO')";
//			echo "<br>$LOG<br>";
			$this->Consulta($LOG);
			$this->Commit();
		 	/** /
			#FORMATEO DEL SQL
			$SQL = http_deflate($SQL,HTTP_DEFLATE_LEVEL_MAX);
			$SQL =rawurlencode($SQL);
			
			$LOG = "INSERT INTO LOG_CHANGES
			(USUARIO, SQL, PAGINA, SERVIDOR, REMOTO, FECHA)
			VALUES
			('$USER',EMPTY_CLOB(),'$PAGE','$SERV','$REMOTO',SYSDATE)";
			$this->sqlInsertLOB($LOG,'SQL',$SQL);
			$this->Commit();
//			echo "<br>LOG:<br>$LOG<br>";
			/**/
		}
	}
	
	public function Commit(){

		switch ($this->basedatos) {
			case 'MYSQL':
				echo 'LA FUNCION COMMIT NO ES SOPORTADA POR MYSQL....';
			break;

			case 'ORACLE':
				OCICommit($this->IdConexion);
			break;

			case 'ORACLE5':
				oci_commit($this->IdConexion);
			break;

		} #fin switch

	}#Fin de la funcion

	public function Rollback(){
		switch ($this->basedatos) {
			case 'MYSQL':
				echo 'LA FUNCION ROLLBACK NO ES SOPORTADA POR MYSQL....';
			break;

			case 'ORACLE':
				OCIRollback($this->IdConexion);
			break;

			case 'ORACLE5':
				oci_rollback($this->IdConexion);
			break;
		}#fin switch
	}#fin de funcion

	public function GuardaLog() {
		
		global $Permisos;
		$IdUsuario = (@$Permisos["IDUSUARIO"]) ? $Permisos["IDUSUARIO"] : "0";
		$SQLGuardaLog = "BEGIN ALMACENAR_LOG(".$IdUsuario."); END;";
		switch ($this->basedatos) {
			case 'ORACLE':

			break;
			case 'ORACLE5':
				$GLog = oci_parse($this->IdConexion,$SQLGuardaLog);
				oci_execute($GLog);
			break;
		}#fin switch
	}#fin de funcion

	function __destruct() {
		if ($this->IdConexion != 0)
		{
			switch ($this->basedatos){
				case 'MYSQL':
					$this->IdConexion = 0;
					//echo $this->IdConexion;
					//mysql_close($this->IdConexion);
				break;

				case 'ORACLE':
					OCILogOff($this->IdConexion);
				break;

				case 'ORACLE5':
					oci_close($this->IdConexion);
				break;

				case 'ODBC':
					odbc_close($this->IdConexion);
		//			odbc_free_result($this->IdConexion);
				break;
			} #fin switch
		}
	}#fin de funcion

}#fin de class


function Redireccionar(){
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'gestion/problemas_conexion.php?bdgestion=1';
	header("Location: http://$host/$extra");
	exit;
}

function ValidaConexion($Conexion)
{
	if (isset($Conexion))
	{
		if(is_object($Conexion))
		{
			if ($Conexion->IdConexion == 0)
			{
				return false;
			}
		} else {
				return false;
		}
	} else {
		return false;
	}
	return true;
}

function scriptCheckin($forcelog=0,$txt = ''){
	$Raiz = str_replace($_SERVER['PHP_SELF'],'',str_replace('\\','/',$_SERVER['SCRIPT_FILENAME']));
	global $Permisos;
	global $DBGestion;
	if(!@$Permisos){
		if(function_exists('AtenticacionUsuario')){
			$Permisos = AtenticacionUsuario(1);
		}else {
			if($forcelog){
				include_once($Raiz."/Checksession.php");
				$Permisos = AtenticacionUsuario(1);
			}
		}
	}
	$txt = substr(rawurlencode($txt),0);
	$USUARIO = !@$Permisos?'DESCONOCIDO':@$Permisos['IDUSUARIO'];
	$SCRIPT = @$_SERVER['PHP_SELF']?@$_SERVER['PHP_SELF']:__FILE__;
	$SERVIDOR = @$_SERVER['HTTP_HOST']?@$_SERVER['HTTP_HOST']:@$SERVER['LOCAL_ADDR'];
	$REMOTEHOST = gethostbyaddr(@$_SERVER['REMOTE_HOST']);
	$REMOTEADDR = @$_SERVER['REMOTE_ADDR'];
	if(!function_exists('ValidaConexion')){
		include_once($Raiz."../includes/GestionBD.new.class.php");
	}
	if(!ValidaConexion(@$DBGestion )){ 
		 $DBGestion = new GestionBD("AGENDAMIENTO");
	}
	$LOG = "INSERT INTO SCRIPT_CHECKIN 
	(USUARIO, SCRIPT, SERVER, REMOTEHOST, REMOTEADDR, CHECKTIME,TEXTOESP) 
	VALUES 
	('$USUARIO','$SCRIPT','$SERVIDOR','$REMOTEHOST','$REMOTEADDR',SYSDATE,'$txt')";
	$DBGestion->Consulta($LOG);
	$DBGestion->Commit();
}

?>