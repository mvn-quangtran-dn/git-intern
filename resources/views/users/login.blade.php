@extends('layouts.master')
@section('content')
<h1>Cutomer Login Page</h1>
@if(session()->has('error'))
    <p style="color:red;">{{ session()->get('error') }}</p>
@endif
<form action="{{ route('login') }}" method="POST" >
    @csrf
    <label>Email</label>
    <input type="text" name="email"/>
    <label>Password</label>
    <input type="password" name="password"/>
    <button type="submit" class="">Login</button>
</form>

@endsection