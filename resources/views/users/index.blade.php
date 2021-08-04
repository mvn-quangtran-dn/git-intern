@extends('layouts.master')

@section('content')
    @if(session()->has('error'))
        <h2>{{ session()->get('error') }}</h2>
    @endif
    <ul>
        @foreach($cate as $item)
            <li>{{ $item->name }}</li>
        @endforeach
    </ul>
    <h1>List User</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">List Post</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($users)
                @foreach($users as  $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($user->posts as $post)
                            <p>
                                {{ $post->id.'.'.$post->content }}
                            </p>
                        @endforeach
                    </td>
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
                @endforeach
            @else
               <tr>No records</tr>

            @endif
            
        </tbody>
    </table>
@endsection
