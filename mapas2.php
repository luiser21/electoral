<?php
session_start();
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');
if($_SESSION['tipocandidato']=='SENADO'){
				$sql="";
			
			$sql="SELECT lower(DEPARTAMENTO) as DEPARTAMENTO,
					MAPA,
					SUM(VOTOS) AS VOTOS
					FROM (SELECT					
					departamentos.NOMBRE as DEPARTAMENTO,
					departamentos.MAPA as MAPA,	
					COUNT(mesa_puesto_miembro.MIEMBRO) AS VOTOS
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
					WHERE usuario.USUARIO='".$_SESSION["username"]."' AND departamentos.MAPA IS NOT NULL
					GROUP BY p.IDPUESTO) DEPARTAMENTOS
					GROUP BY DEPARTAMENTO
					ORDER BY DEPARTAMENTO ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			
				$sql="SELECT NOMBRE AS DEPARTAMENTO,
					MAPA,
					0 AS VOTOS					
					FROM
					departamentos 		
					where MAPA IS NOT NULL
					ORDER BY DEPARTAMENTO ";
			$DBGestion->ConsultaArray($sql);				
			$departamentos=$DBGestion->datos;			
			$i=count($partidos);
			$y=1;
			$valor='';			
			foreach($departamentos as $dep1){	
				$bol=false;
				foreach($partidos as $value){				
					if($dep1['MAPA']==$value['MAPA']){
						$bol=true;
						if($y<$i){
							$valor=$valor."['".$value['MAPA']."',".$value['VOTOS']."],";				
						}else{
							$valor=$valor."['".$value['MAPA']."',".$value['VOTOS']."]";				
						}
						$y++;						
					}					
				}	
				if(!$bol){
					$valor=$valor."['".$dep1['MAPA']."',".$dep1['VOTOS']."],";						
				}
			}			
}
			
?>
 <meta http-equiv="Content-Type" content="text/html; charset=utf8">
<script src="js/highmaps.js"></script>
<script src="js/exporting.js"></script>
<script src="js/co-all.js"></script>

<div id="container"></div>
<script>
// Prepare demo data
// Data is joined to map using value of 'hc-key' property by default.
// See API docs for 'joinBy' for more info on linking data and map.
var data = [
    <?php echo $valor; ?>
];

// Create the chart
Highcharts.mapChart('container', {
    chart: {
        map: 'countries/co/co-all'
    },

    title: {
        text: ''
    },

    subtitle: {
        text: 'Colombia'
    },

    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },

    colorAxis: {
        min: 0
    },

    series: [{
        data: data,
        name: 'Votos Previstos',
        states: {
            hover: {
                color: '#BADA55'
            }
        },
        dataLabels: {
            enabled: true,
            format: '{point.name}'
        }
    }]
});

</script>
<style>
#container {
    height: 500px; 
    min-width: 3px; 
    max-width: 800px; 
    margin: 0 auto; 
}
.loading {
    margin-top: 10em;
    text-align: center;
    color: gray;
}

</style>
