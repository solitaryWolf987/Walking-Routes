

<!DOCTYPE html>
<html>
<head>
	<title>my map - london</title>
  	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="https://cdn.maptiler.com/maplibre-gl-js/v1.14.0/maplibre-gl.js"></script>
    <link href="https://cdn.maptiler.com/maplibre-gl-js/v1.14.0/maplibre-gl.css" rel="stylesheet" />
    <script src="https://cdn.maptiler.com/maptiler-geocoder/v1.1.0/maptiler-geocoder.js"></script>
    <link href="https://cdn.maptiler.com/maptiler-geocoder/v1.1.0/maptiler-geocoder.css" rel="stylesheet" />
    <style>
    	#map {
        border: 1px solid #ddd;
      border-radius: 4px;
      padding: 5px;
      width: 1000px;
      height: 750px;
      }
      #fly {
        position: relative;
        margin: 0px auto;
        width: 10%;
        height: 0px;
        padding: 0px;
        border: none;
        border-radius: 3px;
        font-size: 12px;
        text-align: center;
        color: #000;
        background: #68707b;
      }
    </style>
</head>
<body>
	<div id="map"></div>
  <input autocomplete="off" id="search" type="text" placeholder="Search..."/>
	<script type="text/javascript">
    var geocoder = new maptiler.Geocoder({
        input: 'search',
        key: 'kVbYzZdvpCATj1RhoWrx'
      });
      geocoder.on('select', function(item) {
        console.log('Selected', item);
      });
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

    map.on('load', function () {
      map.loadImage(
        'https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-plane-512.png',
        function (error, image) {
          if (error) throw error;
          map.addImage('AirPort_icon', image);


          map.addSource('AirPorts_points', {
            type: 'geojson',
            data: 'https://api.maptiler.com/data/e3d8da3e-b365-4e71-9050-609de1ab6606/features.json?key=kVbYzZdvpCATj1RhoWrx'
          });

          map.addLayer({
            'id': 'AirPorts',
            'type': 'symbol',
            'source': 'AirPorts_points',
            'layout': {
              'icon-image': 'AirPort_icon',
              'icon-size': 0.05
            }
          });
        }
      );
		});
	</script>
</body>
</html>