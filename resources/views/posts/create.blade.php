@extends('layouts.layout')

@section('title', 'Create Post')

@section('content')
<!-- Post creation page-->
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
        <p><input type="hidden" value = "{{$users -> id}}"name="users_id"></p>
        <p>Title: <input type="text" name="postTitle"
            value="{{ old ('postTitle')}}"></p>
        <p>Content: <br><textarea rows = "5" cols = "60" name="postContent"
            value="{{ old ('postContent')}}"></textarea></br></p>
        <p>File: <input type="file" name="file_path"
            value="{{ old ('file_path')}}"></p>
        <p><input type="hidden" id="example" name="coordinates"></p>
        <input type="submit" onClick = "submission()" value="Submit">
        <a href="{{ route('dashboard') }}">Cancel</a>
    </form>

    
<!-- All map creation javascript-->
    <p> Select points on the map by double clicking to add a marker and dragging and dropping the marker to the point you want.
        To Reset the points refresh the page </p>
    <div id="map"></div>  
    <pre id="coordinates" class="coordinates"></pre>
    <script>
        const points = [];
        const tempPoints = [];
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
                //coordinates.style.display = 'block';
                //coordinates.innerHTML = `Longitude: ${lngLat.lng}<br />Latitude: ${lngLat.lat}`;
                point.push(lngLat.lng, lngLat.lat);
                points.push(point);
                console.log(points);
            }
            marker.on('dragend', onDragEnd);
        }
          
        function getPoints() {
            
            const pointsJoined = points.join(',');
            return pointsJoined;
            
        }

        function submission() {
            document.getElementById("example").setAttribute("value", getPoints());
        }

        
       

        

    </script>
@endsection