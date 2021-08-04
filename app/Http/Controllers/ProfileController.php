<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Profile;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = User::findOrFail(22)->profile->toArray();
        // dd($profile);
        $user = Profile::find(2)->user;
        dd($profile, $user);

        // \DB::enableQueryLog();
        // $profiles = Profile::withTrashed()->first();
        // dd($profiles->date, $profiles->gender);
        $profiles = Profile::onlyTrashed()->get();
        // $profiles = Profile::withTrashed()->find(1);
        // dd(\DB::getQueryLog());
        dd($profiles);
        // $column =  request()->search;
        // $value =  request()->value;
        // $condition =  request()->condition;
        // dd($column, $value, $condition);
        // if(isset($column) && isset($value) && isset($condition) )
        DB::enableQueryLog();
        // $profiles = DB::table('profiles')
        //             ->find(1);
                    // ->orWhere('gender', 0)
                    // ->get();

        //where('column', 'operator', 'value')
        //orWhere('column', 'operator', 'value')
        //whereIn('column', [value1,value2])
        //whereNotIn('column', [value1,value2])
        //whereBetween('column',[value1,value2])// value1< column < value2
        //whereNotBetween('column', [value1,value2]) // column < value1 or column >value2
        //orWhereIn('column', [value1,value2])
        //orWhereNotIn('column', [value1,value2])
        //orWhereBetween('column', [value1,value2])
        //orWhereNotBetween('column', [value1,value2])

        // $profiles = Profile::where('gender', 0)
        //                     ->orwhereBetween('age', [63,98])                    
        //                     ->first()->toArray();
        //C1
        // $profile = new Profile;
        // $profile->address= '12QT';
        // $profile->phone= '24356578';
        // $profile->age= 10;
        // $profile->gender= 0;
        // $profile->user_id= 1;
        // $profile->save();

        //C2 

        // $data = [
        //     'phone' => '66666',
        //     'age'  => 14,
        //     'gender' => 1,
        //     'address' => '455BT',
        //     'user_id' => 1
        // ];
        // // $profile = Profile::create($data);
        // $profile = Profile::create($data);
        // dd($profile);

        //c1 save()
        // $profile = Profile::find(1);
        // // dd($profile);
        // $profile->phone = '888888';
        // $profile->save();
        //c2 
        // $profile = Profile::find(1); // Profile::where('gender', 0)->first();
        // $profile->update(['age' => 20, 'address' => '12 dst']);

        //update nhieu record
        // $profile = Profile::where('gender', 0); // App\Profile ? | Collection ? 
        // $profile->update(['age' => 70]);
        // dd('success');

        // $profile = Profile::firstOrCreate(['address' => '34 dst']);
        // dd($profile);

        // $profile = Profile::where('gender', 0)->first();  // App\Profile
        $profile = Profile::where('gender', 1)->delete();  
        // $profile->delete();
        dd('success');
        // Profile::find(1)->delete();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $profile->age = -100;
        $profile->save();
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd('run destroy');
        $profile = Profile::find($id);
        // $profile->delete();
        $profile->forceDelete();
        return 'success';
    }

    public function restore($id = null)
    {
        // dd('run restore');
        if (is_null($id)) {
            Profile::whereNotNull('deleted_at')->restore();
        } else {
            $profile = Profile::withTrashed()->find($id);
            $profile->restore();
        }
        
        return 'success';
    }
    
}
