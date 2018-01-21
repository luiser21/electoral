<?php require_once('topadmin_electoral.php');?> 
  <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
	
<script src="js/countdown.js"></script>
<?php 
date_default_timezone_set('America/Bogota');
if(date('H')<16){ ?>
<!--<meta http-equiv=refresh content=20;URL=reporte.php>-->
<?php }elseif(date('H')==16){ ?>
<!--<meta http-equiv=refresh content=20;URL=escrutinio.php>-->
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

<?php 


$sql="SELECT
sum(boletines.MOVILIZADOS) AS MOVILIZADOS
FROM
boletines
INNER JOIN candidato ON candidato.ID = boletines.CANDIDATO
INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
where usuario.USUARIO='".$_SESSION["username"]."'";
$DBGestion->ConsultaArray($sql);				
$totales=$DBGestion->datos;	

//imprimir($totales[0]['MOVILIZADOS']);

$sql="SELECT
CONCAT(boletines.REPORTES,' - ',boletines.HORA) as REPORTES,
sum(boletines.MOVILIZADOS) AS MOVILIZADOS
FROM
boletines
INNER JOIN candidato ON candidato.ID = boletines.CANDIDATO
INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
where boletines.ESTADO in (1,2) AND usuario.USUARIO='".$_SESSION["username"]."'
GROUP BY REPORTES 
ORDER BY boletines.ID";
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
INNER JOIN candidato ON candidato.ID = boletines.CANDIDATO
INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
where boletines.ESTADO=1  AND usuario.USUARIO='".$_SESSION["username"]."'";
//echo $sql;
$DBGestion->ConsultaArray($sql);
$reportes=$DBGestion->datos;
//imprimir($depar);
//$arrDepartamento.= "'OTROS'";
//$arrDepartamento2.= "".$suma."";
//$arrDepartamento3.= "".$suma1."";
//$arrDepartamento4.= "".$suma2."";
//imprimir($arrDepartamento); ?>
<div class="main">	

<header>

		<div style=" position:absolute; top:190px; width:auto; clear:both"><br/>
			
			<div id="crudFormLineal" style="width: 920px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" ><script>
		$(document).ready(function(){
			$("#countdown").countdown({
				date: "25 october 2015 07:59:59",
				format: "on"
			},
			function() {
				// callback function
			});
		});
	</script>
<div id="marquesina">
<div id="marque">
<div class="first">
<marquee>
VOTOS PREVISTOS:  <span style="color:#FF0000"><?php 
echo $_SESSION["votosprevistos"].' Sufragantes';
?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <span style=" color:#00CC33; font-size:17px"><strong><?php echo $_SESSION["eslogan"]?></strong></span>
</marquee>
</div>
</div>
</div>
	<p style="margin-left:388px">Cuenta Regresiva para Apertura de Mesas<div class="timer-area">	
										<ul id="countdown">
										<?php if($_SESSION['foto']!=""){?>
						<img src="<?php echo $_SESSION['foto']?>" width="94" height="108" style="border:3px solid #CCCCCC;">
			<?php }else{ ?>		
				<img src="fotos/images.jpg" width="94" height="108" style="border:3px solid #CCCCCC;">
			<?php } ?>	
							
<div style="position:absolute; left: 128px; top: 140px;" >
	<table width="auto" border="0">
  <tr>
    <td>
      <h4 align="left" style="font-size: 14px; color: #999999"><?php echo strtoupper($_SESSION['nombre'])?></h4></td>
  </tr>

    <td><h4 align="left" style="font-size: 14px"> 
	<?php if($_SESSION['tipocandidato']=='PRESIDENCIA'){
		echo strtoupper('a la '.$_SESSION['tipocandidato']);
	}elseif($_SESSION['tipocandidato']=='GOBERNACION'){
		echo strtoupper('a la '.$_SESSION['tipocandidato'].' de ');	
	}elseif($_SESSION['tipocandidato']=='ALCALDIA'){
		echo strtoupper('a la '.$_SESSION['tipocandidato'].' del ');	
	}elseif($_SESSION['tipocandidato']=='CONSEJO'){
		echo strtoupper('al '.$_SESSION['tipocandidato'].' de ');	
	}elseif($_SESSION['tipocandidato']=='SENADO'){
		echo strtoupper('al '.utf8_decode($_SESSION['tipocandidato'].' de la Rep&uacute;blica'));	
	}elseif($_SESSION['tipocandidato']=='CAMARA'){
		echo strtoupper('a la '.$_SESSION['tipocandidato'].' de Representantes');	
	}elseif($_SESSION['tipocandidato']=='JAL'){
		echo strtoupper('a la '.$_SESSION['tipocandidato']);	
	}
	?> </h4></td>
  </tr> 
    <tr><td><h4 align="left" style="font-size: 14px; color: #999999">
	<?php 
	if($_SESSION['tipocandidato']=='PRESIDENCIA'){
		echo 'COLOMBIA';
	}elseif($_SESSION['tipocandidato']=='GOBERNACION'){
		echo ucwords(strtoupper($_SESSION['departamento']));	
	}elseif($_SESSION['tipocandidato']=='ALCALDIA'){
		echo strtoupper('Municipio de '.ucwords(strtoupper($_SESSION['municipio']))); 
	}elseif($_SESSION['tipocandidato']=='CONSEJO'){
		echo ucwords(strtoupper($_SESSION['municipio'])); 
	}elseif($_SESSION['tipocandidato']=='SENADO'){
		echo strtoupper('Por '.ucwords(strtoupper($_SESSION['departamento'])));	
	}elseif($_SESSION['tipocandidato']=='CAMARA'){
		echo strtoupper('Por '.ucwords(strtoupper($_SESSION['departamento'])));
	}elseif($_SESSION['tipocandidato']=='JAL'){
		echo ucwords(strtoupper($_SESSION['municipio'])).' - '.ucwords(strtoupper($_SESSION['departamento'])); 
	}?></h4></td></tr>
  <tr>
  <tr>
    <td><h4 align="left" style="font-size: 14px"><?php echo strtoupper($_SESSION['partido'])?> </h4></td>
  </tr>
  <tr>
    <td><h4 align="left" style="font-size: 14px; color: #999999">
	<?php 
	if($_SESSION['tipocandidato']!='PRESIDENCIA'  && $_SESSION['tipocandidato']!='GOBERNACION' && $_SESSION['tipocandidato']!='ALCALDIA'){?>
		Tarjeton # <?php echo $_SESSION['ntarjeton']?></h4> </td>
	<?php }?>
	
  </tr> 
</table> </div>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
	<div style="position:absolute; left: 738px; top: 90px;"> 									
	<table width="10%" border="0">
  <tr style="font-size:16px">       
	   <th><div ><blink><strong style="font-size:26px; color:#FF0000">
	   <?php echo 
	   number_format($totales[0]['MOVILIZADOS'], 0, '', '.');
	   $voto_cargue= number_format($totales[0]['MOVILIZADOS'], 0, '', '.');
	   ?><br/></strong><strong style="font-size:18px; color:#FF0000">SIMPATIZANTES</strong></blink>
	     <img src="images/votos2.png" width="110" height="121">
	   <?php echo date(" g:i:s a") ?> </div></th>	    
  </tr>   
</table></div>	
</ul>								
</div>									
		<table width="100%" border="0">
  <tr style="font-size:16px">
    <th width="70%" rowspan="4" scope="col">
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
                name: 'Simpatizantes',
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

<div id="container" style="min-width: 350px; height: 350px; margin: 0 auto"></div></th>
    
	<?php  if($_SESSION['tipocandidato']=='SENADO	'){ ?>
       <th width="47%" rowspan="3" style="border:3px solid #CCCCCC;" scope="col">DEPARTAMENTOS SIN MOVILIZACION <?php echo @$reportes[0]['REPORTES'];?><br/>
         <br/><blink><strong style="color: #990000"><?php 
	   $sql="SELECT 
			departamentos.NOMBRE
			FROM
			boletines
			INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = boletines.IDDEPARTAMENTO
			where ESTADO=1 AND MOVILIZADOS=0
			order by NOMBRE";
	   $DBGestion->ConsultaArray($sql);
		$departamentos=$DBGestion->datos; 
		for($k=0;$k<count($departamentos);$k++){
			echo $departamentos[$k]['NOMBRE'].' - ';
		}
	}else{
	   ?> 
	    <th width="37%" rowspan="0" style="border:0px solid #CCCCCC;" scope="col">
         <strong style="color: #990000">
		<div class="filtering"><input type="hidden" id="LoadRecordsButton"></input>
</div>
		 <div id="PeopleTableContainer" style="width: auto;"></div>
		 <script type="text/javascript">

		$(document).ready(function () {
		
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Puestos de Votacion Representativos',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'Name ASC',
				actions: {
					listAction: 'PersonActionsPagedSorted_Informe_mesas.php?action=list'
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
					NOMBRE: {
						title: 'PUESTO DE VOTACION',
						width: '30%',
						create: false,
						edit: false
					},
					VOTOSPREV : {
						title: 'VOTO_PRE',
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
	}
	   ?> 
	   </blink></strong></th>
  </tr>
  <tr>
    <th scope="col"><?php //echo @$reportes[0]['REPORTES'];	?></th>
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
	
						<br/>

		  </div></div>
		</header>	
		
	 </div></body>
<?php //require_once('bottom.php'); ?>		