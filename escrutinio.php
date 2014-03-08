<?php require_once('topadmin.php');?> 
  <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
<script src="js/countdown.js"></script>
<!--
<meta http-equiv=refresh content=20;URL=escrutinio.php>-->
<script>

function Blink()
{
var ElemsBlink = document.getElementsByTagName('blink');
for(var i=0;i<ElemsBlink.length;i++)
ElemsBlink[i].style.visibility = ElemsBlink[i].style.visibility
=='visible' ?'hidden':'visible';
}
</script>

<body onLoad="setInterval('Blink()',500)">



<style>

#crudFormLineal label {
	width: 350px;
}
.bg1 {  
	position:relative;
	top:600px;
}
h4{

 color: #006600;
    font-family: 'GothamLight',arial,serif;
    font-size: 28px;
    font-weight: lighter;
    margin-bottom: 1px;
    margin-left: 1px;
    margin-top: 1px;
}
button, input[type="button"], input[type="submit"] {
    background-color: #A1AAAF;
    border: 0 none;
    color: #FFFFFF;
    cursor: pointer;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    height: 32px;
    margin-right: 2px;
    width: 108px;
}
#marquesina {
    background: url("images/marquesina.gif") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    height: 37px;
    margin: 5px -20px 6px;
    width: 950px;
}
</style>
<div class="main">	
<header>
		<div style=" position:absolute; top:190px; width:auto; clear:both"><br/>
			
			<div id="crudFormLineal" style="width: 910px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" ><script>
		
	</script>
		<p style="margin-left:468px">Mesas Cerradas<div class="timer-area" style=" margin-right:-100px">	
										<ul id="countdown" style="margin-left:58px">
										<img src="<?php echo $_SESSION['foto']?>" width="180" height="177"><img src="images/ktEO3b-9.png" width="201" height="148"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<li>
												<span class="days">00</span>
												<p class="timeRefDays">days</p>
											</li>
											<li>
												<span class="hours">00</span>
												<p class="timeRefHours">hours</p>
											</li>
											<li>
												<span class="minutes">00</span>
												<p class="timeRefMinutes">minutes</p>
											</li>
											<li>
												<span class="seconds">00</span>
												<p class="timeRefSeconds">seconds</p>
											</li>
										</ul>
										
									</div> </p>	
		
		<table width="94%" border="0">
  <tr style="font-size:16px">
    <th width="55%" rowspan="5" scope="col"><?php 


$sql="SELECT
sum(boletines_departamentos.MOVILIZADOS) as MOVILIZADOS
FROM
boletines_departamentos";
$DBGestion->ConsultaArray($sql);				
$totales=$DBGestion->datos;	

//imprimir($totales[0]['MOVILIZADOS']);

$sql="SELECT
boletines_departamentos.IDDEPARTAMENTO,
departamentos.NOMBRE,
boletines_departamentos.VOTOS_REALES,
boletines_departamentos.MOVILIZADOS
FROM
boletines_departamentos
INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = boletines_departamentos.IDDEPARTAMENTO
WHERE boletines_departamentos.VOTOS_REALES<>0
ORDER BY NOMBRE ";
$DBGestion->ConsultaArray($sql);				
$departamentos=$DBGestion->datos;	

$arrDepartamento="";
$arrDepartamento2="";
$arrDepartamento3="";
$i=0;
foreach($departamentos as $Depto=>$Val){
$i++;
	
	if($i<count($departamentos)){
		$arrDepartamento.= "'".$Val['NOMBRE']."',";
		$arrDepartamento2.= "".$Val['MOVILIZADOS'].",";
		$arrDepartamento3.= "".$Val['VOTOS_REALES'].",";
		//$arrDepartamento4.= "".$Val['REAL'].",";
	}else{
		
		$arrDepartamento.= "'".$Val['NOMBRE']."'";
		$arrDepartamento2.= "".$Val['MOVILIZADOS']."";		
		$arrDepartamento3.= "".$Val['VOTOS_REALES']."";
		//$arrDepartamento4.= "".$Val['REAL']."";
	}
}

//imprimir($arrDepartamento);
 ?>
	<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'GRAFICA POR MOVILIZADOS VS ESCRUTINIO DEPARTAMENTAL'
            },
            subtitle: {
                text: 'VOTOS'
            },
            xAxis: {
                categories: [<?php echo $arrDepartamento?>],
				title: {
                    text: null
                }
            },
              yAxis: {
                min: 0,
                title: {
                    text: 'VOTOS',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Movilizados',
                data: [<?php echo $arrDepartamento2?>]
    		},
			 {
                name: 'Registraduria',
                data: [<?php echo $arrDepartamento3?>]
            }/*, {
                name: 'Registraduria',
                data: [<?php echo $arrDepartamento4?>]
            }*/]
        });
    });
    
		</script>
			<script src="js/js/highcharts.js"></script>
<script src="js/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div></th>
<?php $sql="SELECT
			escrutinio.CURULES,
			escrutinio.MESAS_INSTALADAS,
			escrutinio.MESAS_INFORMADAS,
			escrutinio.VOTOS_PARTIDO,
			escrutinio.PORCENTAJE_PARTIDO,
			escrutinio.VOTOS_U49
			FROM
			escrutinio";
	$DBGestion->ConsultaArray($sql);				
	$escrutinio=$DBGestion->datos;	
	//imprimir($escrutinio);

?>
    <th width="14%" scope="col">MOVILIZADOS</th> 
	   <th width="31%" colspan="2" style="border:3px solid #CCCCCC;" scope="col"><strong style="font-size:28px; color: #000000"><?php echo 
	   number_format($totales[0]['MOVILIZADOS'], 0, '', '.')?> &nbsp;VOTOS</strong>	      </th>
  </tr>
  <tr>
    <th scope="col">CURULES ASIGNADAS  </th>
	 <th width="31%" colspan="2" style="border:3px solid #CCCCCC;" scope="col"><img src="images/Senado_CNS_1989.png" width="239" height="69">
	   <strong style="color:#00CC00; font-size:32px; size:32px"><?php echo $escrutinio[0]['CURULES']?><img src="images/partidou.png" width="240" height="80"></strong></th>
  </tr>
  <tr>
    <th height="40" scope="col">MESAS INSTALADAS </th>
    <th colspan="2" style="border:3px solid #CCCCCC; font-size:20px" scope="col"><?php echo  number_format($escrutinio[0]['MESAS_INSTALADAS'], 0, '', '.')?></th>
  </tr>
  <tr>
    <th height="40" scope="col">% MESAS INFORMADAS </th>
    <th colspan="2" style="border:3px solid #CCCCCC; font-size:20px" scope="col"><strong style="font-size:28px"><?php echo $escrutinio[0]['MESAS_INFORMADAS']?>&nbsp;%</strong> <img src="images/padrones-2013-donde-votar.png" width="40" height="33"></th>
  </tr>
  <tr>
    <th height="40" scope="col">VOTOS PARTIDO </th>
    <th scope="col" style="border:3px solid #CCCCCC; font-size:20px"><?php echo  number_format($escrutinio[0]['VOTOS_PARTIDO'], 0, '', '.')?>&nbsp;VOTOS</th>
    <th scope="col" style="border:3px solid #CCCCCC; font-size:20px"><?php echo $escrutinio[0]['PORCENTAJE_PARTIDO']?>&nbsp;%</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
    <th height="40" scope="col">VOTOS U49 </th>
    <th colspan="2" style="border:3px solid #CCCCCC; font-size:20px" scope="col"><blink><strong style="font-size:32px; color:#FF0000"><?php echo  number_format($escrutinio[0]['VOTOS_U49'], 0, '', '.')?>&nbsp;VOTOS </strong></blink></th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
    <th height="40" scope="col">HORA ACTUAL</th>
    <th colspan="2" style="border:3px solid #CCCCCC; font-size:20px" scope="col"><span	><?php echo date(" g:i:s a") ?></span></th>
  </tr>
</table>


<div id="marquesina">
<div id="marque">
<div class="first">
<marquee>
VOTOS PREVISTOS:  <span style="color:#FF0000">98.350</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MESAS DE VOTACION CERRADAS
</marquee></div>
</div>
</div>	
						<br/>

				
		  </div></div>
		</header>	
		
	 </div></body>
<?php //require_once('bottom.php'); ?>		