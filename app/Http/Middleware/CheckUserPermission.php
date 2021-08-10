<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //\Auth::user() => object App\User {...}
        // code kiem tra quyen
        $data1 = \Auth::check(); //true or false
        $user = \Auth::user(); // object App\User {...} or null
        $userID = \Auth::id(); // userID dang login or null
        // $listRoleIDOfUser = $user->roles->pluck('id')->toArray(); // array chứa all role id cua user
        // $check= in_array(1, $listRoleIDOfUser); //true or false|  1=Admin , 2=User
        // dd($data1, $user,$userID,  $listRoleIDOfUser, $check);
        
        if  (\Auth::check() &&  in_array(1,\Auth::user()->roles->pluck('id')->toArray())){
            return $next($request);
        }
        return redirect()->back()->with(['error' => 'You do not have permission']);
    }
}
