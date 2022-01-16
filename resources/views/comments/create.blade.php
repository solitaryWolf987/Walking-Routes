@extends('layouts.layout')

@section('title', 'Create Comment')

@section('content')
    <form method="POST" action="{{ route('comments.store')}}" enctype="multipart/form-data">
        @csrf
        <p>User ID: <select name="users_id">
                <option value=" {{$users->id}}">
                    {{$users -> name}}
                    {{$users -> LastName}}
                </option>
            </select>
        </p>
        <p>Post ID: <select name="posts_id">
                <option value=" {{$posts->id}}">
                    {{$posts -> id}}
                </option>
            </select>
        </p>
        <p>Content: <input type="text" name="commentContent"
            value="{{ old ('commentContent')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.show', ['id' => $posts->id])}}">Cancel</a>
    </form>

@endsection