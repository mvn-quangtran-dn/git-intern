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
    public  $user ;
    public function __construct()
    {
        // $this->user  = new User();          
        $this->middleware('check.user.permission')->except(['index', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \DB::enableQueryLog();
        // $users = User::all();
        // $users = User::with('roles')->get();
        $user = User::find(20);
        dd($user->time->gte(now()));
        // dd($users->toArray());

        // dd(\DB::getQueryLog());
        // dd($users->toArray());
        // $categories= Category::all();
        // \DB::enableQueryLog();
        // $users = User::withTrashed()->get();  // where deleted_at is null
        // dd($users);
        // dd(\DB::getQueryLog());

        

        // $categories = Category::with([
        //     'manufators' => function($query){
        //         return $query->where('status', 1);
        //     },
        //     'manufators.products' => function($query){
        //         return $query->take(10)->get();
        //     }
        // ])->get();
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
        $data = request()->all();
        $data['password'] = bcrypt($data['password']);

       $result=  User::create($data); // true or false| insert many record
       event(new UserEvent($result));
        return redirect()->back()->with(['success' => 'create user success']);
        // return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $categories= Category::all();


        // $user = User::findOrFail($id);
        dd($user);
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

        $users = User::all(); // object of Collection 
        // $users= User::find(1); // object of Model user 
        $users->update(['name' => 'abc']); // error not found function update 
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

    public function setRoles(User $user,Role $role)
    {
        // $user = User::findOrFail($userId);
        // $role = Role::findOrFail($roleId);
        //c1
        $user->roles()->attach([1,2]);
        dd('success');

        //c2
        RoleUser::create([
            'user_id' =>$user->id,
            'role_id' =>$role->id,
        ]);

        // RoleUser::create(['user_id'=> $user->id, 'role_id'=> $roleId]);
        dd('success');

        // $user->profile()->create(['phone'=> '234245', 'age'=>10, 'gender'=> 0]);
        // Profile::create(['user_id'=> $user->id, 'phone'=> '234245', 'age'=>10, 'gender'=> 0]);
    }

    public function removeRoles(User $user, Role $role)
    {
        $role->users()->detach([$user->id]);
        //or
        // $user->roles()->detach($role->id);

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
