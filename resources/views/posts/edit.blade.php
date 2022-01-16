@extends('layouts.layout')

@section('title', 'Edit Post')

@section('content')
    
    <form method="POST" action="{{ route('posts.update', ['id' => $post -> id])}}" enctype="multipart/form-data">
        @csrf
        <p>User ID: <select name="users_id">
                <option value=" {{$user -> id}}">
                    {{$user -> name}}
                    {{$user -> LastName}}
                </option>
            </select>
        </p>
        <p>Title: <input type="text" name="postTitle"
            value="{{ $post -> postTitle}}"></p>
        <p>Content: <input type="text" name="postContent"
            value="{{ $post -> postContent}}"></p>
        <p>File: <input type="file" name="file_path" required
            value="{{ $post -> file_path}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('posts.show', ['id' => $post -> id]) }}">Cancel</a>
    </form>

@endsection