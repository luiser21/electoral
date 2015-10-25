<?php require_once('topadmin.php');?> 
  <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
<script src="js/countdown.js"></script>
<?php
date_default_timezone_set('America/Bogota');

if(date('H')>=09 && date('H')<10){ 
	$sql="UPDATE boletines set ESTADO=1,ESTADO_DEPARTAMENTO=1
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');	
	$DBGestion->Consulta($sql);	
}elseif(date('H')>=10 && date('H')<11){ 
	$sql="SELECT ESTADO_DEPARTAMENTO FROM boletines WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');
	$DBGestion->ConsultaArray($sql);				
	$estado=$DBGestion->datos;		
	 foreach ($estado as $datos2){
		 $estados =$datos2['ESTADO_DEPARTAMENTO'];		 
	}
	if($estados==0){
		$sql="UPDATE boletines_departamentos set META=0
				    WHERE candidato=".$_SESSION['idcandidato'];	
		$DBGestion->Consulta($sql);	
	}	
	$sql="UPDATE boletines set ESTADO=2,ESTADO_DEPARTAMENTO=2
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".(date('H')-1)."";	
	$DBGestion->Consulta($sql);	
	$sql="UPDATE boletines set ESTADO=1,ESTADO_DEPARTAMENTO=1
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');	
	$DBGestion->Consulta($sql);	
}elseif(date('H')>=11 && date('H')<12){ 
	$sql="SELECT ESTADO_DEPARTAMENTO FROM boletines WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');
	$DBGestion->ConsultaArray($sql);				
	$estado=$DBGestion->datos;		
	 foreach ($estado as $datos2){
		 $estados =$datos2['ESTADO_DEPARTAMENTO'];		 
	}
	if($estados==0){
		$sql="UPDATE boletines_departamentos set META=0
				    WHERE candidato=".$_SESSION['idcandidato'];	
		$DBGestion->Consulta($sql);	
	}	
	$sql="UPDATE boletines set ESTADO=2,ESTADO_DEPARTAMENTO=2
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".(date('H')-1)."";	
	$DBGestion->Consulta($sql);	
	$sql="UPDATE boletines set ESTADO=1,ESTADO_DEPARTAMENTO=1
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');	
	$DBGestion->Consulta($sql);	
}elseif(date('H')>=12 && date('H')<13){ 
	$sql="SELECT ESTADO_DEPARTAMENTO FROM boletines WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');
	$DBGestion->ConsultaArray($sql);				
	$estado=$DBGestion->datos;		
	 foreach ($estado as $datos2){
		 $estados =$datos2['ESTADO_DEPARTAMENTO'];		 
	}
	if($estados==0){
		$sql="UPDATE boletines_departamentos set META=0
				    WHERE candidato=".$_SESSION['idcandidato'];	
		$DBGestion->Consulta($sql);	
	}	
	$sql="UPDATE boletines set ESTADO=2,ESTADO_DEPARTAMENTO=2
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".(date('H')-1)."";	
	$DBGestion->Consulta($sql);	
	$sql="UPDATE boletines set ESTADO=1,ESTADO_DEPARTAMENTO=1
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');	
	$DBGestion->Consulta($sql);	
}elseif(date('H')>=13 && date('H:i')<14){ 
	$sql="SELECT ESTADO_DEPARTAMENTO FROM boletines WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');
	$DBGestion->ConsultaArray($sql);				
	$estado=$DBGestion->datos;		
	 foreach ($estado as $datos2){
		 $estados =$datos2['ESTADO_DEPARTAMENTO'];		 
	}
	if($estados==0){
		$sql="UPDATE boletines_departamentos set META=0
				    WHERE candidato=".$_SESSION['idcandidato'];	
		$DBGestion->Consulta($sql);	
	}	
	$sql="UPDATE boletines set ESTADO=2,ESTADO_DEPARTAMENTO=2
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".(date('H')-1)."";	
	$DBGestion->Consulta($sql);	
	$sql="UPDATE boletines set ESTADO=1,ESTADO_DEPARTAMENTO=1
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');	
	$DBGestion->Consulta($sql);	
}elseif(date('H')>=14 && date('H')<15){ 
	$sql="SELECT ESTADO_DEPARTAMENTO FROM boletines WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');
	$DBGestion->ConsultaArray($sql);				
	$estado=$DBGestion->datos;		
	 foreach ($estado as $datos2){
		 $estados =$datos2['ESTADO_DEPARTAMENTO'];		 
	}
	if($estados==0){
		$sql="UPDATE boletines_departamentos set META=0
				    WHERE candidato=".$_SESSION['idcandidato'];	
		$DBGestion->Consulta($sql);	
	}	
	$sql="UPDATE boletines set ESTADO=2,ESTADO_DEPARTAMENTO=2
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".(date('H')-1)."";	
	$DBGestion->Consulta($sql);	
	$sql="UPDATE boletines set ESTADO=1,ESTADO_DEPARTAMENTO=1
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');	
	$DBGestion->Consulta($sql);	
}elseif(date('H')>=15 && date('H')<=16){ 
	
	$sql="SELECT ESTADO_DEPARTAMENTO FROM boletines WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');
	$DBGestion->ConsultaArray($sql);				
	$estado=$DBGestion->datos;		
	 foreach ($estado as $datos2){
		 $estados =$datos2['ESTADO_DEPARTAMENTO'];		 
	}
	if($estados==0){
		$sql="UPDATE boletines_departamentos set META=0
				    WHERE candidato=".$_SESSION['idcandidato'];	
		$DBGestion->Consulta($sql);	
	}	

	$sql="UPDATE boletines set ESTADO=2,ESTADO_DEPARTAMENTO=2
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".(date('H')-1)."";	
	$DBGestion->Consulta($sql);	
	$sql="UPDATE boletines set ESTADO=1,ESTADO_DEPARTAMENTO=1
				    WHERE candidato=".$_SESSION['idcandidato']." and hora_real=".date('H');	
	$DBGestion->Consulta($sql);	
}

 if(date('H')<16){ ?>
<meta http-equiv=refresh content=20;URL=reporte2.php>
<?php }elseif(date('H')>=16){ ?>
<meta http-equiv=refresh content=20;URL=escrutinio.php>
<?php } ?>
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
			
			<div id="crudFormLineal" style="width: 920px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" ><script>
		$(document).ready(function(){
			$("#countdown").countdown({
				date: "25 october 2015 15:59:59",
				format: "on"
			},
			function() {
				// callback function
			});
		});
	</script>
		<p style="margin-left:468px">Cuenta Regresiva para Cierre de Mesas<div class="timer-area" style=" margin-right:-100px">	
										<ul id="countdown" style="margin-left:58px">
										<?php if($_SESSION['foto']!=""){?>
						<img src="<?php echo $_SESSION['foto']?>" width="180" height="177" style="border:3px solid #CCCCCC;">
			<?php }else{ ?>		
				<img src="fotos/images.jpg" width="180" height="177" style="border:3px solid #CCCCCC;">
			<?php } ?>	
										<!--<img src="<?php echo $_SESSION['foto']?>" width="180" height="177">-->
										<?php if($_SESSION['tipocandidato']=='PRESIDENCIA'){
		echo 'a la '.$_SESSION['tipocandidato'];
	}elseif($_SESSION['tipocandidato']=='GOBERNACION'){
	
	}elseif($_SESSION['tipocandidato']=='ALCALDIA'){
		
	}elseif($_SESSION['tipocandidato']=='CONSEJO'){
		
	}elseif($_SESSION['tipocandidato']=='SENADO'){?>
		<img src="images/ktEO3b-9.png" width="201" height="148"> 
	<?php }elseif($_SESSION['tipocandidato']=='CAMARA'){
	
	}elseif($_SESSION['tipocandidato']=='JAL'){
	
	}
	?>
<div style="position:absolute; left: 294px; top: 90px;" >
	<table width="auto" border="0">

  <tr>
    <td>

      <h4 align="left" style="font-size: 18px; color: #999999"><?php echo $_SESSION['nombre']?></h4></td>
  </tr>

    <td><h4 align="left" style="font-size: 18px">Candidato 
	<?php if($_SESSION['tipocandidato']=='PRESIDENCIA'){
		echo 'a la '.$_SESSION['tipocandidato'];
	}elseif($_SESSION['tipocandidato']=='GOBERNACION'){
		echo 'a la '.$_SESSION['tipocandidato'].' de ';	
	}elseif($_SESSION['tipocandidato']=='ALCALDIA'){
		echo 'a la '.$_SESSION['tipocandidato'].' del ';	
	}elseif($_SESSION['tipocandidato']=='CONSEJO'){
		echo 'al '.$_SESSION['tipocandidato'].' de ';	
	}elseif($_SESSION['tipocandidato']=='SENADO'){
		echo 'al '.$_SESSION['tipocandidato'].' de la República';	
	}elseif($_SESSION['tipocandidato']=='CAMARA'){
		echo 'a la '.$_SESSION['tipocandidato'].' de Representantes';	
	}elseif($_SESSION['tipocandidato']=='JAL'){
		echo 'a la '.$_SESSION['tipocandidato'];	
	}
	?> </h4></td>
  </tr>
    <tr><td><h4 align="left" style="font-size: 18px; color: #999999">
	<?php 
	if($_SESSION['tipocandidato']=='PRESIDENCIA'){
		echo 'COLOMBIA';
	}elseif($_SESSION['tipocandidato']=='GOBERNACION'){
		echo ucwords(strtolower($_SESSION['departamento']));	
	}elseif($_SESSION['tipocandidato']=='ALCALDIA'){
		echo 'Municipio de '.ucwords(strtolower($_SESSION['municipio'])); 
	}elseif($_SESSION['tipocandidato']=='CONSEJO'){
		echo ucwords(strtolower($_SESSION['municipio'])); 
	}elseif($_SESSION['tipocandidato']=='SENADO'){
		echo 'Por '.ucwords(strtolower($_SESSION['departamento']));	
	}elseif($_SESSION['tipocandidato']=='CAMARA'){
		echo 'Por '.ucwords(strtolower($_SESSION['departamento']));
	}elseif($_SESSION['tipocandidato']=='JAL'){
		echo ucwords(strtolower($_SESSION['municipio'])).' - '.ucwords(strtolower($_SESSION['departamento'])); 
	}?></h4></td></tr>
  <tr>
  <tr>
    <td><h4 align="left" style="font-size: 18px"><?php echo $_SESSION['partido']?> </h4></td>
  </tr>
  <tr>
    <td><h4 align="left" style="font-size: 18px; color: #999999">
	<?php 
	if($_SESSION['tipocandidato']!='PRESIDENCIA'  && $_SESSION['tipocandidato']!='GOBERNACION' && $_SESSION['tipocandidato']!='ALCALDIA'){?>
		Tarjeton # <?php echo $_SESSION['ntarjeton']?></h4> </td>
	<?php }?>
	
  </tr>
 
</table> </div>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
		
		<table width="100%" border="0">
  <tr style="font-size:16px">
    <th width="43%" rowspan="3" scope="col"><?php 
//imprimir($_SESSION);

$sql="SELECT
sum(boletines.MOVILIZADOS) AS MOVILIZADOS
FROM
boletines
where boletines.ESTADO=1 and candidato=".$_SESSION['idcandidato']." and IDDEPARTAMENTO=1";
$DBGestion->ConsultaArray($sql);				
$totales=$DBGestion->datos;	

//imprimir($totales[0]['MOVILIZADOS']);

 $sql="SELECT
HORA_REAL,
CONCAT(boletines.REPORTES) as REPORTES,
sum(boletines.MOVILIZADOS) AS MOVILIZADOS
FROM
boletines
where boletines.ESTADO in (1,2) and candidato=".$_SESSION['idcandidato']." and IDDEPARTAMENTO=1
GROUP BY REPORTES  order by 1 desc";
$DBGestion->ConsultaArray($sql);				
$departamentos=$DBGestion->datos;	

$arrDepartamento=array();
$i=0;
$arrDepartamento="";
$arrDepartamento2="";
$arrDepartamento3="";
$arrDepartamento4="";
$suma=0;
$suma1=0;
$suma2=0;
$depar="";
//imprimir($departamentos);
foreach($departamentos as $Depto=>$Val){
$i++;
	
	if($i<count($departamentos)){
		$arrDepartamento.= "'".$Val['REPORTES']."',";
		$arrDepartamento2.= "".$Val['MOVILIZADOS'].",";
		//$arrDepartamento3.= "".$Val['PREVISTO'].",";
		//$arrDepartamento4.= "".$Val['REAL'].",";
	}else{
		
		$arrDepartamento.= "'".$Val['REPORTES']."'";
		$arrDepartamento2.= "".$Val['MOVILIZADOS']."";		
		//$arrDepartamento3.= "".$Val['PREVISTO']."";
		//$arrDepartamento4.= "".$Val['REAL']."";
	}
}
$sql="SELECT boletines.REPORTES
FROM
boletines
where boletines.ESTADO=1";
//echo $sql;
$DBGestion->ConsultaArray($sql);
$reportes=$DBGestion->datos;
//imprimir($depar);
//$arrDepartamento.= "'OTROS'";
//$arrDepartamento2.= "".$suma."";
//$arrDepartamento3.= "".$suma1."";
//$arrDepartamento4.= "".$suma2."";
//imprimir($arrDepartamento); ?>
	<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'GRAFICA POR REPORTES'
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
                name: 'Votos',
                data: [<?php echo $arrDepartamento2?>]
    		}
			/*, {
                name: 'Compromiso',
                data: [<?php echo $arrDepartamento3?>]
            }, {
                name: 'Registraduria',
                data: [<?php echo $arrDepartamento4?>]
            }*/]
        });
    });
    
		</script>
			<script src="js/js/highcharts.js"></script>
<script src="js/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div></th>
    <th width="15%" scope="col">REPORTES</th> 
	   <th width="15%" rowspan="2" scope="col" style="border:3px solid #CCCCCC;"><div ><blink><strong style="font-size:32px; color:#FF0000"><br/><br/>
	   <?php echo number_format((($totales[0]['MOVILIZADOS']/$_SESSION['votosprevistos'])*100), 2, ',', ',').'%'?><br/><br/>
	   <?php echo 
	   number_format($totales[0]['MOVILIZADOS'], 0, '', '.')?><br/><br/>VOTOS</strong></blink>
	     <p>&nbsp;</p>
	     <p><img src="images/votos2.png" width="119" height="131"></p>
	   </div> </th>
	  
       <th width="27%" rowspan="3" style="border:3px solid #CCCCCC;" scope="col">MESAS CON MAYOR VOTOS<br/>
         <strong style="color: #990000">
		<div class="filtering"><input type="hidden" id="LoadRecordsButton"></input>
</div>
		 <div id="PeopleTableContainer" style="width: auto;"></div>
		 <script type="text/javascript">

		$(document).ready(function () {
		
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Puestos de Votacion',
				paging: true,
				pageSize: 12,
				sorting: true,
				defaultSorting: 'Name ASC',
				actions: {
					listAction: 'PersonActionsPagedSorted_Informe_mesas.php?action=list2'
					//createAction: 'PersonActionsPagedSorted.php?action=create',
					//updateAction: 'PersonActionsPagedSorted.php?action=update',
					//deleteAction: 'PersonActionsPagedSorted.php?action=delete'
				},
				fields: {
					ID: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					ZONA: {
						title: 'MESAS',
						width: '10%',
						create: false,
						edit: false
					},
					MOVILIZADOS : {
						title: 'VOTOS',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},
					PARTICIPACION : {
						title: '%',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					}
				}
			});

			//Load person list from server
			//$('#PeopleTableContainer').jtable('load');
			$('#LoadRecordsButton').click(function (e) {
           		 e.preventDefault();
				$('#PeopleTableContainer').jtable('load', {
					
				});
			});
	 
			//Load all records when page is first shown
				$('#LoadRecordsButton').click();
		});

	</script>
		 <?php 
	
	   ?> 
	  </strong></th>
  </tr>
  <tr>
    <th scope="col"><?php 
echo @$reportes[0]['REPORTES'];	?></th>
	 </tr>
  <tr>
    <th height="40" scope="col">HORA ACTUAL </th>

    <th scope="col" style="border:3px solid #CCCCCC; font-size:20px"><?php echo date(" g:i:s a") ?></th>
    </tr>
</table>

<?php 

$sql="SELECT
SUM(consolidado.META) AS TOTAL1,
SUM(consolidado.PREVISOT) as TOTAL2,
SUM(consolidado.REAL) AS TOTAL3
FROM
consolidado
INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = consolidado.IDREGIONAL
";
$DBGestion->ConsultaArray($sql);				
$totales=$DBGestion->datos;	

//imprimir($totales[0]['TOTAL']);

$sql="SELECT
departamentos.NOMBRE as DEPARTAMENTO,
consolidado.META AS VOTOS,
consolidado.PREVISOT as PREVISTO,
consolidado.REAL 
FROM
consolidado
INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = consolidado.IDREGIONAL
ORDER BY DEPARTAMENTO ";
$DBGestion->ConsultaArray($sql);				
$departamentos=$DBGestion->datos;	

$arrDepartamento=array();
$i=0;
$arrDepartamento="";
$arrDepartamento2="";
$arrDepartamento3="";
$arrDepartamento4="";
$suma=0;
$suma1=0;
$suma2=0;
$depar="";
foreach($departamentos as $Depto=>$Val){
$i++;
$valores=round(($Val['VOTOS']*100)/$totales[0]['TOTAL1'], 2);
	
	if($i<count($departamentos) && $i<=8){
		$arrDepartamento.= "'".$Val['DEPARTAMENTO']."',";
		$arrDepartamento2.= "".$Val['VOTOS'].",";
		$arrDepartamento3.= "".$Val['PREVISTO'].",";
		$arrDepartamento4.= "".$Val['REAL'].",";
	}else{
		
		/*$arrDepartamento.= "'".$Val['DEPARTAMENTO']."'";
		$arrDepartamento2.= "".$Val['VOTOS']."";		
		$arrDepartamento3.= "".$Val['PREVISTO']."";
		$arrDepartamento4.= "".$Val['REAL']."";*/
	}
	
	if($i==8){
		$suma=$suma+$Val['VOTOS'];
		$suma1=$suma1+$Val['VOTOS'];
		$suma2=$suma2+$Val['VOTOS'];
		$depar=$depar.','.$Val['DEPARTAMENTO'];
	}
	
	
}
//imprimir($depar);
$arrDepartamento.= "'OTROS'";
$arrDepartamento2.= "".$suma."";
$arrDepartamento3.= "".$suma1."";
$arrDepartamento4.= "".$suma2."";
//imprimir($arrDepartamento2);
?>
<div id="marquesina">
<div id="marque">
<div class="first">
<marquee>
VOTOS PREVISTOS:  <span style="color:#FF0000">6.100</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
DIA ELECTORAL HA COMENZADO
</marquee>
</div>
</div>
</div>	
						<br/>



			
					

				
				
		  </div></div>
		</header>	
		
	 </div></body>
<?php //require_once('bottom.php'); ?>		