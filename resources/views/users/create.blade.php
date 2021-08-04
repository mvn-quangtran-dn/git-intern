@extends('layouts.master')
@section('content')
<h1>Create User</h1>
{{-- @if( $errors->any() )
    @php
        dd($errors->all());
    @endphp
@endif --}}
<form action="{{route('users.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email"  class="form-control" id="email"/>
        @if($errors->has('email'))
            <p style="color:red;">{{$errors->first('email')}}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name"  class="form-control" id="name" />
        @if($errors->has('name'))
            <p style="color:red;">{{$errors->first('name')}}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password"  class="form-control" id="password" />
        @if($errors->has('password'))
            <p style="color:red;">{{$errors->first('password')}}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" name="country_id"  class="form-control" id="country" />
        @if($errors->has('country_id'))
            <p style="color:red;">{{$errors->first('country_id')}}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection