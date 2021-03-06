<?php

namespace App\Repositories;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository 
{
    /**
     * @return string
     *  Return the model
     */
    public function createAndGetID($data)
    {
    	$user_id = DB::table('users')->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'created_at' => now(),
            'password' => Hash::make($data['password']),
            ]);
        return $user_id;
    }

    public function sortWithFirstLetter($num)
    {
        $users = DB::table('users')->where('name','like', $num.'%')->get();
        Session::put('usersexport', $users);
        return $users;
    }
}