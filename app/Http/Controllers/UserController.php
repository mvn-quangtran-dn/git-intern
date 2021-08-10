<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use App\User;
use App\Category;
use App\NguoiDung;
use App\Role;
use App\Rules\WhiteListEmailDomain;
use App\Country;
use App\Http\Requests\CreateUserRequest;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.user.permission')->except(['index', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('users.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->all(); //array
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'form edit user'.$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //C1
        // $data1 = request()->all(); //array chứa all data 
        // $data2 = request()->except('name', 'email'); // array data ko bao gom các key đó
        // $data3 = request()->only('email'); // array data chỉ chứa value của những key mình muốn lấy
        // $data4 = request()->email; //

        //C2 uu tien dungf 
        $data1 = $request->all(); //array chứa all data 
        $data2 = $request->except('name', 'email'); // array data ko bao gom các key đó
        $data3 = $request->only('email'); // array data chỉ chứa value của những key mình muốn lấy
        $data4 = $request->email; //
        dd($data1,$data2,$data3,$data4);
        return 'update user';
    }

    public function showFormUpload(User $user)
    {
        return view('users.upload', compact('user'));
    }

    public function upload(User $user, Request $request)
    {
        // upload file
        if ($request->hasFile('user_image')) {
            // upload
            
            $file = $request->file('user_image');
            dd($file->getMimeType());
            $newName = 'user'.$user->id.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/images/users'), $newName);
            $path = '/images/users/'.$newName;
            $user->images()->create(['path' => $path]);

            dd('success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index');
    }

    public function getRoles( $id)
    {
        $user = User::with('roles', 'profile')->findOrFail($id)->toArray();
        dd($user);
                // $roles = $user->roles; // collection 
        dd($roles);
    }

    public function setRoles($userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($roleId);

        $roles = [1,2,3];
        $user->roles()->attach($roles);
        // RoleUser::create(['user_id'=> $user->id, 'role_id'=> $roleId]);
        dd('success');

        // $user->profile()->create(['phone'=> '234245', 'age'=>10, 'gender'=> 0]);
        // Profile::create(['user_id'=> $user->id, 'phone'=> '234245', 'age'=>10, 'gender'=> 0]);
    }

    public function removeRoles(User $user, Role $role)
    {
        // $user->roles()->detach($role->id);
        $role->users()->detach($user->id);

        // $roles = [2,3];
        // $user->roles()->detach($roles);
        // $user->roles()->detach();

        
        dd('sucess');
    }

    public function syncRoles(User $user, Role $role)
    {
        $user->roles()->sync([$role->id]);
        dd('sucess');
    }

    public function getImages(User $user)
    {
        $images = $user->images;
        dd($images->toArray());
    }
}
