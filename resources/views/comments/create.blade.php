@extends('layouts.layout')

@section('title', 'Create Comment')

@section('content')
    <form method="POST" action="{{ route('comments.store')}}" enctype="multipart/form-data">
        @csrf
        <p>User ID: 
            {{$users -> name}}
            {{$users -> LastName}}
        </p>
        <p>Post ID: 
            {{$posts -> id}}
        </p>
        <p>Content: <input type="text" name="commentContent"
            value="{{ old ('commentContent')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.show', ['id' => $posts->id])}}">Cancel</a>
    </form>

@endsection