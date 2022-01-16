@extends('layouts.layout')

@section('title', 'Edit Comment')

@section('content')
    @php 
        $posts = App\Models\Post::all();
    @endphp
    <form method="POST" action="{{ route('comments.update', ['id' => $comment -> id])}}" enctype="multipart/form-data">
        @csrf
        <p>User ID: <select name="users_id">
                <option value=" {{$user->id}}">
                    {{$user -> name}}
                    {{$user -> LastName}}
                </option>
            </select>
        </p>
        <p>Post ID: <select name="posts_id">
                <option value=" {{$comment->post_id}}">
                    {{$comment -> posts_id}}
                </option>
            </select>
        </p>
        <p>Content: <input type="text" name="commentContent"
            value="{{ $comment -> commentContent}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.show', ['id' => $comment->post_id])}}">Cancel</a>
    </form>

@endsection