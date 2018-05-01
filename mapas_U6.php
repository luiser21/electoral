<?php
session_start();
include_once "includes/GestionBD.new.class.php";
$DBGestion = new GestionBD('AGENDAMIENTO');
if($_SESSION['tipocandidato']=='SENADO'){
				$sql="";
			
			$sql="SELECT lower(departamentos.NOMBRE) as DEPARTAMENTO,
					departamentos.MAPA,
					VOTOS
					FROM  elecciones_senado 
					INNER JOIN departamentos ON departamentos.IDDEPARTAMENTO=elecciones_senado.IDDEPARTAMENTO
					where elecciones_senado.IDDEPARTAMENTO not in (9,33,34,23,15,6,30,21,12,28)
					ORDER BY DEPARTAMENTO ";
			$DBGestion->ConsultaArray($sql);				
			$partidos=$DBGestion->datos;	
			
				$sql="SELECT NOMBRE AS DEPARTAMENTO,
					MAPA,
					0 AS VOTOS					
					FROM
					departamentos 		
					where MAPA IS NOT NULL and IDDEPARTAMENTO not in (9,33,34,23,15,6,30,21,12,28)
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
        text: 'Votos Reales U6 Nacional'
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
        name: 'Votos Reales',
        states: {
            hover: {
                color: '#49ff33'
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
