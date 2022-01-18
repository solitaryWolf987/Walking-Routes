@extends('layouts.app')

@section('title')
    Search Results
@endsection

@section('content')

    <p>Search Results:</p>
    @if ($user)
        Name: {{$user -> name}}
    @else
        No user found
    @endif

    @if ($post)
        Post: {{$post -> postTitle}}
    @else
        No post found
    @endif
    
@endsection