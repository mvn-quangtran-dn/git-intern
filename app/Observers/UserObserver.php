<?php

namespace App\Observers;

use App\User;
use App\Profile;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //code gui mail
            // $user->profile()->create([
            //    'tel' => '123456', 
            //    'age' =>20,
            //    'gender' => 1,
            //    'address' => '12 AT']);
            // });
        Profile::create([
            'tel' => '123456', 
           'age' =>20,
           'gender' => 1,
           'address' => '12 AT',
           'user_id' => $user->id
        ]);
        $user->update(['name' => 'chage name after created']);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
