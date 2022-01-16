@extends('layouts.layout')

@section('title')
    Comments
@endsection

@section('content')
    <ul>
        @foreach ($comments as $comment)
        <li>
            {{$comment -> commentContent}}
        </li>
        @endforeach
    </ul>
@endsection