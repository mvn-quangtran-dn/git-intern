<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //C1 
        // $data = [
        //     [
        //         'name' => 'user 1', 
        //         'email' => 'abc1@gmail.com',
        //         'password' => '12234356'
        //     ],
        //     [
        //         'name' => 'user 2', 
        //         'email' => 'abc2@gmail.com',
        //         'password' => '12234356'
        //     ],
        // ];
        // User::insert($data);

        //c2
        // $data = [];
        // for ($i=0; $i <10 ; $i++) { 
        //     $data[$i] = [
        //         'name' => 'user '.$i, 
        //         'email' => 'abc'.$i.'@gmail.com',
        //         'password' => '12234356'
        //     ];
        // }
        // User::insert($data);

        //C3 use Faker and Factory
        // factory(User::class, 10)->create();
        factory(App\User::class, 10)->create()->each(function ($user) {

            $user->profile()->save(factory(App\Profile::class)->make());

            // $user->contacts()->insert(factory(App\Contact::class, 5)->make()->toArray());
        });
    }
}
