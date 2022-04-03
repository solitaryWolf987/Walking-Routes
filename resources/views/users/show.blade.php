@extends('layouts.layout')
@section('title', 'User Profile')

@section('content')

    <ul>
        <li>Name: {{$user -> name}} {{$user -> LastName}}</li>
        <li>Age: {{$user -> age}}</li>
        @if ($user -> id == auth()->id())
            <li><a href="{{route('users.edit', ['id' => $user->id])}}">Edit Profile</a></li>
        @endif
    </ul>
    <br>
    <ul>
        Posts by {{$user -> name}} {{$user -> LastName}}:
        @forelse ($posts = $user -> posts as $post)
            <li style= "border-style: double;">  
                            Posted By: 
                            <a href="{{route('users.show', ['id' => $user->id])}}">
                                {{$user -> name}}
                                {{$user -> LastName}}
                            </a>
                <ul>
                    <li style="font-size:70%">Time Posted At: {{$post -> created_at}}</li>
                    <li>
                        Post Title: 
                        <a href="{{route('posts.show', ['id' => $post->id])}}">
                                {{$post -> postTitle}}
                        </a>
                    </li>
                </ul>
            </li>
        @empty
            <li>No Posts</li>
        @endforelse
    </ul>
    <br>
    <ul>
    Comments by {{$user -> name}} {{$user -> LastName}}:
        @forelse ($comments = $user -> comments as $comment)
            <li style= "border-style: double;">
                    Posted By:  
                    <a href="{{route('users.show', ['id' => $user->id])}}">
                        {{$user -> name}}
                        {{$user -> LastName}}
                    </a>
                <ul>
                    <li style="font-size:70%"> Posted at: {{$comment -> created_at}}</li>
                    <li>
                        <a href="{{route('posts.show', ['id' => $comment->post_id])}}">
                            {{$comment -> commentContent}}
                        </a>
                    </li>
                </ul>
            </li>
            <br>
        @empty
            <li>No Comments</li>
        @endforelse
    </ul>


    
            
@endsection