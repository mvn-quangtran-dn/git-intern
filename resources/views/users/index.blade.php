@extends('layouts.master')

@section('content')
    <h1 id="abc">List User Page</h1>
<h2>{{ $cate }}</h2>

    <a class="btn btn-primary" href="{{ route('users.create') }}">Add user</a>
    <span class="btn btn-primary" id="show-users">Show list User</span>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Country</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="listUsers">
            @foreach($users as $user)
                <tr data-username="{{$user->name}}">
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('users.show', $user->id) }}" >{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->country_id }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            {{ $role->name."," }}
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('users.show', $user->id)}}">Show</a>
                        <form action="{{ route('users.destroy', $user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="{{$user->id}}" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@section('js')
    <script type="text/javascript">
    $(document).ready(function(){
        // code js
        $("tr").click(function(){
            var userID = $(this).attr('id');
            var userName= $(this).attr('data-username');
            console.log(userID, userName);
        }); // select all h1
        // var dom = $("#abc");  // select dom có id=abc
        // var dom = $(".btn");  // select dom có class=btn
        // console.log(dom);
        $("#show-users").click(function(){
            $.ajax({
            url : "/api/v1/users",
            type : "get",
            data : {},
            success : function(result) {
                console.log('get list user success.Here is list user data');
                console.log(result);
                var listUserHtml = "";
                $.each(result,  function(key,user){
                    console.log(user);
                    listUserHtml  += "<tr>"+
                                "<td> "+user.id+"</td>"+
                                "<td> "+user.name+"</td>"+
                                "<td> "+user.email+"</td>"+
                                "<td> "+user.created_at+"</td>"+
                                "<td> "+user.country_id+"</td>"+
                                "<td> <button id="+user.id+" class='btn btn-danger'>Delete</button></td>"+
                            "</tr>";

                });
                console.log(listUserHtml);
                $('tbody').html(listUserHtml);
            },
            error :  function(error){
                console.log(error);
            }
            });

        });

        $(document).on('click', 'button', function(e){
            e.preventDefault();
            var userID= $(this).attr('id');
            $.ajax({
                url: '/api/v1/users/'+userID,
                type: 'POST',
                data: {
                    _method : "DELETE",
                    _token : $('meta[name=_token]').attr('content')
                },
                success: function(response){
                    // console.log(response);
                    var listUserHtml = "";
                    $.each(response.data,  function(key,user){
                        console.log(user);
                        listUserHtml  += "<tr>"+
                                    "<td> "+user.id+"</td>"+
                                    "<td> "+user.name+"</td>"+
                                    "<td> "+user.email+"</td>"+
                                    "<td> "+user.created_at+"</td>"+
                                    "<td> "+user.country_id+"</td>"+
                                    "<td> <button id="+user.id+" class='btn btn-danger'>Delete</button></td>"+
                                "</tr>";

                    });
                    console.log(listUserHtml);
                    $('tbody').html(listUserHtml);
                },
                error: function(response){
                    console.log(response);
                }
            })
        });
        
    });
    
    </script>
@endsection