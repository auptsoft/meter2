<?php

namespace App\Policies;


use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user) {
        if($user->roles()->get()->first()) {
            return $user->roles()->get()->first()->name == "Admin" 
                   || $user->roles()->get()->first()->name == "Staff";
        } else {
            return false;
        }  
    }

    public function ownMeter(User $user) {
        if($user->roles()->get()->first()) {
            return $user->roles()->get()->first()->name == "Customer" ;
        } else {
            return false;
        }  
    }

    public function viewAll(User $user) {
        if($user->roles()->get()->first()) {
            return $user->roles()->get()->first()->name == "Admin"
             || $user->roles()->get()->first()->name == "Staff";
        } else {
            return false;
        }  
    }
}
