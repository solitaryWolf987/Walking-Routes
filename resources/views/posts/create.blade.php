@extends('layouts.layout')

@section('title', 'Create Post')

@section('content')
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

    <form method="POST" action="{{ route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        <p>User ID: 
            {{$users -> name}}
            {{$users -> LastName}}
        </p>
        <p><input type="hidden" value = "{{$users -> id}}"name="users_id">
        </p>
        <p>Title: <input type="text" name="postTitle"
            value="{{ old ('postTitle')}}"></p>
        <p>Content: <input type="text" name="postContent"
            value="{{ old ('postContent')}}"></p>
        <p>File: <input type="file" name="file_path"
            value="{{ old ('file_path')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('dashboard') }}">Cancel</a>
    </form>



    <div id="map"></div>  
    <script>
        const points = [];
        const API_KEY="kVbYzZdvpCATj1RhoWrx";
        let markers = [];
        var geocoder = new maptiler.Geocoder({
            input: 'search',
            key: 'kVbYzZdvpCATj1RhoWrx'
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

        map.on('dblclick', function (e) {
            addMarker(e); 
        });
        function addMarker(position) {
        const marker = new maplibregl.Marker({
            draggable: true
        })
        .setLngLat([position.lngLat.lng, position.lngLat.lat])
        .addTo(map);

        markers.push(marker);
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
        }
        function buttonFunction() {
        route_points = [];
        
        for(let i = 0; i < points.length; i++){
            var markers = new maplibregl.Marker()
            .setLngLat([points[i][0], points[i][1]])
            .addTo(map);
            if (i+1 == points.length) {
            console.log("no more points")
            } else {
            startPoint = [];
            endPoint = [];
            startPoint.push(points[i][0]);
            startPoint.push(points[i][1]);
            endPoint.push(points[i+1][0]);
            endPoint.push(points[i+1][1]);
            console.log("start " + startPoint);
            console.log("end " + endPoint);
            routeLines(startPoint, endPoint);
            
            }
            
                    
        }
        
        }

        function routeLines(startPoint, endPoint) {
        map.addSource("route", {
            "type": "geojson",
            "data": {
                "type": "Feature",
                "properties": {},
                "geometry": {
                'type': 'LineString',
                'coordinates': [
                    [startPoint[0], startPoint[1]],
                    [endPoint[0], endPoint[1]]
                ]
                }
            }
        });

        map.addLayer({
            "id": "route",
            "type": "line",
            "source": "route",
            "layout": {
                "line-join": "round",
                "line-cap": "round"
            },
            "paint": {
                "line-color": "#ff0000",
                "line-width": 4
            }
        });  
        }
    </script>
@endsection