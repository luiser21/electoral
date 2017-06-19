<!DOCTYPE html>
<html>
	<head>
		
		<!-- amCharts javascript sources -->
		<script type="text/javascript" src="js/ammap.js"></script>
		<script type="text/javascript" src="js/colombiaLow.js"></script>

		<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("map",{
					"type": "map",
					"pathToImages": "",
					"addClassNames": true,
					"fontSize": 15,
					"color": "#000000",
					"projection": "mercator",
					"backgroundAlpha": 1,
					"backgroundColor": "rgba(255,255,255,1)",
					"dataProvider": {
						"map": "colombiaLow",
						"getAreasFromMap": true,
						"images": [
							{
								"top": 40,
								"left": 60,
								"width": 80,
								"height": 40,
								"pixelMapperLogo": true,
								"imageURL": "",
								"url": ""
							}
						]
					},
					"balloon": {
						"horizontalPadding": 15,
						"borderAlpha": 0,
						"borderThickness": 1,
						"verticalPadding": 15
					},
					"areasSettings": {
						"color": "rgba(124,124,125,1)",
						"outlineColor": "rgba(255,255,255,1)",
						"rollOverOutlineColor": "rgba(255,255,255,1)",
						"rollOverBrightness": 20,
						"selectedBrightness": 20,
						"selectable": true,
						"unlistedAreasAlpha": 0,
						"unlistedAreasOutlineAlpha": 0
					},
					"imagesSettings": {
						"alpha": 1,
						"color": "rgba(124,124,125,1)",
						"outlineAlpha": 0,
						"rollOverOutlineAlpha": 0,
						"outlineColor": "rgba(255,255,255,1)",
						"rollOverBrightness": 20,
						"selectedBrightness": 20,
						"selectable": true
					},
					"linesSettings": {
						"color": "rgba(124,124,125,1)",
						"selectable": true,
						"rollOverBrightness": 20,
						"selectedBrightness": 20
					},
					"zoomControl": {
						"zoomControlEnabled": true,
						"homeButtonEnabled": false,
						"panControlEnabled": false,
						"right": 38,
						"bottom": 30,
						"minZoomLevel": 0.25,
						"gridHeight": 100,
						"gridAlpha": 0.1,
						"gridBackgroundAlpha": 0,
						"gridColor": "#FFFFFF",
						"draggerAlpha": 1,
						"buttonCornerRadius": 2
					}
				});
				function updateHeatmap( event ) {
    var map = event.chart;
    if ( map.dataGenerated )
      return;
    if ( map.dataProvider.areas.length === 0 ) {
      setTimeout( updateHeatmap, 100 );
      return;
    }
    for ( var i = 0; i < map.dataProvider.areas.length; i++ ) {
      map.dataProvider.areas[ i ].value = Math.round( Math.random() * 10000 );
    }
    map.dataGenerated = true;
    map.validateNow();
  }
		</script>
	</head>
	<body style="margin: 0;background-color: rgba(255,255,255,1);">
		<div id="map" style="width: 100%; height: 641px;"></div>
	</body>
</html>