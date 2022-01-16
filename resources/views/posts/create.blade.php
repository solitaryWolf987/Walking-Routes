@extends('layouts.layout')

@section('title', 'Create Post')

@section('content')
    <form method="POST" action="{{ route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        <p>User ID: <select name="users_id">
                <option value=" {{$users -> id}}">
                    {{$users -> name}}
                    {{$users -> LastName}}
                </option>
            </select>
        </p>
        <p>Title: <input type="text" name="postTitle"
            value="{{ old ('postTitle')}}"></p>
        <p>Content: <input type="text" name="postContent"
            value="{{ old ('postContent')}}"></p>
        <p>File: <input type="file" name="file_path" required
            value="{{ old ('file_path')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('dashboard') }}">Cancel</a>
    </form>

@endsection