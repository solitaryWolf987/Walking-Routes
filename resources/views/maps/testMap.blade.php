

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
      
    </style>
</head>
<body>
	<div id="map"></div>
  
  <input autocomplete="off" id="search" type="text" placeholder="Search..."/>
	<script>
    const API_KEY="kVbYzZdvpCATj1RhoWrx";
    var geocoder = new maptiler.Geocoder({
        input: 'search',
        key: 'kVbYzZdvpCATj1RhoWrx'
      });
      geocoder.on('select', function(item) {
        console.log('Selected', item);
        map.fitBounds(item.bbox);
        const sourceResults = {...map.getSource('search-results')._data};
        sourceResults.features = [item];
        map.getSource('search-results').setData(sourceResults);
      });
    

    const map = new maplibregl.Map({
        container: 'map', // container id
        style: `https://api.maptiler.com/maps/outdoor/style.json?key=${API_KEY}`, // style URL
        center: [-0.1276, 51.5072], // starting position [lng, lat]
        zoom: 6, // starting zoom
        maxZoom: 18
    });


    map.on('load', () => {
        map.addSource('search-results', {
            type: 'geojson',
            data: {
                "type": "FeatureCollection",
                "features": []
            }
        });

        map.addLayer({
            'id': 'line-result',
            'type': 'line',
            'source': 'search-results',
            'paint': {
                'line-color': '#B42222',
                'line-width': 5,
                'line-opacity': 0.5
            },
            'filter': ['==', '$type', 'LineString']
        });
        
        map.addLayer({
            'id': 'point-result',
            'type': 'circle',
            'source': 'search-results',
            'paint': {
                'circle-radius': 8,
                'circle-color': '#B42222',
                'circle-opacity': 0.5
            },
            'filter': ['==', '$type', 'Point']
        });

    });

</script>
</body>
</html>