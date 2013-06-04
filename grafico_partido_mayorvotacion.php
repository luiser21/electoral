<?php
require_once "php/jqUtils.php";
require_once "php/jqChart.php";
ini_set("display_errors","1");
	$sql="SELECT
				partidos_politicos.NOMBRECORTO,
				elecciones_senado.VOTOS,
				elecciones_senado.PARTICIPACION
				FROM
				elecciones_senado
				INNER JOIN partidos_politicos ON partidos_politicos.IDPARTIDO = elecciones_senado.IDPARTIDO
				where elecciones_senado.TIPO='5' and
				elecciones_senado.INDIGENA='0' and elecciones_senado.ELECCIONES='2010'
				ORDER BY partidos_politicos.IDPARTIDO asc";
				$DBGestion->ConsultaArray($sql);
				$circun2=$DBGestion->datos;	
	
	for($i=0; $i<6; $i++){
		$y=0;
		if($i==0){
			$nuevoarreglo[$i]['name']=$circun2[$i]['NOMBRECORTO'];
			$nuevoarreglo[$i]['y']=(float)(str_replace('%', '', $circun2[$i]['PARTICIPACION']));
			$nuevoarreglo[$i]['sliced']=true;
			$nuevoarreglo[$i]['selected']=true;			 
		}else{
			$nuevoarreglo[$i][$y]=$circun2[$i]['NOMBRECORTO'];
			$nuevoarreglo[$i][$y+1]=(float)(str_replace('%', '', $circun2[$i]['PARTICIPACION']));	
		}
	}	
$chart = new jqChart();
$chart->setTitle(array('text'=>'Partidos con Mayor Votacion, 2010 - 2014 '))
->setTooltip(array("formatter"=>"function(){return '<b>'+ this.point.name +'</b>: '+ this.y +' %';}"))
->setPlotOptions(array(
	"pie"=> array(
		"allowPointSelect"=> true,
		"cursor"=> 'pointer',
		"dataLabels"=>array(
			"enabled"=>true,
			"color"=>'#000000',
			"connectorColor"=>'#000000',
			"formatter"=>"js:function(){return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}"
		)
	)
))
->addSeries('Browser share', $nuevoarreglo)
->setSeriesOption('Browser share', 'type','pie');
echo $chart->renderChart('', true, 500, 250);				
?>