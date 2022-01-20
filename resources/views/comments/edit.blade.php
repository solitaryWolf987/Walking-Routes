@extends('layouts.layout')

@section('title', 'Edit Comment')

@section('content')
    @php 
        $posts = App\Models\Post::all();
    @endphp
    <form method="POST" action="{{ route('comments.update', ['id' => $comment -> id])}}" enctype="multipart/form-data">
        @csrf
        <p>User ID: 
            {{$user -> name}}
            {{$user -> LastName}}
        </p>
        <p>Post ID: 
            {{$comment -> posts_id}}
        </p>
        <p>Content: <input type="text" name="commentContent"
            value="{{ $comment -> commentContent}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.show', ['id' => $comment->post_id])}}">Cancel</a>
    </form>

@endsection