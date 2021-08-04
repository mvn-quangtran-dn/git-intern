@extends('layouts.master')

@section('js')
    <script src="" type="text/javascript">
    </script>
@endsection
@section('title', 'User Detail Page')
@section('content')
    @if (!empty($user))
    <ul>
        @foreach($cate as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
        
            <td>
                <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>
                <a href="{{route('users.show', $user->id)}}" class="btn btn-success">Show</a>
                <form action="{{route('users.destroy' , $user->id)}}" method="POST">
                    @csrf
                    {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"/> --}}
                    @method('DELETE')
                    {{-- <input type="hidden" name="_method" value="DELETE"/> --}}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    
                </form>
                </td>
            </tr>
        </tbody>
    </table>
    @else
    <h1>No user found</h1> 
    @endif
    @include('partials.button', ['text' => 'List User','paragraph' => 'abc'])
    
    @component('partials.alert', ['text' => 'component'])
        <h2>Component</h2>
    @endcomponent
@endsection

@section('footer')
    <p>This is footer of user detail page</p>
@endsection