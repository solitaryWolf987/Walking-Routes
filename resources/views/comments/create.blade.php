@extends('layouts.layout')

@section('title', 'Create Comment')

@section('content')
    <form method="POST" action="{{ route('comments.store')}}" enctype="multipart/form-data">
        @csrf
        <p>User ID: 
            {{$user -> name}}
            {{$user -> LastName}}
        </p>
        <p><input type="hidden" value = "{{$user -> id}}"name="users_id"></p>
        <p>Post ID: 
            {{$posts -> id}}
        </p>
        <p><input type="hidden" value = "{{$posts -> id}}"name="posts_id"></p>
        <p>Content: <input type="text" name="commentContent"
            value="{{ old ('commentContent')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.show', ['id' => $posts->id])}}">Cancel</a>
    </form>

@endsection