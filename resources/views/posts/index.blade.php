@extends('layouts.app')

@section('title')
    Posts
@endsection

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
    integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
    crossorigin="anonymous"></script>
    <script src= "https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <p>The Posts on the forum:</p>
    <div id="root">
        <form action="{{ route('posts.create')}}">
            <input type="submit" value="Create Post" />
        </form>
        <ul>
            @foreach ($posts as $post)
                    <li style= "border-style: double;">  
                            @foreach ($users as $user)
                                @if($user -> id == $post -> user_id)
                                    Posted By: 
                                    <a href="{{route('users.show', ['id' => $user->id])}}">
                                        {{$user -> name}}
                                        {{$user -> LastName}}
                                    </a>
                                @endif
                            @endforeach
                        <ul>
                            <li>
                                <a href="{{route('posts.show', ['id' => $post->id])}}">
                                        {{$post -> postTitle}}
                                </a>
                            </li>
                            <li >Time Posted At: {{$post -> created_at}}</li>
                        </ul>
                    </li>
            @endforeach
        </ul>
    </div>

    <script>
        var app = new Vue({
            el: "#root",
            data: {
                users: [],
            },
            mounted() {
                axios.get("{{ route('api.users.index') }}")
                .then( response => {
                    this.users = response.data;
                })
                .catch(response => {
                    console.log(response);
                })
            },
        });
    </script>
@endsection
