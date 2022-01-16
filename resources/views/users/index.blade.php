@extends('layouts.app')

@section('title')
    Profiles
@endsection

@section('content')
    <p>The Users on the forum:</p>
    <ul>
        @foreach ($users as $user)
            <li style= "border-style: double; background: white;">
                <a href="{{route('users.show', ['id' => $user->id])}}">
                    {{$user -> name}} 
                    {{$user -> LastName}}
                    @if ($user -> id == auth()->id())
                        (you)
                    @endif
                </a>
            </li>
            <br>
        @endforeach
    </ul>


@endsection