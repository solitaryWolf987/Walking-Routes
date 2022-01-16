@extends('layouts.layout')
@section('title', 'Edit Profile')
    
@section('content')
    <form method="POST" action="{{ route('users.update')}}">
        @csrf
        <p>First Name: <input type="text" name="name"
            value="{{ $user -> name}}"></p>
        <p>Last Name: <input type="text" name="LastName"
            value="{{ $user -> LastName}}"></p>
        <p>Age: <input type="text" name="age"
            value="{{ $user -> age}}"></p>
        <p>Email: <input type="text" name="email"
            value="{{ $user -> email}}"></p>
        <input type="submit" value="Submit">
        <a href="{{ route('users.index')}}">Cancel</a>
    </form>
    
@endsection