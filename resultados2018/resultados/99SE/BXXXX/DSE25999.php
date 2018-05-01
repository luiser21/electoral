<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="../../../99css/jquery-jvectormap-1.2.2.css" />
  <script type="text/javascript" src="../../../99js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../../../99js/jvectormap.js"></script>
  <script type="text/javascript" src="../../../99js/jquery-jvectormap-25.js"></script>
  <script type="text/javascript" src="../../../99js/99.js"></script>
  <script type="text/javascript" src="../../../99js/mapas.js"></script>
  <script type="text/javascript" src="../../../99js/nomenclator.js"></script>
  <script type="text/javascript" src="../../../99js/select2.full.js"></script>
  <script type="text/javascript" src="../../../99js/select2.custom.js"></script>
  <script type="text/javascript" src="../../../99js/99-mapascolo18.js"></script>
 </head>
 <? 
  include_once "../../../../includes/GestionBD.new.class.php";
	$DBGestion = new GestionBD('AGENDAMIENTO');	
 $sql="SELECT municipios.MAPA,
CONCAT('C21 - ',(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='C21' AND municipios.ID=elecciones_senado.IDMUNICIPIO)) AS 'C21',
CONCAT('U6 - ',(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='U6' AND municipios.ID=elecciones_senado.IDMUNICIPIO)) AS 'U6',
CONCAT('U24 - ',(SELECT SUM(VOTOS) FROM elecciones_senado WHERE TIPO='U24' AND municipios.ID=elecciones_senado.IDMUNICIPIO)) AS 'U24'
FROM  elecciones_senado 
INNER JOIN municipios ON municipios.ID=elecciones_senado.IDMUNICIPIO
INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO=municipios.IDDEPARTAMENTO
WHERE departamentos.IDDEPARTAMENTO=24
GROUP BY municipios.ID
ORDER BY 2";
$DBGestion->ConsultaArray($sql);				
$mapas=$DBGestion->datos;
//var_dump($mapas);
	$armarmapa='';
	$armarmapa1='';
	$armarmapa2='';
	$armarmapa3='';
	$y=1;
	for($i=0; $i<count($mapas);$i++){
		$armarmapa=$armarmapa."'".$mapas[$i]['MAPA']."':'".$mapas[$i]['C21']."'," ;
		$armarmapa1=$armarmapa1."'".$mapas[$i]['MAPA']."':'".$mapas[$i]['U6']."'," ;
		
		if($y<=9){ 
			$armarmapa3=$armarmapa3."'".$mapas[$i]['MAPA']."':'00".$y."'," ;
			$armarmapa2=$armarmapa2."'00".$y."':'".$mapas[$i]['U24']."'," ;
		}else{ 
			$armarmapa3=$armarmapa3."'".$mapas[$i]['MAPA']."':'0".$y."'," ;
			$armarmapa2=$armarmapa2."'0".$y."':'".$mapas[$i]['U24']."'," ;
		}
		$y++;
	}
	//echo $armarmapa2; 
 ?>
 <body>
<div id="caja_BusquedaLibre" class="">
	<div id="busquedaLibre1" class="cajasel_BusquedaLibre">	   
	</div>
</div>
<div class="cajaCI cajaCInoscript" id="sol1">
	<div class="cajaMapa">		
		<div class="cuadroMapa">        
			<div class="Mapa mapacol" id="cajaMapa1"style="height: 438.658px;">
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
vmapescrutado[0] = {<? echo $armarmapa?>};
vmapvotos[0] = {<? echo $armarmapa1?>};
vmapdata[0] = {<? echo $armarmapa3?>};
vmappartidos[0] = {<? echo $armarmapa2?>};
vmapcolores[0] = {
		'001': '#0460a7', 
		'002': '#de818a', 
		'003': '#0460a7', 
		'004': '#c0000d', 
		'005': '#de818a', 
		'006': '#c0000d', 
		'007': '#de818a', 
		'008': '#de818a', 
		'009': '#de818a', 
		'010': '#de818a', 
		'011': '#54b8ec', 
		'012': '#e46f00', 
		'013': '#de818a', 
		'014': '#c0000d', 
		'015': '#0460a7', 
		'016': '#de818a', 
		'017': '#f9e800', 
		'018': '#de818a', 
		'019': '#0460a7', 
		'020': '#0460a7', 
		'021': '#0460a7', 
		'022': '#54b8ec', 
		'023': '#0460a7', 
		'024': '#e46f00', 
		'025': '#de818a', 
		'026': '#de818a', 
		'027': '#0460a7', 
		'028': '#0460a7', 
		'029': '#de818a', 
		'030': '#de818a', 
		'031': '#f9e800', 
		'032': '#e46f00', 
		'033': '#0460a7', 
		'034': '#0460a7', 
		'035': '#54b8ec', 
		'036': '#f9e800', 
		'037': '#de818a', 
		'038': '#c0000d', 
		'039': '#0460a7', 
		'040': '#de818a', };
</script>
</body> 
</html>