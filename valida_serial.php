<?php
/**
 * serial
 *
 * @package
 * @author Antonio Gil
 * @copyright Claro fijo
 * @version 2013
 * @access public
 */
$Raiz = str_replace($_SERVER['PHP_SELF'],'',str_replace('\\','/',$_SERVER['SCRIPT_FILENAME']));
include_once($Raiz."/include/ConfgGral.conf.php");
include_once(INCLUDES."GestionBD.new.class.php");
include_once(INCLUDES."nusoap.php");
include_once ($Raiz."/WebServices/webservice.Config.php");
/**
 * Class[serial]: Consulta el serial para realizar su consumo en cpes.
 */
class serial extends GestionBD
{
    public $resultadoO = array();
    public $resultadoS = array();
    private $urlWs = array();
    private $clienWs;

    /**
     * serial::__contruct()
     *
     * @return NULL
     */
    public function __contruct($tipo = 'AS400')
    {
       parent::GestionBD($tipo);
       $this->cargaWs();
    }

    public function cargaWs()
    {
        $this->urlWs = traerWS('WSSERIAL');
        
        //$this->clienWs = new SoapClient ( $this->urlWs['WEBSERVICES'], array('style'    =>  SOAP_DOCUMENT,'use' =>  SOAP_LITERAL));
        $this->clienWs = new SoapClient ( "http://192.168.253.246:7001/ControlOperaciones/wsserial?wsdl", array('style'    =>  SOAP_DOCUMENT,'use' =>  SOAP_LITERAL));
    }

    /**
     * [AsocOrder Consulta seriales ingresados por ot y por cuenta]
     * @param [type] $ot     [Orden de trabajo asociada al cambio]
     * @param [type] $cuenta [Cuenta del cliente de claro fijo]
     */
    public function AsocOrder($ot,$cuenta)
    {
        $TTSRetorno = array();
        $sql = "SELECT INITMC TIPO, INMANC FABRICANTE, INSERÑ SERIAL, ININST ESTADO, INACCT CUENTA,
                ININSC,ININSY,ININSM,ININSD, INPSTA ESTADOPREVIO, INVODF
                FROM CABLEDTA.INVMSTR WHERE INACCT = $cuenta AND INWOÑ = $ot";
        $this->ConsultaArray($sql);
        if(count($this->datos)>0)
        {
            $TTSRetorno['ErrorDesc']="";
            foreach($this->datos as $idKey => $dato)
            {
                //Organizo la informacion suministrada.
                $this->resultadoO[$idKey]['TIPO'] = $dato['TIPO'];
                $this->resultadoO[$idKey]['FABRICANTE'] = $dato['FABRICANTE'];
                $this->resultadoO[$idKey]['SERIAL'] = trim($dato['SERIAL']);
                $this->resultadoO[$idKey]['ESTADO'] = $dato['ESTADO'];
                $this->resultadoO[$idKey]['CUENTA'] = $dato['CUENTA'];
                $unifiqFecha = $this->Digito($dato['ININSC']).$this->Digito($dato['ININSY']).$this->Digito($dato['ININSM']).$this->Digito($dato['ININSD']);
                $this->resultadoO[$idKey]['FINSTALADO'] = $unifiqFecha;
                $this->resultadoO[$idKey]['ESTADOPREVIO'] = $dato['ESTADOPREVIO'];
                $this->resultadoO[$idKey]['INVODF'] = $dato['INVODF'];

                $TTSRetorno['RESULTADO'][]=array("TIPO" => $dato['TIPO'],
                                                 "FABRICANTE" => $dato['FABRICANTE'],
                                                 "SERIAL" => $dato['SERIAL'],
                                                 "ESTADO" => $dato['ESTADO'],
                                                 "CUENTA" => $dato['CUENTA'],
                                                 "FINSTALADO" => $unifiqFecha,
                                                 "ESTADOPREVIO" => $dato['ESTADOPREVIO'],
                                                 "INVODF" => $dato['INVODF']);
            }
        }
        else
        {
            $TTSRetorno['ErrorNo']='01';
			$TTSRetorno['ErrorDesc']="La consulta no retorno Datos";
			$TTSRetorno['RESULTADO'][]=array();
        }
        return $TTSRetorno;
    }
    /**
     * [ValidSerial Valida si el serial es nuevo o antiguo]
     * @param [type] $serial     [Serial del equipo entregado al cliente]
     * @param [type] $fabricante [Fabricante del equipo]
     * @param [type] $tipo       [Categoria del equipo (MTA,DVB,etc..)]
     */
    public function ValidSerial($serial,$fabricante,$tipo)
    {
        $TTSRetorno = array();
        $sql = "SELECT IHITMC TIPO, IHMANC FABRICANTE, IHSERÑ SERIAL, IHINST ESTADO_INV,
        IHSTRC,IHSTRY,IHSTRM,IHSTRD, IHACCT CUENTA,
        IHPGMC PROGRAMADO
        FROM CABLEDTA.INVHIST WHERE IHSERÑ = '".str_pad($serial, 20, chr(32), STR_PAD_LEFT)."' AND IHMANC = '".$fabricante."' AND IHITMC = '".$tipo."'";
        $this->ConsultaArray($sql);
        $TTSRetorno['ErrorNo']='';
        $TTSRetorno['ErrorDesc']="";
        if(count($this->datos)>0)
        {
            foreach($this->datos as $idKey => $dato)
            {
                $this->resultadoS[$idKey]['TIPO']=$dato['TIPO'];
                $this->resultadoS[$idKey]['FABRICANTE']=$dato['FABRICANTE'];
                $this->resultadoS[$idKey]['SERIAL']=trim($dato['SERIAL']);
                $this->resultadoS[$idKey]['ESTADO_INV']=$dato['ESTADO_INV'];
                $unifiqFecha = $this->Digito($dato['IHSTRC']).$this->Digito($dato['IHSTRY']).$this->Digito($dato['IHSTRM']).$this->Digito($dato['IHSTRD']);
                $this->resultadoS[$idKey]['FECHA']=$unifiqFecha;
                $this->resultadoS[$idKey]['CUENTA']=$dato['CUENTA'];
                $this->resultadoS[$idKey]['PROGRAMADO']=$dato['PROGRAMADO'];
                $TTSRetorno['RESULTADO'][]=array("TIPO" => $dato['TIPO'],
                                                 "FABRICANTE" => $dato['FABRICANTE'],
                                                 "SERIAL" => $dato['SERIAL'],
                                                 "ESTADO_INV" => $dato['ESTADO_INV'],
                                                 "FECHA" => $unifiqFecha,
                                                 "CUENTA" => $dato['CUENTA'],
                                                 "PROGRAMADO" => $dato['PROGRAMADO']);
            }
        }
        else
        {
            $TTSRetorno['ErrorNo']='01';
			$TTSRetorno['ErrorDesc']="La consulta no retorno Datos";
			$TTSRetorno['RESULTADO'][]=array();
        }
        return $TTSRetorno;
    }
    /**
     * [Digito Los numero menores a 9 se les interpone un 0]
     * @param [type] $num [numero a validar]
     */
    private function Digito($num)
    {
        if(intval($num)<=9)
            return '0'.$num;
        else
            return $num;
    }

    public function traeOT($cuenta,$ot)
    {
        $this->cargaWs();
        $param = array('numeroOtp' => $ot, 'cuentap' => $cuenta);
        $respuesta = $this->clienWs->consultaOT($param);


        return $respuesta; //$this->clienWs;
    }
    
    /**
     * @author Diego Malavera <dmalavera@stefaninicolombia.com>
     * 
     */
    
    public function TraerSerial($serial){
        $this->cargaWs();
        $param = array('numeroOtp' => $ot, 'cuentap' => $cuenta);
        $respuesta = $this->clienWs->consultaSerial($param);
    }
    
    public function traerOT($cuenta,$ot){
        $this->cargaWs();
        $param = array('numeroOtp' => $ot, 'cuentap' => $cuenta);
        $respuesta = $this->clienWs->consultaOT($param);
        $datosP = $respuesta->return->datosP;
        $datos = array();
        foreach($datosP as $dato):
            if(isset($dato) && !empty($dato)):
                $temp = explode('|', $dato);
                $fecha_tmp = isset($temp[5]) ? $temp[5] : '';
                $fecha = '';
                if(!empty($fecha_tmp)):
                    $anio = substr($fecha_tmp, 0, 4);
                    $mes = substr($fecha_tmp, 4, 2);
                    $dia = substr($fecha_tmp, 6, 2);
                    $fecha = $dia."-".$mes."-".$anio;
                endif;
                $data = array(
                    'TIPO' => isset($temp[0]) ? $temp[0] : '',
                    'FABRICANTE' => isset($temp[1]) ? $temp[1] : '',
                    'SERIAL' => isset($temp[2]) ? $temp[2] : '',
                    'ESTADO' => isset($temp[3]) ? $temp[3] : '',
                    'CUENTA' => isset($temp[4]) ? $temp[4] : '',
                    'FECHA' => $fecha,
                    'ESTADOPREVIO' => isset($temp[6]) ? $temp[6] : '',
                    'INVODF' => isset($temp[7]) ? $temp[7] : ''
                );
                $datos[] = $data;
            endif;
        endforeach;
        //uksort($datos, array($this, 'sortDate'));
        $ots = array_filter($datos, array($this, 'filterData'));
        var_dump($ots);
        exit;

    }
    
    function filterData($var){
        if($var['ESTADO'] != 'AS'):
            return false;
        endif;
        if($var['ESTADO'] == $var['ESTADOPREVIO']):
            return false;
        endif;
        if($var['INVODF'] != 2):
            return false;
        endif;
        return true;
    }
    
    function sortDate($a, $b){
            return strtotime($a['FECHA']) - strtotime($b['FECHA']);
    }
}
?>