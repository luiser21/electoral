<?php require_once('topadmin.php');?> 
  <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
<script src="js/countdown.js"></script>

<script src="animateprogress.js"></script>	
<?php
date_default_timezone_set('America/Bogota');


 if(date('H')>16){ ?>
<meta http-equiv=refresh content=20;URL=reporte3.php>
<?php }elseif(date('H')>=16){ ?>
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
.progress span{
	
	font-weight:bold;
	

}
.progress{
	float:left;	
}
progress[value] {

	
	
	/* Añado mis propios estilos */
	width: 170px;
	height: 20px;
	
	
/* 	Estos estilos solo se aplicaran al fondo de la barra en mozilla */
	
	border:0px inset #666;
	background-color:#D8D8D8;
	border-radius : 1px ; 
}

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
				date: "25 october 2015 23:59:59",
				format: "on"
			},
			function() {
				// callback function
			});
		});
	</script>
		<p style="margin-left:468px">Horas faltantes Culminar dia Electoral<div class="timer-area" style=" margin-right:-100px">	
										<ul id="countdown" style="margin-left:58px">
										<?php if($_SESSION['foto']!=""){?>
						<img src="<?php echo $_SESSION['foto']?>" width="120" height="107" style="border:3px solid #CCCCCC;">
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
		
		<table width="100%" border="1" cellspacing="1" cellpadding="2">
   <?php 
	
$votos1=0;
$votos2=0;
$votos3=0;
$votos4=0;
$votos5=0;
$votos6=0;

$candi1=0;
$candi2=0;
$candi3=0;
$candi4=0;
$candi5=0;
$candi6=0;


$i=1;
 $sql="SELECT
	 ID,
	 MESA,
CANDIDATOS,
VOTOS_CANDIDATOS,
VOTOS_BLANCO,
VOTOS_NULOS,
VOTOS_NO_MARCADOS,
SUFRAGANTES
FROM
mesas
where idpuesto=5206
order by mesa asc";
$votosblancos=0;
$votosnulos=0;
$votos_no=0;
$sufragantes=0;

$DBGestion->ConsultaArray($sql);				
$departamentos2=$DBGestion->datos;
$array=array();
	foreach($departamentos2 as $Depto2=>$Val2){
		$idcandidato=explode(',',$Val2['CANDIDATOS']);
		$votos=explode(',',$Val2['VOTOS_CANDIDATOS']);
		$votosblancos=$votosblancos+$Val2['VOTOS_BLANCO'];
		$votosnulos=$votosnulos+$Val2['VOTOS_NULOS'];
		$votos_no=$votos_no+$Val2['VOTOS_NO_MARCADOS'];
		$sufragantes=$sufragantes+$Val2['SUFRAGANTES'];
		//var_dump($idcandidato);
		if($idcandidato[0]!=""){
			//candidato 1;
			$candi1=$idcandidato[1];
			$votos1=$votos1+$votos[0];
			//candidato 2;
			$candi2=$idcandidato[2];
			$votos2=$votos2+$votos[1];
			//candidato 3;
			$candi3=$idcandidato[3];
			$votos3=$votos3+$votos[2];
			//candidato 4;
			$candi4=$idcandidato[4];
			$votos4=$votos4+$votos[3];
			//candidato 5;
			$candi5=$idcandidato[5];
			$votos5=$votos5+$votos[4];
			//candidato 6;
			$candi6=$idcandidato[6];
			$votos6=$votos6+$votos[5];
		}
	
	}
	$sql="delete from tempoarl";
	$DBGestion->Consulta($sql);	
	$sql="INSERT INTO tempoarl VALUES (".$candi1.",".$votos1.",'fotos/liberal.png')";
	$DBGestion->Consulta($sql);	
			$sql="INSERT INTO tempoarl VALUES (".$candi2.",".$votos2.",'fotos/conservador.png')";
	$DBGestion->Consulta($sql);	
			$sql="INSERT INTO tempoarl VALUES (".$candi3.",".$votos3.",'fotos/asi.png')";
	$DBGestion->Consulta($sql);	
			$sql="INSERT INTO tempoarl VALUES (".$candi4.",".$votos4.",'fotos/radical.png')";
	$DBGestion->Consulta($sql);	
			$sql="INSERT INTO tempoarl VALUES (".$candi5.",".$votos5.",'fotos/mais.png')";
	$DBGestion->Consulta($sql);	
			$sql="INSERT INTO tempoarl VALUES (".$candi6.",".$votos6.",'fotos/verde.png')";
	$DBGestion->Consulta($sql);	
		
		
 $sql="SELECT
 candidato,
voto,
foto
FROM
tempoarl
order by voto desc";

$DBGestion->ConsultaArray($sql);				
$departamentos=$DBGestion->datos;	

$sql="SELECT
id,
 candidato,
voto,
foto
FROM
temporal_registraduria
order by voto desc";

$DBGestion->ConsultaArray($sql);				
$registraduria=$DBGestion->datos;


$sql="SELECT
id,
 candidato,
voto,
foto
FROM
temporal_registraduria
where id in (8,
9,
10,
11,
11,
12)
order by voto desc";

$DBGestion->ConsultaArray($sql);				
$registraduria2=$DBGestion->datos;

$votosblancos2=0;
$votosnulos2=0;
$votos_no2=0;
$sufragantes2=0;	
$boletines=0;	
$mesas_infor=0;	
	 foreach($registraduria as $Depto3=>$Val3){
		if($Val3['id']==3)
			$votosblancos2=$Val3['voto'];
		if($Val3['id']==4)
			$votosnulos2=$Val3['voto'];
		if($Val3['id']==5)
			$votos_no2=$Val3['voto'];
		if($Val3['id']==6)
			$sufragantes2=$Val3['voto'];
		if($Val3['id']==1)
			$boletines=$Val3['voto'];	
		if($Val3['id']==7)
			$mesas_infor=$Val3['voto'];
	 }
	 
	?> 
   <tr style="font-size:16px">
   
    <th width="45%" scope="col">RESULTADOS E14 TESTIGOS ELECTORAL</th> 
	   <th width="20%" rowspan="2" scope="col" style="border:1px solid #CCCCCC;"><div ><blink><strong style="font-size:32px; color:#FF0000"><br/><br/>
	   <?php echo number_format((($votos2/$sufragantes)*100), 2, ',', ',').'%'?><br/><br/>
	   <?php echo 
	   number_format($votos2, 0, '', '.')?><br/><br/>VOTOS<BR/> <BR/>RUBEN DARIO</strong></blink>
	     <p>&nbsp;</p>
	     <p><img src="images/votos2.png" width="119" height="131"></p>
	   </div> </th>
	  
       <th width="67%" rowspan="3" style="border:1px solid #CCCCCC;" scope="col">BOLETINES REGISTRADURIA<br/>
			<table width="auto" border="1">
  <tbody>
  <?php
  echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">SUFRAGANTES<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">'.$sufragantes2;	        	
	echo '</td>';	
	echo '</tr>';
	 echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">BOLETINES<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">'.$boletines;	 	        	
	echo '</td>';	
	echo '</tr>';
		 echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">MESAS INFORMADAS<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">'.$mesas_infor;	 	        	
	echo '</td>';	
	echo '</tr>';
  foreach($registraduria2 as $Depto2=>$Val2){
	
	echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px"><img src="'.$Val2['foto'].'" width="150" height="47" ><br/></td>';		
	echo '<td width="30%" style="border:1px solid #CCCCCC; font-size:15px">';	?>
   <div class="progress">	
<progress id="html<?php echo $Val2['candidato'].$Val2['id']?>" max="100" value="<?php echo (($Val2['voto']/$sufragantes2)*100) ?>"></progress><span></span>		
		</div>
</div>
        	<?php
	echo '</td>';	
	echo '</tr>';
		
}	

 echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px" width="50%">VOTOS BLANCOS<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">';	
	?>
   <div class="progress">	
<progress id="votosblancos2" max="100" value="<?php echo (($votosblancos2/$sufragantes2)*100) ?>"></progress>
			<span></span>		
		</div>
</div>
        	<?php        	
	echo '</td>';	
	echo '</tr>';
	echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">VOTOS NULOS<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">';
		?>
   <div class="progress">	
<progress id="votosnulos2" max="100" value="<?php echo (($votosnulos2/$sufragantes2)*100) ?>"></progress>
			<span></span>		
		</div>
</div>
        	<?php       	        	
	echo '</td>';	
	echo '</tr>';
	echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">VOTOS NO MARCADOS<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">';	 
		?>
   <div class="progress">	
<progress id="votos_no2" max="100" value="<?php echo (($votos_no2/$sufragantes2)*100) ?>"></progress>
			<span></span>		
		</div>
</div>
        	<?php          	
	echo '</td>';	
	echo '</tr>';
   ?>
    
  </tbody>
</table>
			
		
	</th>
  </tr>
  <tr>
    <th scope="col">
    <table width="auto" border="1">
  <tbody>
  <?php
  echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">SUFRAGANTES<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">'.$sufragantes;	        	
	echo '</td>';	
	echo '</tr>';
	 echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">CANIDATOS<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">VOTANTES';	        	
	echo '</td>';	
	echo '</tr>';
  foreach($departamentos as $Depto=>$Val){
	
	echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px"><img src="'.$Val['foto'].'" width="150" height="47" ><br/></td>';		
	echo '<td width="30%" style="border:1px solid #CCCCCC; font-size:15px">';	?>
   <div class="progress">	
<progress id="html<?php echo $Val['candidato']?>" max="100" value="<?php echo (($Val['voto']/$sufragantes)*100) ?>"></progress><span></span>		
		</div>
</div>
        	<?php
	echo '</td>';	
	echo '</tr>';
		
}	
 echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px" width="50%">VOTOS BLANCOS<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">';	
	?>
   <div class="progress">	
<progress id="votosblancos" max="100" value="<?php echo (($votosblancos/$sufragantes)*100) ?>"></progress>
			<span></span>		
		</div>
</div>
        	<?php        	
	echo '</td>';	
	echo '</tr>';
	echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">VOTOS NULOS<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">';
		?>
   <div class="progress">	
<progress id="votosnulos" max="100" value="<?php echo (($votosnulos/$sufragantes)*100) ?>"></progress>
			<span></span>		
		</div>
</div>
        	<?php       	        	
	echo '</td>';	
	echo '</tr>';
	echo '<tr>';
	echo '<td style="border:1px solid #CCCCCC; font-size:15px">VOTOS NO MARCADOS<br/></td>';		
	echo '<td width="10%" style="border:1px solid #CCCCCC; font-size:15px">';	 
		?>
   <div class="progress">	
<progress id="votos_no" max="100" value="<?php echo (($votos_no/$sufragantes)*100) ?>"></progress>
			<span></span>		
		</div>
</div>
        	<?php          	
	echo '</td>';	
	echo '</tr>';
   ?>
    
  </tbody>
</table>

      <script type="text/javascript"> 
	window.onload = function() { 
			animateprogress("#votos_no",<?php echo (($votos_no/$sufragantes)*100); ?>);
				animateprogress("#votosnulos",<?php echo (($votosnulos/$sufragantes)*100); ?>);
					animateprogress("#votosblancos",<?php echo (($votosblancos/$sufragantes)*100); ?>);
					animateprogress("#votos_no2",<?php echo (($votos_no2/$sufragantes2)*100); ?>);
				animateprogress("#votosnulos2",<?php echo (($votosnulos2/$sufragantes2)*100); ?>);
					animateprogress("#votosblancos2",<?php echo (($votosblancos2/$sufragantes2)*100); ?>);
	<?php  foreach($departamentos as $Depto=>$Val){ ?>		
		animateprogress("#html<?php echo $Val['candidato']?>",<?php echo (($Val['voto']/$sufragantes)*100); ?>);	
		<?php } ?>	
			<?php  foreach($registraduria2 as $Depto2=>$Val2){ ?>		
		animateprogress("#html<?php echo $Val2['candidato'].$Val2['id']?>",<?php echo (($Val2['voto']/$sufragantes2)*100); ?>);	
		<?php } ?>	
	} 	
	document.querySelector ('#boton').addEventListener ('click', function() { 
		animateprogress("#votos_no",<?php echo (($votos_no/$sufragantes)*100); ?>);
				animateprogress("#votosnulos",<?php echo (($votosnulos/$sufragantes)*100); ?>);
					animateprogress("#votosblancos",<?php echo (($votosblancos/$sufragantes)*100); ?>);
					animateprogress("#votos_no2",<?php echo (($votos_no2/$sufragantes2)*100); ?>);
				animateprogress("#votosnulos2",<?php echo (($votosnulos2/$sufragantes2)*100); ?>);
					animateprogress("#votosblancos2",<?php echo (($votosblancos2/$sufragantes2)*100); ?>);
		<?php  foreach($departamentos as $Depto=>$Val){ ?>		
		animateprogress("#html<?php echo $Val['candidato']?>",<?php echo (($Val['voto']/$sufragantes)*100); ?>);  
		 <?php } ?>	
		 	<?php  foreach($registraduria2 as $Depto2=>$Val2){ ?>		
		animateprogress("#html<?php echo $Val2['candidato'].$Val2['id']?>",<?php echo (($Val2['voto']/$sufragantes2)*100); ?>);	
		<?php } ?>	
	});
</script>
    </th>
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