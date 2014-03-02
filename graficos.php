<?php 
include_once "includes/GestionBD.new.class.php";
session_start();
$DBGestion = new GestionBD('AGENDAMIENTO');
$sql="
SELECT SUM(VOTOS) AS TOTAL FROM (SELECT SUM(VOTOS) AS VOTOS   FROM (SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE as DEPARTAMENTO,
					municipios.NOMBRE as MUNICIPIOS,
					p.NOMBRE_PUESTO AS PUESTO,
					COUNT(mesa_puesto_miembro.MIEMBRO) AS VOTOS,
					SUM(mesas.VOTOREAL) AS VOTOSREALES,
					COUNT(MESAS) AS MESAS 
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					INNER JOIN mesas ON mesas.IDPUESTO = p.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID
					INNER JOIN miembros ON miembros.ID = mesa_puesto_miembro.MIEMBRO
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='duvanpineda'
					GROUP BY p.IDPUESTO
					ORDER BY p.NOMBRE_PUESTO,departamentos.NOMBRE, municipios.NOMBRE) DEPARTAMENTOS
					GROUP BY VOTOS
ORDER BY departamento, municipios) VOTOS";
$DBGestion->ConsultaArray($sql);				
$totales=$DBGestion->datos;	
//imprimir($totales[0]['TOTAL']);

$sql="SELECT DEPARTAMENTO, SUM(VOTOS) AS VOTOS FROM (
					SELECT IDDEPARTAMENTO,DEPARTAMENTO,MUNICIPIOS,COUNT(PUESTO) AS PUESTO ,SUM(VOTOS) AS VOTOS,SUM(VOTOSREALES) AS VOTOSREALES,COUNT(MESAS) AS MESAS   FROM (SELECT
					departamentos.IDDEPARTAMENTO,
					departamentos.NOMBRE as DEPARTAMENTO,
					municipios.NOMBRE as MUNICIPIOS,
					p.NOMBRE_PUESTO AS PUESTO,
					COUNT(mesa_puesto_miembro.MIEMBRO) AS VOTOS,
					SUM(mesas.VOTOREAL) AS VOTOSREALES,
					COUNT(MESAS) AS MESAS 
					FROM
					puestos_votacion AS p
					INNER JOIN municipios ON municipios.ID = p.IDMUNICIPIO
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO = municipios.IDDEPARTAMENTO
					INNER JOIN mesas ON mesas.IDPUESTO = p.IDPUESTO
					INNER JOIN mesa_puesto_miembro ON mesa_puesto_miembro.IDMESA = mesas.ID
					INNER JOIN miembros ON miembros.ID = mesa_puesto_miembro.MIEMBRO
					INNER JOIN lideres ON lideres.ID = miembros.IDLIDER
					INNER JOIN candidato ON candidato.ID = lideres.IDCANDIDATO
					INNER JOIN usuario ON usuario.IDUSUARIO = candidato.IDUSUARIO
					WHERE usuario.USUARIO='".$_SESSION["username"]."'
					GROUP BY p.IDPUESTO
					ORDER BY p.NOMBRE_PUESTO,departamentos.NOMBRE, municipios.NOMBRE) DEPARTAMENTOS
					GROUP BY municipios)  CONSULTA 
GROUP BY DEPARTAMENTO
					ORDER BY VOTOS desc ";
$DBGestion->ConsultaArray($sql);				
$departamentos=$DBGestion->datos;	
//imprimir($departamentos);
$arrDepartamento=array();
$i=0;
$arrDepartamento="";
$arrDepartamento2="";$suma=0;
$depar="";
foreach($departamentos as $Depto=>$Val){
$i++;
$valores=round(($Val['VOTOS']*100)/$totales[0]['TOTAL'], 2);
	
	if($i<count($departamentos) && $valores>1){
		$arrDepartamento.= "'".$Val['DEPARTAMENTO']."',";
		$arrDepartamento2.= "".round(($Val['VOTOS']*100)/$totales[0]['TOTAL'], 2).",";
	}else{
		
		//$arrDepartamento.= "'".$Val['DEPARTAMENTO']."'";
		//$arrDepartamento2.= "".round(($Val['VOTOS']*100)/$totales[0]['TOTAL'], 2)."";
	}
	
	if($valores<=1){
		$suma=$suma+$Val['VOTOS'];
		$depar=$depar.','.$Val['DEPARTAMENTO'];
	}
	
	
}
//imprimir($depar);
$arrDepartamento.= "'OTROS'";
$arrDepartamento2.= "".round(($suma*100)/$totales[0]['TOTAL'], 2)."";
	//imprimir($arrDepartamento2);
?>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafico por Departamentos'
            },
            subtitle: {
                text: 'Votos por Departamento'
            },
            xAxis: {
                categories: [<?php echo $arrDepartamento?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Votos %'
                }
            },
			
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}%</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Departamentos',
                data: [<?php echo $arrDepartamento2?>]
    
            }]
        });
    });
		</script>
	
<script src="js/js/highcharts.js"></script>
<script src="js/js/modules/exporting.js"></script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


	