<?php require_once('topadmin.php');?> 
  <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>

<style>

#crudFormLineal label {
	width: 350px;
}

h4{

 color: #006600;
    font-family: 'GothamLight',arial,serif;
    font-size: 18px;
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
			
			<div id="crudFormLineal" style="width: 910px; height: auto; clear:both; background-color:#FFFFFF; border-right:medium; border-right-color:#999999; border-right-width:medium" >
			
			<table width="auto" border="0" style="line-height:2px;">
  <tr>
    <th width="227" rowspan="7" scope="row"><?php if($_SESSION['foto']!=""){?>
						<img src="<?php echo $_SESSION['foto']?>" width="94" height="108" style="border:3px solid #CCCCCC;">
			<?php }else{ ?>		
				<img src="fotos/images.jpg" width="94" height="108" style="border:3px solid #CCCCCC;">
			<?php } ?>	</th>
    <td width="575"><h4 align="left">&nbsp;</h4>
      <h4 align="left">&nbsp;</h4>
      <h4 align="left">Consolidado por MESA - CANDIDATOS</h4></td>
  </tr>
  <tr>
    <td>

      <h4 align="left" style="font-size: 14px; color: #999999"><?php echo $_SESSION['nombre']?></h4></td>
  </tr>

    <td><h4 align="left" style="font-size: 14px">Candidato 
	<?php if($_SESSION["tipocandidato"]=='SENADO'){ echo 'Al '.$_SESSION['tipocandidato'].'</h4></td></tr><tr><td><h4 align="left" style="font-size: 14px; color: #999999"> De la República'; 
		}else if($_SESSION["tipocandidato"]=='ALCALDIA' || $_SESSION["tipocandidato"]=='CONSEJO'){ echo 'Al '.$_SESSION['tipocandidato'].'</h4></td>
  </tr>
    <tr><td><h4 align="left" style="font-size: 14px; color: #999999"> Por '.ucwords(strtolower($_SESSION['municipio'])); 
		}else if($_SESSION["tipocandidato"]=='CAMARA' || $_SESSION["tipocandidato"]=='GOBERNACION'){ echo 'A la '.$_SESSION['tipocandidato'].'</h4></td>
  </tr>
    <tr><td><h4 align="left" style="font-size: 14px; color: #999999"> Por '.ucwords(strtolower($_SESSION['departamento'])); }?>

	
		</h4></td></tr>
  <tr>
  <tr>
    <td><h4 align="left" style="font-size: 14px"><?php echo $_SESSION['partido']?> </h4></td>
  </tr>
  <tr>
    <td><h4 align="left" style="font-size: 14px; color: #999999">Tarjeton # <?php echo $_SESSION['ntarjeton']?></h4> </td>
  </tr>
 
</table>
<div class="filtering">
    <form>
        Nombre: <input type="text" name="name" id="name" />
      
        <button type="submit" id="LoadRecordsButton">Buscar</button>

    </form>
</div>
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
CONCAT(sum(votoscandidato1), 
',',sum(votoscandidato2),
',',sum(votoscandidato3), 
',',sum(votoscandidato4),
',',sum(votoscandidato5), 
',',sum(votoscandidato6),
',',sum(votoscandidato7),
',',sum(votoscandidato8),
',',sum(VOTOS_BLANCO),
',',sum(VOTOS_NO_MARCADOS),
',',sum(VOTOS_NULOS)) AS VOTOS
 FROM mesas_testigo WHERE IDCANDIDATO=225 AND IDPUESTO=13116
AND TOTALMESA>0
order by MESA ";
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
//$valores=round(($Val['VOTOS']*100)/$totales[0]['TOTAL1'], 2);
	
	if($i<count($departamentos) && $i<=10){
		//$arrDepartamento.= "'".$Val['votoscandidato1']."',";
		$arrDepartamento2.= "".$Val['VOTOS'].",";
		
		//$arrDepartamento3.= "".$Val['VOTOS'].",";
		//$arrDepartamento4.= "".$Val['votoscandidato4'].",";
	}else{
		
	//	$arrDepartamento.= "'".$Val['DEPARTAMENTO']."'";
		$arrDepartamento2.= "".$Val['VOTOS']."";		
	//	$arrDepartamento3.= "".$Val['votoscandidato2']."";
	//	$arrDepartamento4.= "".$Val['REAL']."";
	}
	
	if($i==10){
		//$suma=$suma+$Val['votoscandidato1'];
	//	$suma1=$suma1+$Val['votoscandidato2'];
	//	$suma2=$suma2+$Val['VOTOS'];
		//$depar=$depar.','.$Val['DEPARTAMENTO'];
	}
	
	
}
//imprimir($depar);
//$arrDepartamento.= "'OTROS'";
//$arrDepartamento2.= "".$suma."";
//$arrDepartamento3.= "".$suma1."";
//$arrDepartamento4.= "".$suma2."";
//imprimir($arrDepartamento2);
@$arrDepartamento2=$departamentos[0]['VOTOS'];
$arrDepartamento="'1-MIGUEL ANGEL VARGAS HERNANDEZ','2-HNO. ARIOSTO ARDILA SILVA','3-JAVIER FUENTES CORTES',
'4-LUIS GERARDO MARTINEZ MORENO','5-JAIRO ERNESTO MORENO LOPEZ','6-ALVARO SOTELO SOTELO','7-ORLANDO TARAZONA VILLAMIZAR','8-ALFONSO PULIDO LEON',
'VOTOS EN BLANCO','VOTOS NO MARCADOS','VOTOS NULOS'";
$terna=explode(",",$arrDepartamento2);

$candidatos=explode(",",$arrDepartamento);

//rsort($terna);
$array=array();

for($x = 0; $x < count($terna); $x++){
	$array[$x]['NOMBRE']=$candidatos[$x];
	$array[$x]['VOTOS']=$terna[$x];
}
foreach ($array as $clave => $fila) {
            $orden1[$clave] = $fila['VOTOS'];
        }
array_multisort($orden1, SORT_DESC, $array);
echo "<br>";

echo 'TERNA RECTOR';
echo "<br>";

for($x = 0; $x < 3; $x++) {
	echo "<br><strong>";
    echo  str_replace("'", "", @$array[$x]['NOMBRE']);;
	echo '    -   VOTOS:   '.@$array[$x]['VOTOS'];
    echo "</strong>";
}


?>


						<br/>
							<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'GRAFICA POR MESAS CANDIDATOS'
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
                name: 'TOTAL MESAS',
                data: [<?php echo $arrDepartamento2?>]
    		}]
        });
    });
    
		</script>
			<script src="js/js/highcharts.js"></script>
<script src="js/js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 450px; margin: 0 auto"></div>
			
						<br/>
<div class="filtering">
    
</div><p></p>
	<div id="PeopleTableContainer" style="width: auto;"></div>
<script type="text/javascript">

		$(document).ready(function () {
		
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Informe Mesas',
				paging: true,
				pageSize: 20,
				sorting: true,
				
				actions: {
					listAction: 'PersonActionsPagedSorted_Informe_mesas_rector.php?action=list'
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
					CANDIDATO: {
						title: 'CANDIDATO',
						width: '30%',
						create: false,
						edit: false
					},
					MESA1: {
						title: 'MESA1',
						width: '5%',
						create: false,
						edit: false
					},
					MESA2: {
						title: 'MESA2',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},
					MESA3 : {
						title: 'MESA3',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},
					MESA4: {
						title: 'MESA4',
						width: '5%',
						//type: 'date',
						create: false,
						edit: false
					},		
					TOTALMESAS: {
						title: 'TOTALMESAS',
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
					name: $('#name').val(),
					cityId: $('#cityId').val()
				});
			});
	 
			//Load all records when page is first shown
				$('#LoadRecordsButton').click();
		});

	</script>
				
	</div>	
	
		
		
<?php require_once('bottom.php'); ?>	</div>		
		</header>
	 </div>