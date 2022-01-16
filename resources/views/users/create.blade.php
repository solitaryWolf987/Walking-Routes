@extends('layouts.layout')

@section('title', 'Create Profile')

@section('content')
    <form method="POST" action="{{ route('users.store')}}">
        @csrf
        <p>First Name: <input type="text" name="name"
            value="{{ old ('name')}}"></p>
        <p>Last Name: <input type="text" name="LastName"
            value="{{ old ('LastName')}}"></p>
        <p>Age: <input type="text" name="age"
            value="{{ old ('age')}}"></p>
        <p>Email: <input type="text" name="email"
            value="{{ old ('email')}}"></p>
        <p>Password: <input type="text" name="password"
            value="{{ old ('password')}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('users.index') }}">Cancel</a>
    </form>

@endsection