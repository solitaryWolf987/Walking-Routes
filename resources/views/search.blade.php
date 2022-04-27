@extends('layouts.app')

@section('title')
    Search Results
@endsection

@section('content')

    <!-- Page to portray the search results -->
    <p>Search Results:</p>
    @if ($post)
        Title: <a href="{{route('posts.show', ['id' => $post->id])}}">{{$post -> postTitle}}</a>
        
    @else
        No user found
    @endif

    
@endsection