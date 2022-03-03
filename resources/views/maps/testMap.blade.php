

<!DOCTYPE html>
<html>
<head>
	<title>my map - london</title>
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="https://cdn.maptiler.com/maplibre-gl-js/v1.14.0/maplibre-gl.js"></script>
    <link href="https://cdn.maptiler.com/maplibre-gl-js/v1.14.0/maplibre-gl.css" rel="stylesheet" />
    <style>
    	#map {
        border: 1px solid #ddd;
      border-radius: 4px;
      padding: 5px;
      width: 1000px;
      height: 750px;
      }
    </style>
</head>
<body>
	<div id="map"></div>
	<script type="text/javascript">
		var map = new maplibregl.Map({
		container: 'map',
		style: 'https://api.maptiler.com/maps/outdoor/style.json?key=kVbYzZdvpCATj1RhoWrx',
		center: [0.1276, 51.5072],
		zoom: 6,
		});

		//add marker
		var london = new maplibregl.Marker()
		.setLngLat([-0.1276, 51.5072])
		.addTo(map);
	</script>
</body>
</html>