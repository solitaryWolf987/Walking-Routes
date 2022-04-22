@extends('layouts.layout')

@section('title', 'User Posts')

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
    integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
    crossorigin="anonymous"></script>
    <script src= "https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
    integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
    crossorigin="anonymous"></script>
    <script src= "https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>  



    <ul>
        <li>
            Posted By:
            @foreach ($users as $user)
                @if($user -> id == $posts -> user_id)
                    <a href="{{route('users.show', ['id' => $user->id])}}">
                        {{$user -> name}}
                        {{$user -> LastName}}
                        @if ($user -> id == auth()->id())
                            (you)
                        @endif
                    </a>
                @endif
            @endforeach
        </li>
        <ul>
            <li style="font-size:70%">Time: {{$posts -> created_at}}</li>
        </ul>
        <li>Title: {{$posts -> postTitle}}</li>
        <ul>
            <li>{{$posts -> postContent}}</li>
        </ul>
        <ul>
            @if($posts -> file_path != null)
                <li><img src = "/storage/images/{{$posts -> file_path}}" width="500" height: auto; style= "border-style: solid;"></li>
            @endif
            <div id="root">
                <div id="map"></div> 
            </div> 
            
            


            @foreach ($users as $user)
                @if($user -> id == $posts -> user_id)
                    @if ($user -> id == auth()->id())
                        [
                        <a href="{{route('posts.edit', ['id' => $posts->id])}}">Edit</a>
                        |
                        <a href="{{route('posts.destroy', ['id' => $posts->id])}}">Delete</a>
                        ]
                    <!-- Admin If statement - allow admin to delete any post --> 
                    @elseif (auth()->id() == 1)
                        [
                        <a href="{{route('posts.destroy', ['id' => $posts->id])}}">Delete</a>
                        ]
                    @endif
                @endif
            @endforeach
            <form action="{{ route('comments.create', ['id' => $posts->id])}}">
                <input type="submit" value="Add Comment" />
            </form>
            <br>
            @foreach ($comments = $posts -> comments as $comment)
                <ul>
                    <li style= "border-style: double; background: rgba(255, 255, 255, 0.4);">
                        @foreach ($users as $user)
                            @if($user -> id == $comment -> user_id)
                                Posted By:  
                                <a href="{{route('users.show', ['id' => $user->id])}}">
                                    {{$user -> name}}
                                    {{$user -> LastName}}
                                    @if ($user -> id == auth()->id())
                                        (you)
                                    @endif
                                </a>
                                @if ($user -> id == auth()->id())
                                    [
                                    <a href="{{route('comments.edit', ['id' => $comment->id])}}">Edit</a>
                                    |
                                    <a href="{{route('comments.destroy', ['id' => $comment->id])}}">Delete</a>
                                    ]
                                <!-- Admin If statement - allow admin to delete any comment -->           
                                @elseif (auth()->id() == 1)
                                    [
                                    <a href="{{route('comments.destroy', ['id' => $comment->id])}}">Delete</a>
                                    ]
                                @endif
                            @endif
                        @endforeach
                        <ul>
                            <li style="font-size:70%"> Posted at: {{$comment -> created_at}}</li>
                            <li>{{$comment -> commentContent}}</li>
                        </ul>
                    </li>
                </ul>
            @endforeach
        </ul>   
    </ul>


    <script>
        const API_KEY="kVbYzZdvpCATj1RhoWrx"; 
        var geocoder = new maptiler.Geocoder({
            input: 'search',
            key: 'kVbYzZdvpCATj1RhoWrx'
        });
        const points = [];

        var app = new Vue({
            el: "#root",
            data: {
                posts: [],
            },
            mounted() {
                axios.get("{{ route('api.posts.index', ['id' => $posts->id]) }}")
                .then( response => {
                    
                    this.posts = response.data;
                    const myArray = this.posts.coordinates.split(",");

                    while (myArray.length) {
                        const array = myArray.splice(0,2);
                        points.push(array);
                    }
                    console.log("points: ",points);
                    const map = new maplibregl.Map({
                        container: 'map', // container id
                        style: `https://api.maptiler.com/maps/outdoor/style.json?key=${API_KEY}`, // style URL
                        center: [points[0][0], points[0][1]], // starting position [lng, lat]
                        zoom: 10, // starting zoom
                        maxZoom: 20
                    });
                    for(let i = 0; i < points.length; i++){
                        var markers = new maplibregl.Marker()
                        .setLngLat([points[i][0], points[i][1]])
                        .addTo(map);
                    }
                })
                .catch(response => {
                    console.log("catch", response);
                })
                
            },

            
        });

    </script>

@endsection
