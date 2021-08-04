@extends('layouts.master')
@section('content')
<form action="{{ route('users.upload', 1) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Choose file</label>
    <input type="file" name="user_image"/>
    <button type="submit" class="">Submit</button>
</form>

@endsection