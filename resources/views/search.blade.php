@extends('layouts.app')

@section('title')
    Search Results
@endsection

@section('content')

    <p>Search Results:</p>
    @if ($user)
        Name: <a href="{{route('users.show', ['id' => $user->id])}}">{{$user -> name}} {{$user -> LastName}}</a>
    @else
        No user found
    @endif

    
@endsection