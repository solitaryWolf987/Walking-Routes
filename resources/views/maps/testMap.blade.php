

<!DOCTYPE html>
<html>
<head>
	<title>my map tests</title>
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
      #info {
        display: block;
        position: relative;
        margin: 0px auto;
        width: 50%;
        padding: 10px;
        border: none;
        border-radius: 3px;
        font-size: 12px;
        text-align: center;
        color: #222;
        background: #fff;
      }
      .coordinates {
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        position: absolute;
        bottom: 40px;
        left: 10px;
        padding: 5px 10px;
        margin: 0;
        font-size: 11px;
        line-height: 18px;
        border-radius: 3px;
        display: none;
      }
    </style>
</head>
<body>
	<div id="map"></div>
  <pre id="info"></pre>
  <pre id="coordinates" class="coordinates"></pre>
  <input autocomplete="off" id="search" type="text" placeholder="Search..."/>
  <button onclick="buttonFunction()">Route points show</button>
	<script>
    const points = [];
    const API_KEY="kVbYzZdvpCATj1RhoWrx";
    var geocoder = new maptiler.Geocoder({
        input: 'search',
        key: 'kVbYzZdvpCATj1RhoWrx'
      });
      geocoder.on('select', function(item) {
        console.log('Selected', item);
        map.fitBounds(item.bbox);
        const sourceResults = {...map.getSource('search-results')._data};
        //points.push(sourceResults);        
        sourceResults.features = [item];
        map.getSource('search-results').setData(sourceResults);
        console.log(sourceResults);
      });
      

    const map = new maplibregl.Map({
        container: 'map', // container id
        style: `https://api.maptiler.com/maps/outdoor/style.json?key=${API_KEY}`, // style URL
        center: [-0.1276, 51.5072], // starting position [lng, lat]
        zoom: 6, // starting zoom
        maxZoom: 18
    });
    map.doubleClickZoom.disable();
    var london = new maplibregl.Marker()
		.setLngLat([-0.1276, 51.5072])
		.addTo(map);
    

    const marker = new maplibregl.Marker({
      draggable: true
      })
      .setLngLat([0.1276, 51.5072])
      .addTo(map);
      
      function onDragEnd() {
      point = [];
      const lngLat = marker.getLngLat();
      coordinates.style.display = 'block';
      coordinates.innerHTML = `Longitude: ${lngLat.lng}<br />Latitude: ${lngLat.lat}`;
      point.push(lngLat.lng, lngLat.lat);
      points.push(point);
      console.log(points);
    }
    marker.on('dragend', onDragEnd);
    
    map.on('dblclick', function (e) {
      
      const marker = new maplibregl.Marker({
      draggable: true
      })
      .setLngLat([e.lngLat.lng, e.lngLat.lat])
      .addTo(map);
      
      function onDragEnd() {
        point = [];
        const lngLat = marker.getLngLat();
        coordinates.style.display = 'block';
        coordinates.innerHTML = `Longitude: ${lngLat.lng}<br />Latitude: ${lngLat.lat}`;
        point.push(lngLat.lng, lngLat.lat);
        points.push(point);
        console.log(points);
      }
      marker.on('dragend', onDragEnd);

      map.on('click', function (e) {
        if(marker != null){
          marker.remove();
          const lngLat = marker.getLngLat();
          point = [];
          point.push(lngLat.lng, lngLat.lat);
          var myIndex = points.indexOf(point);
          if (myIndex !== -1) {
              points.splice(myIndex, 1);
          }
        }
        
      });
      console.log(points);
    });

    
    function buttonFunction() {
      route_points = [];
      for(let i = 0; i < points.length; i++){
        var london = new maplibregl.Marker()
          .setLngLat([points[i][0], points[i][1]])
          .addTo(map);
        route_points.push(points[i][0]);
        route_points.push(points[i][1]);
      }
      map.addSource('route-path', {
        type: 'geojson',
        data: {
          'type': 'Feature',
          'properties': {},
          'geometry': {
            'type': 'LineString',
            'coordinates': [
              [route_points[0],route_points[1]],
              [route_points[2],route_points[3]]
            ]
          }
        }
      });
      map.addLayer({
        'id': 'route-path',
        'type': 'line',
        'source': 'route-path',
        'layout': {
          'line-join': 'round',
          'line-cap': 'round'
        },
        'paint': {
          'line-color': '#888',
          'line-width': 8
        }
      });
    }

    
    
    



    map.on('mousemove', function (e) {
      document.getElementById('info').innerHTML =
      // e.point is the x, y coordinates of the mousemove event relative
      // to the top-left corner of the map
      JSON.stringify(e.point) +
      '<br />' +
      // e.lngLat is the longitude, latitude geographical position of the event
      JSON.stringify(e.lngLat.wrap());
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


        /*
        On click function, so that when the user clicks on the point it tells you what it is/ where it is
         */
    });

</script>
</body>
</html>