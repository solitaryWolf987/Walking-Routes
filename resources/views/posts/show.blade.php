@extends('layouts.layout')

@section('title', 'User Posts')

@section('content')
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
            <li><img src = "/storage/images/{{$posts -> file_path}}" width="500" height: auto; style= "border-style: solid;"></li>
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

@endsection
