@extends('layouts.app')

@section('title')
    Home Page
@endsection

@section('content')

<!-- Main page when logged in
    Shows all the posts on the forum-->
    <p>The Posts on the forum:</p>
    <div id="root">
        <form action="{{ route('posts.create')}}">
            <input type="submit" value="Create Post" />
        </form>
        <ul style = "border-style: double; background: rgba(255, 255, 255, 0.4);">
        @foreach ($users as $user)
            @foreach ($posts = $user -> posts as $post) 
                    Posted By: 
                    <a href="{{route('users.show', ['id' => $user->id])}}">
                        {{$user -> name}}
                        {{$user -> LastName}}
                    </a>
                <li style= "border-style: double; background: white;">  
                    <ul>
                        <li style="font-size:70%">Time and Date Posted: {{$post -> created_at}}</li>
                        <li>
                            Post Title: 
                            <a href="{{route('posts.show', ['id' => $post->id])}}">
                                {{$post -> postTitle}}
                            </a>
                        </li>
                    </ul>
                </li>
                <br>
            @endforeach
        @endforeach
        </ul>
    </div>
@endsection
